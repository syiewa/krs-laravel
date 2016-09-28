<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\User;
class LoginController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    public function Login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ], [
            'username.required' => 'Username diperlukan!',
            'username.exists' => 'Username tidak diketemukan',
            'password.required' => 'Password diperlukan'
        ]);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        } else {
             if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                if(Auth::user()->role == 'admin'){
                    return redirect()->intended('admin');
                } elseif(Auth::user()->role == 'mahasiswa'){
                    return redirect()->intended('mahasiswa');
                } else {
                    return redirect()->intended('dosen');
                }
            } else {
                $validator->errors()->add('password', 'Password tidak benar');
                return redirect('/')
                            ->withErrors($validator)
                            ->withInput();
            }
        }
    }

    public function resetpass(){
        return view('auth.passwords.reset');
    }

    public function reset(Request $request){
        $validator = Validator::make($request->all(),[
            'password_lama' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ],[
            'password_lama.required' => 'Password Lama diperlukan',
            'password.required' => 'Password diperlukan',
            'password.confirmed' => 'Password tidak sama',
            'password_confirmation.required' => 'Confirmation Password diperlukan'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $username = Auth::user()->username;
            $check = Auth::attempt(['username' => $username,'password' => $request->password_lama]);
            if($check){
                User::find(Auth::user()->id)->update(['password' => bcrypt($request->password)]);
                Auth::attempt(['username' => $username,'password' => $request->password]);
                return redirect()->back()->with('info','Password berhasil diubah');
            } else {
                $validator->errors()->add('password_lama', 'Password tidak benar');
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
        }
    }
}
