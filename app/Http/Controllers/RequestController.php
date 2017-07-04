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

        $requestobject->items()->sync($request->item_id);
        
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

        return view('requests.edit', [
            'request' => RequestObject::findOrFail($id), 
            'item' => Item::pluck('name', 'id')
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


        $requestobject->items()->sync($request->item_id);

        if (!$requestobject->save()) {
            //Redirect back to the create page and pass the errors.
            return redirect()
                ->back()
                ->with('errors', $requestobject->getErrors())
                ->withInput();
        }   

         // Object successfully created.

        $message = 'Request by ' . $requestobject->requested_by_user . ' from ' . $requestobject->requested_by_section . ' Section with the RIS Number ' . $requestobject->ris_number . ' was updated successfully!';

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

        $cart = new ItemCart;

        // Set the cart's object from the submitted form data.
        $cart->item_id            =     $request->item_id; 

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
        $message = 'Item with ID ' . $request->item_id . ' was added to cart.';

        $response = [
            'status' => 'success',
            'msg' => $message
        ];  

        // Pass the response as a JSON object.
        return response()->json($response);
    }

    public function getitem (Request $request) {

        $itemcarts = ItemCart::all();
        // $itemcarts->pluck('item_id');

        foreach ($itemcarts as $iz) {
            $sample = Item::findOrFail($iz->item_id);
            $cart_list[] = ["item_id" => $iz->item_id, "name" => $sample->name];
        }

        return response()->json($cart_list);

    }

    public function submitcart (Request $request) {

        $newsample = json_decode($request->sample);

        foreach ($newsample as $x) {
            $carts[] = $x->item_id;
        }

        $requestobject = new RequestObject;

        // Set the request's object from the submitted form data.

        $requestobject->ris_number            = '1000-9991';
        $requestobject->requested_by_user     = 'John';
        $requestobject->requested_by_section  = 'ADMIN';
        $requestobject->purpose               = 'Sample';

        // Create the new request in the database.
        //If code is not successful.
        if(!$requestobject->save()) {
            //Redirect back to the create page and pass the errors.
           return response()
                ->json([
                    'status' => 'success',
                    'msg' => $cart->getErrors()
                    ]);
        }

        // Object successfully created.
        $requestobject->items()->sync($carts);

        $response = [
            'status' => 'success',
            'msg' => $carts
        ];  

        // Pass the response as a JSON object.
        return response()->json($response);

    }


}
