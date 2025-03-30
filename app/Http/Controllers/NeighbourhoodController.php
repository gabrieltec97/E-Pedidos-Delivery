<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function checkNeighbourhood(Request $request)
    {
        $check = DB::table('neighbourhoods')
        ->where('name', trim($request->input('local')))
        ->count();
        $return = '';
        $name = '';

        if($request->input('id') != null){
            $name = DB::table('neighbourhoods')
            ->select('name')
            ->where('id', trim($request->input('id')))->get();

            $name = $name[0]->name;
        }

        if($check != 0){
            $return = $check;
        }else{
            $return = $check;
        }

        return response()->json(['return' => $return, 'name' => $name]);
    
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
        $check = DB::table('neighbourhoods')
            ->select('id')
            ->where('name', 'like', '%'.$request->name.'%')
            ->count();

        if ($check == 0){
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

            return redirect()->route('bairros.index')->with('msg', 'O bairro ' .$request->name.' foi cadastrado com sucesso!');
        }else{
            return redirect()->route('bairros.index')->with('msg-error', 'O bairro '.$request->name.' já está cadastrado!');
        }
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
        return redirect()->route('bairros.index')->with('msg-updated', 'Alterações no bairro '.$request->name. ' realizadas com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $neighbourhood = Neighbourhood::find($id);
        $neighbourhood->delete();

        return redirect()->route('bairros.index')->with('msg-neig-removed', 'O bairro '. $neighbourhood->name . ' foi removido com sucesso!');
    }
}
