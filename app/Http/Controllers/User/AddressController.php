<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAddressRequest;
use App\Models\Province;
use App\Models\User;
use App\Models\UserInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AddressController extends Controller
{
    public function index(User $user)
    {
        $provinces = Province::all();

        return Inertia::render('Address', [
            'userEmail' => $user->email,
            'provinces' => $provinces,
        ]);
    }

    public function store(StoreAddressRequest $request, User $user)
    {
        $inputs = $request->validated();

        $information = $user->informations()->create([
            'address' => $inputs['address'],
            'ste' => $inputs['ste'] ?? null,
            'city' => $inputs['city'],
            'province_id' => $inputs['province_id'],
            'zip' => $inputs['zip'],
        ]);

        foreach ($inputs['insurances'] as $key => $value) {
            UserInsurance::create([
                'user_id' => $user->id,
                'insurance_id' => $value,
                'information_id' => $information->id,
            ]);
        }

        return to_route('home');
    }
}
