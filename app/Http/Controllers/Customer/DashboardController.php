<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    /**
     * Show the customer dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('customer_home');
    }
}
