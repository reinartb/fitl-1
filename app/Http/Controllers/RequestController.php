<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Request as RequestObject;
use App\Item;
use App\ItemCart;
use App\Section;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requests.index', ['requests' =>  RequestObject::paginate(10)]);   
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

        $cart_items_item_id = $cart_items->pluck('item_id')->toArray();

        $cart_items_quantity_requested = $cart_items->pluck('quantity_requested')->toArray();
        
        $cart_item_combine = array_combine($cart_items_item_id, $cart_items_quantity_requested);

        $sync = [];


        foreach ($cart_item_combine as $x => $y) {
            $sync[$x] = ['quantity_requested' => $y];
        }

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
        $requestobject->items()->sync($sync);

        // When new request is completed successfully, all temporary request cart data gets deleted.
        ItemCart::getQuery()->delete();
        


        $message = 'Request by ' . $requestobject->requested_by_user . ' from ' . $requestobject->section->long_name . ' Section with the RIS Number ' . $requestobject->ris_number . ' was submitted successfully!';

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
        $section = $requestobject->section;

        foreach ($requestobject->items as $item) {
            $cart_item = new ItemCart;
            $cart_item->item_id = $item->id;
            $cart_item->quantity_requested = $item->quantity_requested;

            if( ! $cart_item->save() ) { // If save fails, run the code below.
                // Redirect back to the create page and pass the errors.
                return redirect()
                    ->back()
                    ->with('errors', $cart_item->getErrors())
                    ->withInput();
                }
        }

        return view('requests.edit', [
            'request' => $requestobject,
            'section' => $section
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

        $cart_items_item_id = $cart_items->pluck('item_id')->toArray();

        $cart_items_quantity_requested = $cart_items->pluck('quantity_requested')->toArray();
        
        $cart_item_combine = array_combine($cart_items_item_id, $cart_items_quantity_requested);

        $sync = [];


        foreach ($cart_item_combine as $x => $y) {
            $sync[$x] = ['quantity_requested' => $y];
        }

        $requestobject->items()->sync($sync);

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


        $message = 'Request by ' . $requestobject->requested_by_user . ' from ' . $requestobject->section->long_name . ' Section with the RIS Number ' . $requestobject->ris_number . ' was updated successfully!';

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
        
        $message = 'Request by ' . $requestobject->requested_by_user . ' from ' . $requestobject->section->long_name . ' Section with the RIS Number ' . $requestobject->ris_number . ' was deleted successfully!';

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

    }

    public function addToCart(Request $request) {

        // Search for the item object of the item requested.
        $item_requested = Item::findOrFail($request->item_id);

        // Get SEPP values of item w/ selected section.
        $sepp = $item_requested->sepp()->where('section_id', $request->section_id)->first();

        // Check if SEPP has values or not.
        if ( is_null($sepp) ) {
            $response = [
                'status' => 'success',
                'sepp' => 'no',
                'item_id' => $item_requested->id,
                'item_name' => $item_requested->name
            ];

            return response()->json($response);
        }

        // Gets all item ids of items already in cart.
        $cart = ItemCart::all()->pluck('item_id');

        // Checks if item to be added into cart is already inside the cart.
        foreach ($cart as $c) {
            if ($c == $request->item_id) {
                $response = [
                    'status' => 'fail',
                    'msg' => 'Item already exists inside request.'
                ];

                return response()->json($response);
            }
        }
        
        // Create new item object in the temporary cart.
        $item_cart = new ItemCart;


        // Set the cart's object from the submitted form data.
        $item_cart->item_id            =     $item_requested->id;


        // Try saving the new cart item.
        if( ! $item_cart->save() ) { // If save fails, run the code below.

        // Redirect back to the create page and pass the errors.
            return response()
                ->json([
                    'status' => 'success',
                    'msg' => $item_cart->getErrors()
                    ]);
        }

        // Object successfully created.
        $message = 'Item named '. $item_requested->name . ' with ID ' . $item_requested->id . ' was added to the request.';

        $response = [
            'status' => 'success',
            'sepp' => 'yes',
            'msg' => $message,
            'item_id' => $item_requested->id,
            'item_name' => $item_requested->name,
            'sepp_q1' => $sepp->q1_quantity,
            'sepp_q2' => $sepp->q2_quantity,
            'sepp_q3' => $sepp->q3_quantity,
            'sepp_q4' => $sepp->q4_quantity
        ];  

        // Pass the response as a JSON object.
        return response()->json($response);
    }

    public function deleteCartItem(Request $request)
    {    

        $cart_item = ItemCart::where('item_id', $request->item_id)->first();

        $message = 'Item with ID '. $cart_item->item_id .' was successfully removed from the request!';

        $cart_item->delete();

        $response = [
            'status' => 'success',
            'msg' => $message
        ];  

        // Pass the response as a JSON object.
        return response()->json($response);

    }

    public function submitRequest (Request $request)
    {

        $cart = ItemCart::all();

        $newarray = array_combine($request->item_id, $request->quantity_requested);

        // Checks if item to be added into cart is already inside the cart.
        foreach ($newarray as $k => $v) {
            foreach ($cart as $c) {
                if ($c->item_id == $k) {
                    $c->quantity_requested = $v;
                    $c->save();
                }
            }
        }

        return response()->json([
                'status' => 'success'
            ]);


    }

}