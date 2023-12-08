<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin.auth']);
    }
    
    public function __invoke()
    {
        return inertia('Dashboard');
    }
}
