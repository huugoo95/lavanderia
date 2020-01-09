<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Return a register view
     *
     */
    protected function index()
    {
        return view('customers/index');
    }
    
}
