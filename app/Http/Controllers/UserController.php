<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Neighbourhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Users.users', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return redirect()->route('usuarios.index');
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

    public function store(Request $request)
    {
        return redirect()->route('usuarios.index');

        $request->validate([
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'contact' => 'required|min:8',
            'email' => 'required|min:5',
        ],[
            'name.required' => 'Insira um nome para o usuário.',
            'name.min' => 'O nome de usuário deve conter no mínimo 3 caracteres.',
            'surname.required' => 'Insira um sobrenome para o usuário.',
            'surname.min' => 'O sobrenome de usuário deve conter no mínimo 3 caracteres.',
            'contact.required' => 'Insira um número para contato.',
            'contact.min' => 'O número de contato deve conter no mínimo 10 caracteres.',
            'email.required' => 'Insira um email para o usuário.',
            'email.min' => 'O email do usuário deve conter no mínimo 3 caracteres.',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->firstname = ucfirst($request->name);
        $user->surname = ucfirst($request->surname);
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

    public function show(string $id)
    {
        $user = User::find($id);
        return view('Users.user-profile', [
            'user' => $user
        ]);
    }

    public function changePassword(Request $request)
    {
        return redirect()->route('usuarios.index');
        $status = false;
        if ($request->password != $request->password2){
            $status = 'As senhas digitadas são diferentes umas das outras.';
            return response()->json(['status' => $status]);
        }

        $check = DB::table('users')
            ->where('code', $request->code)->get();

        if (isset($check[0])) {
            $user = User::find($check[0]->id);
            $user->password = $request->password;
            $user->code = null;
            $user->save();

            return response()->json(['status' => 'success']);

        }else{
            $status = 'Não foi possível encontrar este código na base de dados.';
            return response()->json(['status' => $status]);
        }
    }

    public function motoboys()
    {
        $entregadores = DB::table('users')
            ->select('firstname', 'surname')
            ->where('user_type', 'Entregador')
            ->get();
        return response()->json($entregadores);
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('usuarios.index');

        $request->validate([
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'contact' => 'required|min:8',
            'email' => 'required|min:5',
        ],[
            'name.required' => 'Insira um nome para o usuário.',
            'name.min' => 'O nome de usuário deve conter no mínimo 3 caracteres.',
            'surname.required' => 'Insira um sobrenome para o usuário.',
            'surname.min' => 'O sobrenome de usuário deve conter no mínimo 3 caracteres.',
            'contact.required' => 'Insira um número para contato.',
            'contact.min' => 'O número de contato deve conter no mínimo 10 caracteres.',
            'email.required' => 'Insira um email para o usuário.',
            'email.min' => 'O email do usuário deve conter no mínimo 3 caracteres.',
        ]);

        $user = User::find($id);
        $user->email = $request->email;
        $user->firstname = ucfirst($request->name);
        $user->surname = ucfirst($request->surname);
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

    public function destroy(string $id)
    {
        return redirect()->route('usuarios.index');

        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('msg-del', 'Usuário deletado com sucesso!');
    }
}
