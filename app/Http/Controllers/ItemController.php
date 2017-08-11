<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Request as RequestObject;
use App\Item;
use App\SEPP;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('items.index', ['items' => Item::orderby('created_at', 'asc')->paginate(10)] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('items.create', ['item' => new Item]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item;

        $item->name         =      $request->name;

        if ( ! $item->save() ) {
            return redirect()
                ->back()
                ->with('errors', $item->getErrors())
                ->withInput();
        }

        $message = 'New item "' . $item->name . '" has successfully been created.';

        return redirect()
            ->route('items.index')
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

        $item = Item::findOrFail($id);

        return view('items.show', [
            'item' => Item::findOrFail($id)
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

        return view('items.edit', ['item' => Item::findOrFail($id)]);

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
        
        $item = Item::findOrFail($id);

        $old_item_name      = $item->name;

        $item->name         =   $request->name;

        if ( ! $item->save() ) {
            return redirect()
                ->back()
                ->with('errors', $item->getErrors())
                ->withInput();
        }

        $message = 'The item "' . $old_item_name .'" has been renamed to "' . $item->name . '" successfully.';

        return redirect()
            ->route('items.index')
            ->with('message', $message); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $item = Item::findOrFail($id);

        $message = 'The item "' . $item->name . '" has been deleted successfully.';

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('message', $message);


    }

    public function modal_store(Request $request) {

        $item = new Item;

        $item->name         =      $request->name;


        if ( ! $item->save() ) {

            return response()
                ->json([
                    'status' => 'success',
                    'real_status' => 'failed',
                    'msg' => $item->getErrors()
                    ]);
        }

        // Object saves successfully.
        $message = 'New item "' . $item->name . '" has successfully been created.';

        $response = [
            'status' => 'success',
            'real_status' => 'success',
            'item_id' => $item->id,
            'msg' => $message
        ];  

        return response()->json($response);

    }
}
