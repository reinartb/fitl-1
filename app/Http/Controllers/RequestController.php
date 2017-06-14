<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Request as RequestObject;
use App\Item;

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

        return view('requests.show', ['request' =>  RequestObject::findOrFail($id)]);
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
}
