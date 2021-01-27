<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
Use Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

 protected $username = 'username';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }




    public function login(Request $request)
{
    $this->validate($request, [
        'username' => 'required|string', //VALIDASI KOLOM USERNAME
        //TAPI KOLOM INI BISA BERISI EMAIL ATAU USERNAME
        'password' => 'required|string|min:6',
    ]);

    //LAKUKAN PENGECEKAN, JIKA INPUTAN DARI USERNAME FORMATNYA ADALAH EMAIL, MAKA KITA AKAN MELAKUKAN PROSES AUTHENTICATION MENGGUNAKAN EMAIL, SELAIN ITU, AKAN MENGGUNAKAN USERNAME
    $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
  
    //TAMPUNG INFORMASI LOGINNYA, DIMANA KOLOM TYPE PERTAMA BERSIFAT DINAMIS BERDASARKAN VALUE DARI PENGECEKAN DIATAS
    $login = [
        $loginType => $request->username,
        'password' => $request->password
    ];
  
    //LAKUKAN LOGIN
    if (auth()->attempt($login)) {
        //JIKA BERHASIL, MAKA REDIRECT KE HALAMAN HOME
        // return redirect()->route('home');

        if (auth()->user()->role=='admin' )
        {
            // $username= auth()->user()->username;
            // alert()->image('Welcome '.$username,' ','../public/dinart/dist/img/pevita_login.png','245','330')->autoClose(2000);
            return redirect('/admin');
            // return '/admin';
        }

        elseif (auth()->user()->akses=='cs' )
        {
           return redirect('/');
        }

        elseif (auth()->user()->akses=='produksi' )
        {
            return redirect('/');
        }

    }
    //JIKA SALAH, MAKA KEMBALI KE LOGIN DAN TAMPILKAN NOTIFIKASI 
    return redirect()->route('login')->with(['error' => 'username/Password salah!']);
}


 // protected function redirectTo()
 //    {
 //        if (auth()->user()->role=='admin' )
 //        {
 //            return '/admin/dashboard';
 //        }

 //        elseif (auth()->user()->akses=='cs' )
 //        {
 //            return '/';
 //        }

 //        elseif (auth()->user()->akses=='produksi' )
 //        {
 //            return '/';
 //        }


 //    }



}
