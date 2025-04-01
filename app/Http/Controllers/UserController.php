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

        //Verificação se o e-mail já existe tanto para cadastro quanto para edição.
        $id = '';
        $exist = '';
        $userExist = '';
        if ($request->input('user') != null) {
            $user = DB::table('users')
                ->select('id')
                ->where('email', $request->input('user'))->get();

            if (isset($check[0]->id)) {
                if ($check[0]->id == $user[0]->id) {
                    $userExist = false;
                } else {
                    $userExist = true;
                }
            }
        }

        if (isset($check[0]->id)) {
            $id = $check[0]->id;
            $exist = true;
        } else {
            $exist = false;
        }

        return response()->json(['check' => $exist, 'id' => $id, 'checkUserId' => $userExist]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'contact' => 'required|min:8',
            'email' => 'required|min:5',
            'password' => 'required|min:3'
        ],[
            'name.required' => 'Insira um nome para o usuário.',
            'name.min' => 'O nome de usuário deve conter no mínimo 3 caracteres.',
            'contact.required' => 'Insira um número para contato.',
            'contact.min' => 'O número de contato deve conter no mínimo 10 caracteres.',
            'email.required' => 'Insira um email para o usuário.',
            'email.min' => 'O email do usuário deve conter no mínimo 3 caracteres.',
            'password.required' => 'Insira uma senha para o usuário.',
            'password.min' => 'A senha do usuário deve conter no mínimo 3 caracteres.',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->firstname = ucfirst($request->name);
        $user->password = $request->password;
        $user->contact = $request->contact;

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
        $request->validate([
            'name' => 'required|min:3',
            'contact' => 'required|min:8',
            'email' => 'required|min:5',
        ],[
            'name.required' => 'Insira um nome para o usuário.',
            'name.min' => 'O nome de usuário deve conter no mínimo 3 caracteres.',
            'contact.required' => 'Insira um número para contato.',
            'contact.min' => 'O número de contato deve conter no mínimo 10 caracteres.',
            'email.required' => 'Insira um email para o usuário.',
            'email.min' => 'O email do usuário deve conter no mínimo 3 caracteres.',
        ]);

        $user = User::find($id);
        $user->email = $request->email;
        $user->firstname = ucfirst($request->name);
        $user->password = $request->password;
        $user->contact = $request->contact;

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

        return redirect()->route('usuarios.index')->with('msg-upd', '.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('msg-del', 'Usuário deletado com sucesso!');
    }
}
