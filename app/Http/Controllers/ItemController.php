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
        return view('items.index', ['items' => Item::orderby('created_at', 'asc')->get()] );
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

        // $sections = $item->sepp->groupBy('section_id');

        // $sectionss = SEPP::where('item_id', $id)->with(['section' => function($query){
        //     $query->groupBy('section_id');
        // }])->get();

        // $sepp = $item->sepp;

        // $i = 0;

        // foreach ($sepp as $s) {
        //     $i = $i + 1;    

        // }

        // $sections = $item->sepp->pluck('section_id');

        // $item->whereHas('sepp', function ($query) {
        //     $query->where('quarter', 'like' )
        // })



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
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        $message = 'The item "' . $item->name . '" has been deleted successfully.';

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('message', $message);


    }
}
