<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\BuyInsuranceRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InsuranceController extends Controller
{
    public function buy(BuyInsuranceRequest $request)
    {
        $inputs = $request->validated();

        return Inertia::render('Personal');
    }
}
