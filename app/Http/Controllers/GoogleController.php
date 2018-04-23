<?php

namespace App\Http\Controllers;
use App\Appmodel;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoogleController extends Controller
{
	public function index(){
		return view('welcome');
	}
	public function loginwithgoogle(){
		return view('welcome');
	}
  
}
