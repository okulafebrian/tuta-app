<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shoe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        return inertia('Home', [
            'shoes' => Shoe::all()
        ]);
    }
}
