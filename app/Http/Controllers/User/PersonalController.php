<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StorePersonalRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        return inertia('Personal');
    }

    public function store(StorePersonalRequest $request)
    {
        $inputs = $request->validated();

        $user = User::where('email', $inputs['email'])->first();

        if ($user) {
            $user->update($inputs);
        } else {
            $user = User::create($inputs);
        }

        return to_route('address.index', $user->id);
    }
}
