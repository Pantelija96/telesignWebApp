<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "code" => "20101",
                "name" => "no range activity",
                "description" => "Very little activity, or none at all, for a risky range that this number belongs to over the past 90 days. Also returned if the number does not belong to a risky range.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20102",
                "name" => "low range activity",
                "description" => "Some activity for a risky range that this number belongs to over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20103",
                "name" => "moderate short-term range activity",
                "description" => "Significant activity for a risky range that this number belongs to over the last 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20104",
                "name" => "moderate long-term range activity",
                "description" => "Significant activity for a risky range that this number belongs to over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20105",
                "name" => "high short-term range activity",
                "description" => "Very significant activity for a risky range that this number belongs to over the last 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20106",
                "name" => "high long-term range activity",
                "description" => "Very significant activity for a risky range that this number belongs to over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20107",
                "name" => "very high long-term range activity",
                "description" => "Extremely significant activity for a risky range that this number belongs to over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20108",
                "name" => "very high short-term range activity",
                "description" => "Extremely significant activity for a risky range that this number belongs to over the last 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20001",
                "name" => "no long-term activity",
                "description" => "Much less than expected activity, or none at all, for this number over the past 90 days.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20002",
                "name" => "high long-term activity",
                "description" => "More than expected activity for this number over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20003",
                "name" => "high short-term activity",
                "description" => "More than expected activity for this number over the last 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20004",
                "name" => "moderate long-term activity",
                "description" => "Expected activity for this number over the past 90 days.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20005",
                "name" => "moderate short-term activity",
                "description" => "Expected activity for this number over the last 24 hours.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20006",
                "name" => "sparse long-term activity",
                "description" => "Sparse, regular volume of verification traffic on this number over the past 90 days.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20007",
                "name" => "continuous long-term activity",
                "description" => "Continuous, regular volume of verification traffic on this number over the past 90 days.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20008",
                "name" => "very high long-term activity",
                "description" => "Very high volume of verification traffic on this number over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20009",
                "name" => "very high short-term activity",
                "description" => "Very high volume of verification traffic on this number over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20010",
                "name" => "no activity",
                "description" => "Very low volume of verification traffic, or none at all, was ever observed on this number.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20011",
                "name" => "low long-term activity",
                "description" => "Low volume of verification traffic on this phone number over the past 90 days.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20012",
                "name" => "low short-term activity",
                "description" => "Low volume of verification traffic on this phone number over the past 24 hours. Very low volume of verification traffic, or none at all over the past 90 days.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "20013",
                "name" => "low activity",
                "description" => "Less than expected activity for this number.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21001",
                "name" => "moderate activity on risky services",
                "description" => "Significant activity on this number to or from risky services over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21002",
                "name" => "high activity on risky services",
                "description" => "Very significant activity on this number to or from risky services over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21004",
                "name" => "long-term activity on risky services",
                "description" => "Verification traffic on risky services on this number over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21005",
                "name" => "short-term activity on risky services",
                "description" => "Verification traffic on risky services on this number over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21006",
                "name" => "high long-term activity on risky services",
                "description" => "High volume of verification traffic on risky services on this number over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21007",
                "name" => "high short-term activity on risky services",
                "description" => "High volume of verification traffic on risky services on this number over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21008",
                "name" => "long-term range activity on risky services",
                "description" => "Verification traffic on risky services on the range this number belongs to over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21009",
                "name" => "short-term range activity on risky services",
                "description" => "Verification traffic on risky services on the range this number belongs to over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21010",
                "name" => "high long-term range activity on risky services",
                "description" => "High volume of verification traffic on risky services on the range this number belongs to over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21011",
                "name" => "high short-term range activity on risky services",
                "description" => "High volume of verification traffic on risky services on the range this number belongs to over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21012",
                "name" => "very high short-term activity on risky services",
                "description" => "Very high volume of verification traffic on risky services on this number over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21013",
                "name" => "very high long-term activity on risky services",
                "description" => "Very high volume of verification traffic on risky services on this number over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21014",
                "name" => "very high short-term range activity on risky services",
                "description" => "Very high volume of verification traffic on risky services on the range this number belongs to over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21015",
                "name" => "very high long-term range activity on risky services",
                "description" => "Very high volume of verification traffic on risky services on the range this number belongs to over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21016",
                "name" => "machine-like range activity",
                "description" => "Extremely high volume of verification traffic in a very short period (less than 1 hour) on the range this number belongs to.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "21003",
                "name" => "machine-like activity",
                "description" => "Behavior pattern that suggests this number is being used by a bot. Although we expect a submitted number engaged in A2P traffic to communicate with automated systems",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "22001",
                "name" => "seen in the last 1 day",
                "description" => "This number was seen in verification traffic in the last 1 day.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "22007",
                "name" => "seen in the last 7 days",
                "description" => "This number was seen in verification traffic in the last 7 days.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "22015",
                "name" => "seen in the last 15 days",
                "description" => "This number was seen in verification traffic in the last 15 days.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "22101",
                "name" => "seen in the last 1 month",
                "description" => "This number was seen in verification traffic in the last 1 month.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "22102",
                "name" => "seen in the last 2 months",
                "description" => "This number was seen in verification traffic in the last 2 months.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "22103",
                "name" => "seen in the last 3 months",
                "description" => "This number was seen in verification traffic in the last 3 months.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "22203",
                "name" => "seen more than 3 months ago",
                "description" => "This number was not seen in verification traffic in the last 3 months.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "a2p"
            ],
            [
                "code" => "30201",
                "name" => "No P2P data analyzed",
                "description" => "P2P data was not analyzed. Cannot classify",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "p2p"
            ],
            [
                "code" => "40001",
                "name" => "premium number",
                "description" => "This is a premium number.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40002",
                "name" => "VOIP number",
                "description" => "This is a VOIP number.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40003",
                "name" => "toll-free number",
                "description" => "This is a toll-free number.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40004",
                "name" => "invalid number",
                "description" => "This is an invalid number.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40005",
                "name" => "payphone number",
                "description" => "This number is associated with a payphone.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40006",
                "name" => "voicemail number",
                "description" => "This is a voicemail number.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40007",
                "name" => "pager number",
                "description" => "This number is associated with a pager.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40008",
                "name" => "high-risk phone type",
                "description" => "This number has another phone type that is risky, and that is not covered by any of the other number_type reason codes.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40009",
                "name" => "high-risk carrier",
                "description" => "This number is associated with a very risky carrier.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40010",
                "name" => "medium-risk carrier",
                "description" => "This number is associated with a risky carrier.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40011",
                "name" => "high-risk prefix",
                "description" => "This number has a risky prefix.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40012",
                "name" => "phone too long",
                "description" => "This number is invalid because it is too long, even after the application of cleansing rules.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40013",
                "name" => "blacklisted number",
                "description" => "This number has been flagged as a source of fraud. Intelligence always recommends to block this number.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40014",
                "name" => "high-risk country",
                "description" => "The country code of this number is for a risky country, one that originates a disproportionate share of fraud attacks.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40015",
                "name" => "technical number",
                "description" => "This number is used for special technical purposes by telecom companies, such as for roaming.",
                "risk" => false,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40016",
                "name" => "number used by application",
                "description" => "Telesign reserved this number for use by customers with our applications (for example to send verification messages), but it appears that it is being used for a different purpose.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40017",
                "name" => "number whitelisted by customer",
                "description" => "You have flagged this number as safe. Intelligence always recommends to allow this number.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "40018",
                "name" => "phone too short",
                "description" => "This number is too short to be a valid phone number.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "number_type"
            ],
            [
                "code" => "50001",
                "name" => "moderate short-term activity",
                "description" => "Expected level of activity for this IP address over the last 24 hours.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50002",
                "name" => "moderate long-term activity",
                "description" => "Expected level of activity for this IP address over the past 90 days.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50003",
                "name" => "moderate short-term activity on risky services",
                "description" => "Significant activity for this IP address to or from risky services over the last 24 hours (see risky services above for definition of that term).",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50004",
                "name" => "moderate long-term activity on risky services",
                "description" => "Significant activity on this IP address to or from risky services over the last 90 days (see risky services above for definition of that term).",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50005",
                "name" => "high short-term activity",
                "description" => "More than expected activity for this IP address over the last 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50006",
                "name" => "high long-term activity",
                "description" => "More than expected activity for this IP address over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50007",
                "name" => "high short-term activity on risky services",
                "description" => "Very significant activity for this IP address to or from risky services over the last 24 hours (see risky services above for definition of that term).",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50008",
                "name" => "high long-term activity on risky services",
                "description" => "Very significant activity on this IP address to or from risky services over the last 90 days (see risky services above for definition of that term).",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50009",
                "name" => "very high short-term activity",
                "description" => "Very frequent changes of IP address attributes in verification traffic on this number over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50010",
                "name" => "very high long-term activity",
                "description" => "Very frequent changes of IP address attributes in verification traffic on this number over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50011",
                "name" => "short-term activity on risky services",
                "description" => "Changes of IP address attributes in verification traffic on risky services on this number over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50012",
                "name" => "long-term activity on risky services",
                "description" => "Changes of IP address attributes in verification traffic on risky services on this number over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50013",
                "name" => "very high short-term activity on risky services",
                "description" => "Very frequent changes of IP address attributes in verification traffic on risky services on this number over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "50014",
                "name" => "very high long-term activity on risky services",
                "description" => "Very frequent changes of IP address attributes in verification traffic on risky services on this number over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "ip"
            ],
            [
                "code" => "60001",
                "name" => "moderate short-term activity",
                "description" => "Expected level of activity for this email address over the last 24 hours.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "email"
            ],
            [
                "code" => "60002",
                "name" => "moderate long-term activity",
                "description" => "Expected level of activity for this email address over the past 90 days.",
                "risk" => false,
                "trust" => true,
                "traffic_type" => "email"
            ],
            [
                "code" => "60003",
                "name" => "moderate short-term activity on risky services",
                "description" => "Significant activity for this email address to or from risky services over the last 24 hours (see risky services above for definition of that term).",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60004",
                "name" => "moderate long-term activity on risky services",
                "description" => "Significant activity on this email address to or from risky services over the last 90 days (see risky services above for definition of that term).",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60005",
                "name" => "high short-term activity",
                "description" => "More than expected activity for this email address over the last 24-hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60006",
                "name" => "high long-term activity",
                "description" => "More than expected activity for this email address over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60007",
                "name" => "high short-term activity on risky services",
                "description" => "Very significant activity for this email address to or from risky services over the last 24 hours (see risky services above for definition of that term).",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60008",
                "name" => "high long-term activity on risky services",
                "description" => "Very significant activity on this email address to or from risky services over the last 90 days (see risky services above for definition of that term).",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60009",
                "name" => "very high short-term activity",
                "description" => "Very high volume of verification traffic on this email address over the past 24 hours.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60010",
                "name" => "very high long-term activity",
                "description" => "Very high volume of verification traffic on this email address over the past 90 days.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60011",
                "name" => "machine-generated email",
                "description" => "Behavior pattern that suggests this email address is being used by a software program.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60012",
                "name" => "invalid email",
                "description" => "This email address is invalid and could not have been used by a genuine end user.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "60013",
                "name" => "disposable email domain",
                "description" => "This email address may have originated from a service providing temporary email addresses; these temporary addresses can be used to conceal the identity of the end user.",
                "risk" => true,
                "trust" => false,
                "traffic_type" => "email"
            ],
            [
                "code" => "10010",
                "name" => "low activity",
                "description" => "Not enough activity or attributes to classify the transaction as either risky or trustworthy.",
                "traffic_type" => "category",
                "risk" => false,
                "trust" => false
            ],
            [
                "code" => "10020",
                "name" => "low regular activity",
                "description" => "Trustworthy category",
                "traffic_type" => "category",
                "risk" => false,
                "trust" => false
            ],
            [
                "code" => "10021",
                "name" => "regular activity",
                "description" => "Most trustworthy category",
                "traffic_type" => "category",
                "risk" => false,
                "trust" => false
            ],
            [
                "code" => "10030",
                "name" => "low-risk irregular activity",
                "description" => "Risky category",
                "traffic_type" => "category",
                "risk" => false,
                "trust" => false
            ],
            [
                "code" => "10031",
                "name" => "medium-risk irregular activity",
                "description" => "High-risk category",
                "traffic_type" => "category",
                "risk" => false,
                "trust" => false
            ],
            [
                "code" => "10032",
                "name" => "high-risk irregular activity",
                "description" => "Highest-risk category",
                "traffic_type" => "category",
                "risk" => false,
                "trust" => false
            ],
            [
                "code" => "10040",
                "name" => "irregular number type",
                "description" => "This number has risky static attributes (like VOIP phone type or being on a blocklist).",
                "traffic_type" => "category",
                "risk" => false,
                "trust" => false
            ]
        ];

        DB::table('codes')->insert($data);
    }
}
