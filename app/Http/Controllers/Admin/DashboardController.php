<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   /**
 * Display the dashboard for the admin user.
 */

    public function index(){
        return view('admin.dashboard');
    }
}
