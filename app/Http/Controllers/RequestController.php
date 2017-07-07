<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Request as RequestObject;
use App\Item;
use App\ItemCart;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requests.index', ['requests' =>  RequestObject::all()]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search($id, Request $request) {

        // echo $id;
        // echo $request->q;

    }


    public function create()
    {

        ItemCart::getQuery()->delete();

        return view('requests.create', [
            'request' => new RequestObject,
            'item' => Item::pluck('name', 'id')
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestobject = new RequestObject;

        // Set the request's object from the submitted form data.

        $requestobject->ris_number            = $request->ris_number;
        $requestobject->requested_by_user     = $request->requested_by_user;
        $requestobject->requested_by_section  = $request->requested_by_section;
        $requestobject->purpose               = $request->purpose;


        $cart_items = ItemCart::all();
        $cart_items_array = $cart_items->pluck('item_id');

        // Create the new request in the database.
        //If code is not successful.
        if(!$requestobject->save()) {
            //Redirect back to the create page and pass the errors.
            return redirect()
                ->back()
                ->with('errors', $requestobject->getErrors())
                ->withInput();
        }

        // Object successfully created.
        $requestobject->items()->sync($cart_items_array);

        // When new request is completed successfully, all temporary request cart data gets deleted.
        ItemCart::getQuery()->delete();
        
        $message = 'Request by ' . $requestobject->requested_by_user . ' from ' . $requestobject->requested_by_section . ' Section with the RIS Number ' . $requestobject->ris_number . ' was submitted successfully!';

        return redirect()
            ->action('RequestController@index')
            ->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = RequestObject::findOrFail($id);

        // $s = $request->items;


        // echo '<pre>';
        // print_r($s->quantity_requested);
        // echo '</pre>';

        // exit;

        return view('requests.show', [
            'request' =>  RequestObject::findOrFail($id),
            'items' => Item::all()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    

        /** 
            When edit page  is opened, all temporary request cart data
            gets deleted and gets filled with the current items in the
            request.           

        **/
        ItemCart::getQuery()->delete();

        $requestobject = RequestObject::findOrFail($id);

        foreach ($requestobject->items as $item) {
            $cart_item = new ItemCart;
            $cart_item->item_id = $item->id;

            if( ! $cart_item->save() ) { // If save fails, run the code below.
                // Redirect back to the create page and pass the errors.
                return redirect()
                    ->back()
                    ->with('errors', $cart_item->getErrors())
                    ->withInput();
                }
        }

        return view('requests.edit', [
            'request' => $requestobject
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $requestobject = RequestObject::findOrFail($id);

         // Set the request's object from the submitted form data.

        $requestobject->ris_number            = $request->ris_number;
        $requestobject->requested_by_user     = $request->requested_by_user;
        $requestobject->requested_by_section  = $request->requested_by_section;
        $requestobject->purpose               = $request->purpose;

        $cart_items = ItemCart::all();
        $cart_items_array = $cart_items->pluck('item_id');

        $requestobject->items()->sync($cart_items_array);

        if (!$requestobject->save()) {
            //Redirect back to the create page and pass the errors.
            return redirect()
                ->back()
                ->with('errors', $requestobject->getErrors())
                ->withInput();
        }   

         // Object successfully created.

        $message = 'Request by ' . $requestobject->requested_by_user . ' from ' . $requestobject->requested_by_section . ' Section with the RIS Number ' . $requestobject->ris_number . ' was updated successfully!';

        // Delete all items in temporary cart after completing update.
        ItemCart::getQuery()->delete();

        return redirect()
            ->action('RequestController@show', $requestobject->id)
            ->with('message', $message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requestobject = RequestObject::findOrFail($id);
        
        $message = 'Request by ' . $requestobject->requested_by_user . ' from ' . $requestobject->requested_by_section . ' Section with the RIS Number ' . $requestobject->ris_number . ' was deleted successfully!';

        $requestobject->delete();

        // Delete all items in temporary cart after completing delete.
        ItemCart::getQuery()->delete();

        return redirect()
            ->action('RequestController@index')
            ->with('message', $message);

    }

    public function find(Request $request) {

        $term = $request->q;

        if (empty($term)) {
            return response()->json([]);
        }

        $items = Item::where('name', 'LIKE', '%' . $term . '%')->get();

        foreach ($items as $item) {
            $item_list[] = ['id' => $item->id, 'text' => $item->name];
        }

        if (empty($item_list)) {
            return response()->json([]);
        }

        return response()->json($item_list);



        // if (is_null($term)) {
        //    echo 'Search Invalid.';
        // } else {
        //     $items = Item::where('name', 'LIKE', "%{$term}%")
        //                     ->get();
            

            // foreach ($items as $item) {
            //      echo $item->name;
            //      echo '<br>';
            // }
            // exit;

            
            // Return View For Intial Test 
            // return view('requests.partials.sampleajax')->with('items', $items);

            // Return View For AJAX Test

    }

    public function addToCart(Request $request) {

        // Search for the item object of the item requested.
        $item_requested = Item::findOrFail($request->item_id);

        // Create new item object in the temporary cart.
        $cart = new ItemCart;

        // Set the cart's object from the submitted form data.
        $cart->item_id            =     $item_requested->id;


        // Try saving the new cart item.
        if( ! $cart->save() ) { // If save fails, run the code below.

        // Redirect back to the create page and pass the errors.
            return response()
                ->json([
                    'status' => 'success',
                    'msg' => $cart->getErrors()
                    ]);
        }

        // Object successfully created.
        $message = 'Item named '. $item_requested->name . ' with ID ' . $item_requested->id . ' was added to cart.';

        $response = [
            'status' => 'success',
            'msg' => $message,
            'item_id' => $item_requested->id,
            'item_name' => $item_requested->name
        ];  

        // Pass the response as a JSON object.
        return response()->json($response);
    }

    public function deleteCartItem(Request $request)
    {    
        $cart_item = ItemCart::findOrFail($request->item_id);
        
        $message = 'Item was successfully removed from cart!';

        $cart_item->delete();

        $response = [
            'status' => 'success',
            'msg' => $message
        ];  

        // Pass the response as a JSON object.
        return response()->json($response);

    }

}
