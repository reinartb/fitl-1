<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SEPP;
use App\Item;
use DB;

class SEPPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sepp.create', [
            'sepp' => new SEPP
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
        // Check if current SEPP combination has already been inputted.

        $sepp_check = SEPP::where('year', $request->year)
            ->where('section_id', $request->section_id)
            ->where('item_id', $request->item_id);

        if ( $sepp_check->count() ) {
            
            $message = 'You already inputted the SEPP values for this item and section for the year '. $request->year . '.';

            return redirect()
                ->back()
                ->with('message', $message)
                ->withInput();
        }
        
        $sepp = new SEPP;

        // Set the new SEPP values with inputted values.
        $sepp->year          =       $request->year;
        $sepp->item_id       =       $request->item_id;
        $sepp->section_id    =       $request->section_id;
        $sepp->q1_quantity   =       $request->q1_quantity;
        $sepp->q2_quantity   =       $request->q2_quantity;
        $sepp->q3_quantity   =       $request->q3_quantity;
        $sepp->q4_quantity   =       $request->q4_quantity;
            

        if ( ! $sepp->save() ) {
            return redirect()
                ->back()
                ->with('errors', $sepp->getErrors())
                ->withInput();
        }

        // Object saves successfully.
        $message = 'New SEPP data for Item ID ' . $request->item_id . ' and Section ID ' . $request->section . ' for the Year ' . $request->year . ' was submitted successfully!';

        return redirect()
            ->action('SEPPController@create')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function modal_store(Request $request) {
        $sepp_check = SEPP::where('year', $request->year)
            ->where('section_id', $request->section_id)
            ->where('item_id', $request->item_id);

        if ( $sepp_check->count() ) {
            
            $message = 'You already inputted the SEPP values for this item and section for the year '. $request->year . '.';

            return response()
                ->json([
                    'status' => 'success',
                    'msg' => $message
                    ]);
        }
        
        $sepp = new SEPP;

        // Set the new SEPP values with inputted values.
        $sepp->year          =       $request->year;
        $sepp->item_id       =       $request->item_id;
        $sepp->section_id    =       $request->section_id;
        $sepp->q1_quantity   =       $request->q1_quantity;
        $sepp->q2_quantity   =       $request->q2_quantity;
        $sepp->q3_quantity   =       $request->q3_quantity;
        $sepp->q4_quantity   =       $request->q4_quantity;
            

        if ( ! $sepp->save() ) {

            return response()
                ->json([
                    'status' => 'success',
                    'real_status'=> 'failed',
                    'msg' => $sepp->getErrors()
                    ]);
        }

        // Object saves successfully.
        $message = 'New SEPP data for Item ID ' . $request->item_id . ' and Section ID ' . $request->section_id . ' for the year ' . $request->year . ' was submitted successfully!';

        $response = [
            'status' => 'success',
            'real_status' => 'success',
            'msg' => $message
        ];  

        return response()->json($response);
    }

    public function seppsearch(Request $request) {
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

        // SEPP Values are present.

        $requests = $item_requested->requests()->where('requested_by_section', $request->section_id)->get();


        $message = 'SEPP valus for item '. $item_requested->name . ' was found.';

        $response = [
            'status' => 'success',
            'sepp' => 'yes',
            'msg' => $message,
            'item_id' => $item_requested->id,
            'item_name' => $item_requested->name,
            'sepp_q1' => $sepp->q1_quantity,
            'sepp_q2' => $sepp->q2_quantity,
            'sepp_q3' => $sepp->q3_quantity,
            'sepp_q4' => $sepp->q4_quantity,
            'requests' => $requests
        ];  

        // Pass the response as a JSON object.
        return response()->json($response);


    }

}
