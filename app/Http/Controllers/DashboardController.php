<?php
/*
  |App version 1.0
  |@author shariful islam khan
  
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Helper;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('dashboard.index');
    }

}
