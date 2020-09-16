<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index($id)
    {
        $notes = Category::find($id)->notes()->paginate(5);

        return Inertia::render("Dashboard/Index", [
            'categories' => Category::all(),
            'notes' => $notes
        ]);
    }
}