<?php

namespace App\Http\Controllers;

use App\Mail\CodigoRecuperacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendMail(Request $request)
    {
        $check = DB::table('users')
            ->where('email', $request->email)->count();

        $exist = false;

        if ($check != 0) {
            $exist = true;

            do{
              $code = rand(100000, 999999);

              $checkCode = DB::table('users')->where('code', $code)->count();
            }while ($checkCode != 0);


            DB::table('users')
                ->where('email', $request->email)
                ->update(['code' => $code]);


            Mail::to($request->email)->send(new CodigoRecuperacao($code));


            return response()->json(['exist' => $exist]);
        }else{
            return response()->json(['exist' => $exist]);
        }
    }
}
