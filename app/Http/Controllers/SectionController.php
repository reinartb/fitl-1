<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view ('sections.index', ['sections' => Section::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('sections.create', [
            'section' => new Section  
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
        $section = new Section;

        $section->short_name       =    $request->short_name;
        $section->long_name        =    $request->long_name;

        if ( !$section->save() ) {
            return redirect()
                ->back()
                ->with('errors', $section->getErrors())
                ->withInput();
        }

        $message = 'New section with the code ' . $section->short_name . '  has successfully been added to the database.';

        return redirect()
            ->route('sections.index')
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

        return view('sections.show', [
            'section' => Section::findOrFail($id)
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
        return view('sections.edit', 
            [
                'section' => Section::findOrFail($id)
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
        $section = Section::findOrFail($id);

        $section->short_name        =   $request->short_name;
        $section->long_name         =   $request->long_name;

        if ( ! $section->save() ) {
            return redirect()
                ->back()
                ->with('errors', $section->getErrors())
                ->withInput();
        }

        $message = 'Section with code ' . $section->short_name . ' was successfully updated.';

        return redirect()
            ->route('sections.index')
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
        $section = Section::findOrFail($id);

        $message = 'Section with code ' . $section->short_name . ' has been deleted successfully.';

        $section->delete();

        return redirect()
            ->action('SectionController@index')
            ->with('message', $message);

    }

    public function find (Request $request) {

        $term = $request->q;

        if (empty($term)) {
            return response()->json([]);
        }


        $sections = Section::where('short_name', 'LIKE', '%' . $term . '%')->orWhere('long_name', 'LIKE', '%' . $term . '%')->get();

        foreach ($sections as $section) {
            $section_list[] = ['id' => $section->id, 'text' => $section->short_name . ' - ' . $section->long_name];
        }

        if (empty($section_list)) {
            return response()->json([]);
        }

        return response()->json($section_list);

    }


}
