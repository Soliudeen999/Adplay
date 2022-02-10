<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    
    public function store(Request $request)
    {
        $new =  Newsletter::create([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return response([
            'success' => true
        ]);
    }
}
