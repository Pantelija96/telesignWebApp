<?php

namespace App\Services;

use App\Models\Codes;

class CodesService
{

    public function getCodes($codes){
        $fetchedCodes = [];


        foreach ($codes as $code){
            $fetchedCode = Codes::query()->where("code", "=", $code)->first();
            $obj = [
                $fetchedCode->traffic_type,
                $fetchedCode->code,
                "<p class='oneNumberCapitalize'>".$fetchedCode->name."</p>",
                $fetchedCode->risk == true ? "<i class='ph-x-circle text-danger ph-2x'></i>" : "",
                $fetchedCode->trust == true ? "<i class='ph-check-circle text-success ph-2x'></i>" : "" ,
                "<a href='#' onclick='showReadMore(`".$fetchedCode->description."`)'><i class='ph-book-open ph-2x text-primary'></i></a>",
            ];
            $fetchedCodes[] = $obj;
        }

        return $fetchedCodes;
    }
}
