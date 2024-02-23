<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function send_request(){
        return redirect('/')->with('success','Request sent successfully!');
    }

    public function clearSession()
    {
        $key = 'session_ip';
        Cache::forget($key);
        return redirect()->back()->with('success', 'Session cleared successfully!');
    }
}
