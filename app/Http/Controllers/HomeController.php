<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shoe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $shoes = Shoe::with('category')->paginate(5);
        
        foreach ($shoes as $shoe) {
            $shoe['mainPhoto'] = $shoe->getMainPhoto();
        }

        return inertia('Home', [
            'shoes' => $shoes
        ]);
    }

    public function about()
    {
        return inertia('About');
    }
}
