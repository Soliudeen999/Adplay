<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Newsletter;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::paginate();
        $newsletters = Newsletter::paginate();

        return view('users.index', compact('newsletters'));
    }
}
