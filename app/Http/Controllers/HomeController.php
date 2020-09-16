<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render("Home/Index", [
            'categories' => Category::all()
        ]);
    }
}