<?php

namespace App\DataTransferObjects;

class ROIDto
{
    public $id;
    public $job_date;
    public $period_from;
    public $period_to;
    public $period_multiplier;
    public $roi;
    public $average_value_of_transaction;
    public $fraud_avoided_by;
    public $monthly_cost;
    public $other_costs_all_numbers;
    public $other_costs_fraud_numbers;
    public $total_cost;
    public $cost_per_phone;
    public $total_per_phone;
    public $average_sms;
    public $total_sms;
    public $other_savings;
    public $total_savings;

    public function __construct(array $roi){
        $this->id = $roi['id'];
        $this->job_date = $roi['job_date'];
        $this->period_from = $roi['period_from'];
        $this->period_to = $roi['period_to'];
        $this->period_multiplier = $roi['period_multiplier'];
        $this->roi = $roi['roi'];
        $this->average_value_of_transaction = $roi['average_value_of_transaction'];
        $this->fraud_avoided_by = $roi['fraud_avoided_by'];
        $this->monthly_cost = $roi['monthly_cost'];
        $this->other_costs_all_numbers = $roi['other_costs_all_numbers'];
        $this->other_costs_fraud_numbers = $roi['other_costs_fraud_numbers'];
        $this->total_cost = $roi['total_cost'];
        $this->cost_per_phone = $roi['cost_per_phone'];
        $this->total_per_phone = $roi['total_per_phone'];
        $this->average_sms = $roi['average_sms'];
        $this->total_sms = $roi['total_sms'];
        $this->other_savings = $roi['other_savings'];
        $this->total_savings = $roi['total_savings'];
    }
}
