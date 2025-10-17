<?php

namespace App\Http\Controllers;

use App\Models\ItemsCategories;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = ItemsCategories::all();

        return view('dashboard', compact('categories'));
        
    }
}
