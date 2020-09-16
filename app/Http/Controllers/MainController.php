<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getSubCategories($id) {
        return response(SubCategory::where('category_id', $id)->get());
    }
}
