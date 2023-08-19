<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a list of products with their associated special prices.
     * */
    public function index()
    {
        $products = Product::with('specialPrices')->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Display the product creation form.
     * */

    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in the database.
     * */

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'image' => 'required',
        ]); // validtating atributes
        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
        }
        // Process the uploaded image file, if provided
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $location = public_path('assets/productimage');
            $request->image->move($location, $name);
        }
        // Create a new product entry in the database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'image_path' => $name,
            'status' => $request->status,
        ]);
        return redirect()
            ->route('product.Index')
            ->with('success', 'Product created!');
    }
    /**
     * Display the specific product update form.
     * */

    public function edit($product)
    {
        $product=Product::whereId($product)->with('specialPrices')->first();
        return view('admin.products.edit', compact('product'));
    }
    
    /**
     * update product in the database.
     * */

    public function update(Product $product, Request $request)
    {
        // Validate the incoming request data
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'quantity' => 'required',
        ]); // validtating atributes
        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
        }
        // Process the uploaded image file, if provided
        if ($request->hasFile('image')) {
            // Check if the product has an associated image
            if (!empty($product->image_path)) {
                $public = str_replace('\\', '/', public_path());
                $path = $public . '/assets/productimage/' . $product->image_path;
                // If the file exists, delete it from the server
                if (File::exists($path)) {
                    unlink($path);
                }
            }
            $extension = $request->image->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $location = public_path('assets/productimage');
            $request->image->move($location, $name);
            $product->update(['image_path' => $name]);
        }

        // update product
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);
        return redirect()
            ->route('product.Index')
            ->with('success', 'Product Updated Successfully!');
    }

    /**
     * Delete a specific product from the database.
     * */
    public function delete(Product $product)
    {
        // Check if the product has an associated image
        if (!empty($product->image_path)) {
            // Construct the full path to the image file
            $public = str_replace('\\', '/', public_path());
            $path = $public . '/assets/productimage/' . $product->image_path;

            // If the file exists, delete it from the server
            if (File::exists($path)) {
                unlink($path);
            }
        }

        // Delete the product from the database
        $product->delete();

        return redirect()
            ->route('product.Index')
            ->with('success', 'Product Deleted Successfully!');
    }
}
