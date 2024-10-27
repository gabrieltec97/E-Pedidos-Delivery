<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;
use Illuminate\Http\Request;

class NeighbourhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $neighbourhoods = Neighbourhood::all();
        return view('Neighbourhoods.neighbourhoods', [
            'neighbourhoods' => $neighbourhoods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Neighbourhoods.new-neighbourhood');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $neighbourhood = new Neighbourhood();
        $neighbourhood->name = $request->name;
        $neighbourhood->taxe = $request->taxe;
        $neighbourhood->time = $request->time;

        if ($request->is_available == 'on'){
            $neighbourhood->is_available = true;
        }else{
            $neighbourhood->is_available = false;
        }

        $neighbourhood->save();
        return redirect()->route('bairros.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $neighbourhood = Neighbourhood::find($id);
        return view('Neighbourhoods.edit-neighbourhood',[
            'neighbourhood' => $neighbourhood
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $neighbourhood = Neighbourhood::find($id);
        $neighbourhood->name = $request->name;
        $neighbourhood->taxe = $request->taxe;
        $neighbourhood->time = $request->time;

        if ($request->is_available == 'on'){
            $neighbourhood->is_available = true;
        }else{
            $neighbourhood->is_available = false;
        }

        $neighbourhood->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $neighbourhood = Neighbourhood::find($id);
        $neighbourhood->delete();

        return redirect()->route('bairros.index');
    }
}
