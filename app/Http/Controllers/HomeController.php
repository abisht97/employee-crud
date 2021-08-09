<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class HomeController extends Controller
{
    public function index(){
    	$total = Employee::count();
    	$employees = Employee::simplePaginate(20);

    	return view('home', compact('total', 'employees'));
    }
}
