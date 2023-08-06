<?php
// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 

class AdminController extends Controller
{
    public function index()
    {
        return view('adminlayout');
    }

}
