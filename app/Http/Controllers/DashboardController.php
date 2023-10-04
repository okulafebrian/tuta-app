<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function __invoke()
    {
        if (auth()->user()->role_id === 1) {
            return inertia('Dashboard/Admin');
        } else {
            return inertia('Dashboard/User');
        }
    }
}
