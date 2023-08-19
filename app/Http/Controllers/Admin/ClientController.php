<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ClientController extends Controller
{

       /** * Display a list of clients with the specified role.
        *  */

    public function index(){
        // Retrieve all users with the role
        $clients = User::where('role', User::USER)->get();

        return view('admin.clients.index', compact('clients'));
    }

       /**
 * Edit user and send to view.
 */


    public function Edit(User $client){
        // Retrieve all products
        $products = Product::get();

        return view('admin.clients.edit', compact('client', 'products'));
    }


    /**
 * Update and assign special prices for products to a specific client.
 */

    public function assingPrice( Request $request){
        $client=User::whereId($request->client_id)->first();
        //Empty array for assign value
        $dataToUpdate = [];

         //iterating request input and push into empty array
        foreach ($request->product_ids as $key => $productId) {
            $productData = [
                'special_price' => $request->prices[$key],
            ];
            $dataToUpdate[$productId] = $productData;
        }
        dd($dataToUpdate);
         //Assgining prices to clients for specific products
        $client->prices()->sync($dataToUpdate);

        return redirect()
            ->route('client.Index')
            ->with('success', 'Price Assigned Successfully!');
    }

}
