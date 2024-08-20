@extends('layout')

@section('title') Project - ROI @endsection

@section('tempMenuItem')
    <li class="nav-item">
        <a href="#" class="nav-link active">
            <i class="ph-currency-dollar"></i><span>Project ROI</span>
        </a>
    </li>
@endsection

@section('pageName')
    <i class="ph-house me-2"></i> Project - ROI
@endsection

@section('additionalThemeJS')
    <script src="{{asset('/')}}assets/js/vendor/ui/moment/moment.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/pickers/daterangepicker.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/pickers/datepicker.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/visualization/echarts/echarts.min.js"></script>
@endsection

@section('additionalPageJS')
    <script>
        var fraudNumberManualy = parseInt({{$project->roi->fraud_transactions_avoided}});
    </script>
    <script src="{{asset('/')}}assets/js/roi21.js"></script>
@endsection

@section('pageTitle')
    Project - ROI
@endsection

@section('breadcrumb')
    <a href="{{url('/home/1')}}" class="breadcrumb-item">Projects</a>
    <span class="breadcrumb-item"><a href="{{url('/newProject').'/'.$project->id}}" class="breadcrumb-item">Project numbers</a></span>
    <span class="breadcrumb-item active">Project roi</span>
@endsection

@section('content')
    <div class="card">
        <div class="table-responsive p-1">
            <table class="table table-dark table-bordered table-striped table-hover text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Risk Band</th>
                    <th>Total volume</th>
                    <th>%</th>
                    <th>True positive rate</th>
                    <th>Fraud</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="bg-very-low">1</td>
                    <td>Very-low</td>
                    <td>
                        <input type="number" class="form-control roiNumberInput" id="veryLow" data-initial="{{$project->very_low}}" name="veryLow" value="{{$project->very_low}}" readonly>
                    </td>
                    <td>
                        {{round(floatval(($project->very_low/$project->records_count)*100),2)}}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-low">2</td>
                    <td>Low</td>
                    <td>
                        <input type="number" class="form-control roiNumberInput" id="low" data-initial="{{$project->low}}" name="low" value="{{$project->low}}" readonly>
                    </td>
                    <td>
                        {{round(floatval(($project->low/$project->records_count)*100),2)}}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-medium-low">3</td>
                    <td>Medium-low</td>
                    <td>
                        <input type="number" class="form-control roiNumberInput" id="mediumLow" data-initial="{{$project->medium_low}}" name="mediumLow" value="{{$project->medium_low}}" readonly>
                    </td>
                    <td>
                        {{round(floatval(($project->medium_low/$project->records_count)*100),2)}}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-medium">4</td>
                    <td>Medium</td>
                    <td>
                        <input type="number" class="form-control roiNumberInput" id="medium" data-initial="{{$project->medium}}" name="medium" value="{{$project->medium}}" readonly>
                    </td>
                    <td>
                        {{round(floatval(($project->medium/$project->records_count)*100),2)}}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg-high">5</td>
                    <td>High</td>
                    <td>
                        <input type="number" class="form-control roiNumberInput" id="high" data-initial="{{$project->high}}" name="high" value="{{$project->high}}" readonly>
                    </td>
                    <td>
                        {{round(floatval(($project->high/$project->records_count)*100),2)}}
                    </td>
                    <td>
                        <input type="number" class="form-control" id="highPositiveRate" name="highPositiveRate" onchange="calculate()" @if(!empty($project->high_positive_rate)) value="{{$project->high_positive_rate}}"  @else value="50" @endif max="100" min="0" step="1" style="text-align:center;">
                    </td>
                    <td>
                        <input type="number" class="form-control" id="highPositiveRateNumbers" name="highPositiveRateNumbers" style="text-align:center;" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="bg-very-high">6</td>
                    <td>Very-high</td>
                    <td>
                        <input type="number" class="form-control roiNumberInput" id="veryHigh" data-initial="{{$project->very_high}}" name="veryHigh" value="{{$project->very_high}}" readonly>
                    </td>
                    <td>
                        {{round(floatval(($project->very_high/$project->records_count)*100),2)}}
                    </td>
                    <td>
                        <input type="number" class="form-control" id="veryHighPositiveRate" name="veryHighPositiveRate" onchange="calculate()" @if(!empty($project->very_high_positive_rate)) value="{{$project->very_high_positive_rate}}"  @else value="90" @endif max="100" min="0" step="1" style="text-align:center;">
                    </td>
                    <td>
                        <input type="number" class="form-control" id="veryHighPositiveRateNumbers" name="veryHighPositiveRateNumbers" readonly style="text-align:center;">
                    </td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td>
                        <input type="number" class="form-control roiNumberInput" data-initial="{{$project->records_count}}" id="numberOfNumbers" name="numberOfNumbers" value="{{$project->records_count}}" readonly>
                    </td>
                    <td>100%</td>
                    <td></td>
                    <td>
                        <input type="number" class="form-control roiNumberInput" id="totalFraudNumbers" name="totalFraudNumbers" value="0" readonly>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">

        <form action="{{route('saveRoi')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="projectId" id="projectId" value="{{$project->id}}">
            <input type="hidden" name="roiId" id="projectId" value="{{$project->roi->id}}">
            <input type="hidden" name="highPositiveRateHidden" id="highPositiveRateHidden" @if(!empty($project->high_positive_rate)) value="{{$project->high_positive_rate}}" @else value="50" @endif>
            <input type="hidden" name="veryHighPositiveRateHidden" id="veryHighPositiveRateHidden" @if(!empty($project->very_high_positive_rate)) value="{{$project->very_high_positive_rate}}" @else value="90" @endif>
            <fieldset>
                <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Solution details</legend>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label" for="solutionDescription">Solution description:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" placeholder="Solution description" id="solutionDescription" name="solutionDescription" @if(!empty($project->description)) value="{{$project->description}}" @endif >
                    </div>
                    <label class="col-lg-3 col-form-label" for="jobDate">Job date:</label>
                    <div class="col-lg-3">
                        <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ph-calendar"></i>
                                </span>
                            <input type="text" class="form-control pick-date-basic" name="jobDate" id="jobDate" placeholder="Pick a job date" @if(!empty($project->roi->job_date)) value="{{date('m/d/Y', strtotime($project->roi->job_date)) }}" @else value="{{date('m/d/Y')}}" @endif>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label" for="customerName">Customer:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" placeholder="Customer name" id="customerName" name="customerName" @if(!empty($project->name)) value="{{$project->name}}" @endif>
                    </div>
                    <label class="col-lg-3 col-form-label" for="periodMultiplier">Period multiplier:</label>
                    <div class="col-lg-3">

                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control" min="1" placeholder="1" id="periodMultiplier" name="periodMultiplier" onchange="calculate()" @if(!empty($project->roi->period_multiplier)) value="{{$project->roi->period_multiplier}}" @else value="1" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-x-circle"></i>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 col-form-label" for="periodFrom">Period:</label>
                    <div class="col-lg-3">

                        <div class="input-group datepicker-range-one-side">
                            <input type="text" class="form-control" placeholder="From" name="periodFrom" id="periodFrom" onblur="drawLines()" @if(isset($project->roi->period_from)) value="{{date('m/d/Y',strtotime($project->roi->period_from))}}" @else value="{{date('m/d/Y')}}" @endif>
                            <input type="text" class="form-control" placeholder="To" name="periodTo" id="periodTo" onblur="drawLines()" @if(!empty($project->roi->period_to)) value="{{date('m/d/Y',strtotime($project->roi->period_to))}}" @else value="{{date('m/d/Y')}}" @endif>
                        </div>

                    </div>
                    <label class="col-lg-3 col-form-label" style="border-bottom: 2px solid white;" for="roi"><strong>ROI:</strong></label>
                    <div class="col-lg-3">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" style="outline: white; border: 2px solid white;" @if(!empty($project->roi->roi)) value="{{$project->roi->roi}}" @endif placeholder="0" id="roi" name="roi" readonly>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>

            <fieldset>
                <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Benefits - Fraud losses reduction</legend>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="transactionAvoided">Amount of fraudulent transaction avoided:</label>
                    <div class="col-lg-6">
                        <input type="number" placeholder="0" step="1" id="transactionAvoided" onchange="transactionAvoidedChanged()" name="transactionAvoided" class="form-control" @if(!empty($project->roi->fraud_transactions_avoided)) value="{{$project->roi->fraud_transactions_avoided}}" @else value="0" @endif>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="averageValOfTransaction">Average value of fraudulent transaction:</label>
                    <div class="col-lg-6">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" id="averageValOfTransaction" onchange="calculate()" name="averageValOfTransaction" @if(!empty($project->roi->average_value_of_transaction)) value="{{$project->roi->average_value_of_transaction}}" @else value="15.00" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="fraudAvoidedBy">Fraud avoided by XXXX:</label>
                    <div class="col-lg-6">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" id="fraudAvoidedBy" name="fraudAvoidedBy" @if(!empty($project->roi->fraud_avoided_by)) value="{{$project->roi->fraud_avoided_by}}" @endif readonly>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>

            <fieldset>
                <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Additional cost</legend>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="monthlyCost">Monthly cost of Telesign solution:</label>
                    <div class="col-lg-6">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" id="monthlyCost" onchange="calculate()" name="monthlyCost" @if(!empty($project->roi->monthly_cost)) value="{{$project->roi->monthly_cost}}" @else value="5000" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="otherCosts">Other costs - all numbers:</label>
                    <div class="col-lg-6">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" step="0.01" placeholder="0" id="otherCostsAllNumbers" onchange="calculate()" name="otherCostsAllNumbers" @if(!empty($project->roi->other_costs_all_numbers)) value="{{$project->roi->other_costs_all_numbers}}" @else value="0" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="otherCosts">Other costs - fraud numbers:</label>
                    <div class="col-lg-6">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" step="0.01" placeholder="0" id="otherCostsFraudNumbers" onchange="calculate()" name="otherCostsFraudNumbers" @if(!empty($project->roi->other_costs_fraud_numbers)) value="{{$project->roi->other_costs_fraud_numbers}}" @else value="0" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="totalCost">Total cost:</label>
                    <div class="col-lg-6">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" id="totalCost" name="totalCost" @if(!empty($project->roi->total_cost)) value="{{$project->roi->total_cost}}" @endif readonly>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>

            <fieldset>
                <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Additional savings</legend>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="costPerPhone">Cost per phone number lookup:</label>
                    <div class="col-lg-3">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.001" id="costPerPhone" onchange="calculate()" name="costPerPhone" @if(!empty($project->roi->cost_per_phone)) value="{{$project->roi->cost_per_phone}}" @else value="0.005" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.001" id="totalPerPhone" name="totalPerPhone" @if(!empty($project->roi->total_per_phone)) value="{{$project->roi->total_per_phone}}" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="averageSMS">Average SMS tansaction cost:</label>
                    <div class="col-lg-3">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.010" id="averageSMS" onchange="calculate()" name="averageSMS" @if(!empty($project->roi->average_sms)) value="{{$project->roi->average_sms}}" @else value="0.060" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.010" id="totalSMS" name="totalSMS" @if(!empty($project->roi->total_sms)) value="{{$project->roi->total_sms}}" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="otherSavings">Other savings:</label>
                    <div class="col-lg-6">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.01" id="otherSavings" onchange="calculate()" name="otherSavings" @if(!empty($project->roi->other_savings)) value="{{$project->roi->other_savings}}" @else value="0.00" @endif>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-6 col-form-label" for="totalSavings">Total savings:</label>
                    <div class="col-lg-6">
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="number" class="form-control closer-to-sign" placeholder="0" step="0.1" id="totalSavings" name="totalSavings" @if(!empty($project->roi->total_savings)) value="{{$project->roi->total_savings}}" @endif readonly>
                            <div class="form-control-feedback-icon">
                                <i class="ph-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>

            <div class="row d-flex flex-row-reverse">
                <div class="col-lg-4" style="text-align: right;">
                    <button type="submit" class="btn btn-primary">
                        Save project
                        <i class="ph-pencil-line ms-2"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>

    <div class="row mt-4">

        <div class="card">
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="line_zoom" style="height: 600px;"></div>
                </div>
            </div>
        </div>

    </div>
@endsection
