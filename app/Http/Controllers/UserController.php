<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Neighbourhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('Users.users', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Users.user-create');
    }

    public function checkUser(Request $request)
    {
        $check = DB::table('users')
            ->select('id')
            ->where('email', $request->input('email'))->get();
        $id = '';
        $exist = '';

        if (isset($check[0]->id)){
            $id = $check[0]->id;
            $exist = true;
        }else{
            $exist = false;
        }

        return response()->json(['check' => $exist, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->firstname = ucfirst($request->name);
        $user->password = bcrypt($request->password);

        if ($request->user_type == 'Administrador'){
            $user->user_type = $request->user_type;
            $user->assignRole('Administrador');
        }elseif ($request->user_type == 'Operador'){
            $user->user_type = $request->user_type;
            $user->assignRole('Operador');
        }else{
            $user->user_type = $request->user_type;
            $user->assignRole('Entregador');
        }

        $user->save();

        return redirect()->route('usuarios.index')->with('msg-success', 'Usuário '. ucfirst($request->name) .' cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('Users.user-profile', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function motoboys()
    {
        $entregadores = DB::table('users')
            ->select('firstname', 'lastname')
            ->where('user_type', 'Entregador')
            ->get();
        return response()->json($entregadores);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->email = $request->email;
        $user->firstname = ucfirst($request->name);
        $user->password = bcrypt($request->password);

        if ($request->user_type == 'Administrador'){
            $user->user_type = $request->user_type;
            $user->assignRole('Administrador');
        }elseif ($request->user_type == 'Operador'){
            $user->user_type = $request->user_type;
            $user->assignRole('Operador');
        }else{
            $user->user_type = $request->user_type;
            $user->assignRole('Entregador');
        }
        $user->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }
}
