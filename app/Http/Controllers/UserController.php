<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index ()
    {
        return view('pages.user.index', [
            'user' => User::class
        ]);
    }
}
