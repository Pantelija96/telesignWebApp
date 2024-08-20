<?php

namespace App\Services;

use App\DataTransferObjects\UserDto;
use App\Exceptions\LdapBindError;
use App\Exceptions\LdapConnectError;
use App\Exceptions\LdapUserBindError;
use App\Exceptions\LdapUserNotInGroups;
use App\Exceptions\UserNotEdited;
use App\Exceptions\UserNotFound;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * @throws LdapBindError
     * @throws LdapConnectError
     * @throws LdapUserBindError
     * @throws LdapUserNotInGroups
     */
    private function getUserFromLdap($username, $password){
        $xmlPath = base_path('../config/config.xml');
        $xml = simplexml_load_file($xmlPath);
        $ldapConnection = false;
        $ldapUser = null;

        try {
            $ldapConnection = ldap_connect($xml->ldap->ldapServer);
        }
        catch (\Exception $e) {
            Log::error('Error while connecting to LDAP server, error = '.$e->getMessage());
            throw new LdapConnectError();
        }

        if ($ldapConnection) {
            ldap_set_option($ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldapConnection, LDAP_OPT_REFERRALS, 0);
            $bind = false;

            try {
                $bind = ldap_bind($ldapConnection, $xml->ldap->ldapUsername, $xml->ldap->ldapPassword);
            }
            catch (\Exception $e) {
                Log::error('Error while binding to LDAP server for user credentials username => '.$xml->ldap->ldapUsername.' , password: '.$xml->ldap->ldapUsername.' , error => '.$e->getMessage());
                throw new LdapBindError();
            }

            if ($bind) {
                // Perform LDAP search for user trying to login
                $searchBase = "dc=example,dc=com"; //Default search base
                $searchFilter = "(uid=$username)"; // Search filter for username
                $searchAttributes = ["dn", "cn", "sn", "mail"]; // Attributes to retrieve

                $ldapSearch = ldap_search($ldapConnection, $searchBase, $searchFilter, $searchAttributes);
                $ldapResult = ldap_get_entries($ldapConnection, $ldapSearch);

                $userDn = $ldapResult[0]['dn'];

                try {
                    $userBind = ldap_bind($ldapConnection, $userDn, $password);
                }
                catch (\Exception $e) {
                    Log::error('Error while binding user to LDAP server, email => '.$username.' , error => '.$e->getMessage());
                    throw new LdapUserBindError();
                }

                if($userBind){
                    $groups = [];
                    foreach ($xml->permissions->groupName as $groupName) {
                        $groups[] = (string)$groupName;
                    }
                    $userInGroups = false;

                    // Loop through each group to check membership
                    foreach ($groups as $desiredGroup) {
                        $groupSearchFilter = "(&(objectClass=user)(sAMAccountName=$username) (memberof=CN=$desiredGroup,OU=Access Groups,$searchBase))";
                        $groupSearch = ldap_search($ldapConnection, $searchBase, $groupSearchFilter, ["cn"]);
                        $groupEntries = ldap_get_entries($ldapConnection, $groupSearch);

                        // Check if the user is a member of the current group
                        if ($groupEntries['count'] > 0) {
                            // User is a member of the current group
                            $userInGroups = true;
                            break; // Exit the loop since user is already found in a group
                        }
                    }

                    if($userInGroups){
                        $ldapUser = [
                            "username" => $username,
                            "email" => $ldapResult[0]['mail'][0],
                            "full_name" => $ldapResult[0]['cn'][0],
                            "last_name" => $ldapResult[0]['sn'][0]
                        ];
                    }
                    else{
                        Log::error("User: $username is not found in required groups!");
                        throw new LdapUserNotInGroups();
                    }
                }
                else{
                    Log::error('Error while binding user to LDAP server, email => '.$username);
                    throw new LdapUserBindError();
                }


                ldap_unbind($ldapConnection);
            }
            else{
                Log::error('Error while binding to LDAP server for user credentials username => '.$xml->ldap->ldapUsername.' , password: '.$xml->ldap->ldapUsername);
                throw new LdapBindError();
            }
        }
        else{
            Log::error('Error while connecting to LDAP server.');
            throw new LdapConnectError();
        }

        return $ldapUser;
    }

    /**
     * @throws LdapBindError
     * @throws LdapUserBindError
     * @throws UserNotFound
     * @throws LdapConnectError
     * @throws LdapUserNotInGroups
     */
    public function login($email, $password){
        $user = null;

        if(App::environment('production')){
            $ldapUser = $this->getUserFromLdap($email, $password);
            $user = User::query()->firstOrCreate([
                'name' => str_replace($ldapUser['last_name'], '', $ldapUser['full_name']),
                'last_name' => $ldapUser['last_name'],
                'email' => $ldapUser['email']
            ])->first();
            $user->loadCount('unsavedProjects');
        }

        if (App::environment( 'local', 'staging')) {
            $user = User::query()->where([
                'email' => $email,
                'password' => md5($password)
            ])
                ->withCount('unsavedProjects')
                ->first();
        }

        if($user == null){
            Log::error('User not found, email: '.$email);
            throw new UserNotFound();
        }

//        return dd($user->toArray());

        return new UserDto($user->toArray());
    }

    public function getUserId($id){
        $user = User::query()->where([
            'id' => $id
        ])
        ->withCount('unsavedProjects')
        ->first();

        return new UserDto($user->toArray());
    }

    public static function getUserIdStatic($id){
        $user = User::query()->where([
            'id' => $id
        ])
            ->withCount('unsavedProjects')
            ->first();

        return new UserDto($user->toArray());
    }

    public function editUser(array $attributes){
        try {
            $user = User::query()->findOrFail(session()->get('user')->id);
            $updated = $user->fill($attributes)->save();

            if (!$updated) {
                throw new UserNotEdited('Record could not be updated!');
            }

            return $user;
        } catch (\Exception $e) {
            throw new UserNotEdited($e->getMessage());
        }
    }
}
