<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
  /**
 * Display a list of products with their associated special prices for the user.

 */
public function index(){
    // Retrieve all products with their associated special prices
    $products = Product::with('specialPrices')->get();
    return view('user.index', compact('products'));
}

}
