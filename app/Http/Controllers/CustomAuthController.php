<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Mail\RecuperarPassword;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class CustomAuthController extends Controller
{
    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function showLogin()
    {
        return view('auth.login');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function customLogin(Request $request)
    {
        //dd($request);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (auth()->user()->status==1) {
                return redirect()->route('home');
            } else {
                return redirect("login")->with('error', 'Cuenta inactiva');
            }
        }
        return redirect("login")->with('error', 'Datos de acceso incorrectos');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function home()
    {
        if (Auth::check()) {
            return view('home');
        }
        return redirect("login")->with('error', 'No puedes entrar a esta sección');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function forgotPassword()
    {
        return view("auth.forgot-password");
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function recoverPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email no encontrado en nuestros registros');
        }
        $datos = new \stdClass();
        $datos->enlace = route('change-password',[$user->id,md5('.'.$user->id)]);
        $datos->nombre = $user->name;
        Mail::to($user->email)->send(new RecuperarPassword($datos));
        $mensaje = "Hemos enviado un correo a " . $user->email . " con instrucciones para recuperar tu password.s";
        return redirect()->route('login')->with('success', $mensaje);
    }
    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function changePassword($id, $token)
    {
        if ($token!=md5('.'.$id)) {
            return redirect('login')->with('error', 'Token invalido');
        }
        $user = User::findOrFail($id);
        return view('auth.change-pwd')->with('user', $user);
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function changePasswordUpdate(Request $request)
    {
        //dd($request->password);

        if (empty($request->password) || empty($request->confirmar)) {
            return back()->with('error', 'Todos los campos son obligatorios');
        }
        $user = User::find($request->user_id);
        if ($request->password!=$request->confirmar) {
            return back()->with('error', 'El password y la confirmación deben ser iguales');
        }
        if (strlen($request->password) < 6) {
            return back()->with('error', 'El password debe ser de 6 caracteres por lo menos');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('login')->with('success', 'Tu password ha sido actualizado');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function capturaCodigo($id, $token)
    {
        if ($token!=md5('.'.$id)) {
            return redirect('login')->with('error', 'Token invalido');
        }
        $user = User::findOrFail($id);
        if ($user->activo==1) {
            return redirect('login')->with('success', 'Tu cuenta ya está activa');
        }
        return view('auth.codigo-activacion')->with('user', $user);
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function validarCodigo(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($user->codigo_activacion!=$request->codigo) {
            return back()->withInput()->with('error', 'El código que pusiste es incorrecto');
        }
        $user->activo = 1;
        $user->save();
        $mensaje = "Bienvenido al servicio de " . config('app.name') . ", tu cuenta ha sido activada y ya puedes usar nuestros servicios";
        SMS::Enviar(trim($user->telefono), $mensaje);
        return redirect('login')->with('success', 'Tu cuenta ha sido activada!');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function reenviarCodigo($id, $token)
    {
        if ($token!=md5('.'.$id)) {
            return redirect('login')->with('error', 'Token invalido');
        }
        $user = User::findOrFail($id);
        $codigo = $this->getRandomPwd(5);
        $bienvenido="Tu código de activación es: " . $codigo;
        $token = md5('.'.$id);
        User::where('id', $id)->update(['codigo_activacion'=>$codigo]);
        SMS::Enviar(trim($user->telefono), $bienvenido);
        return back()->with('success', 'Tu código de activación ha sido reenviado');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function getRandomPwd($n)
    {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
}
