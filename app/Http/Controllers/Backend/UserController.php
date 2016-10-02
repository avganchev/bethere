<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('role:admin');
    }

    public function index()
    {
        return view('layouts.users');
    }
}
