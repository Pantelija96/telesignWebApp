<?php

namespace App\Http\Controllers;

use App\Services\CodesService;
use Illuminate\Http\Request;

class CodesController extends Controller
{
    private $codeService;

    public function __construct(CodesService $codeService){
        $this->codeService = $codeService;
    }

    public function getCodes(Request $request){
        $codes = $this->codeService->getCodes($request->get('codes'));
        return $codes;
    }
}
