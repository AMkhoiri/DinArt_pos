<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(Auth::user()->role);
        if (Auth::check()) 
        {
            if ( Auth::user()->role == "admin") {  
                return redirect('/admin');
            }

            elseif(Auth::user()->role == "cs") {
                return redirect('/cs');
            }

            elseif(Auth::user()->role == "produksi") {
                return redirect('/produksi');
            }
            else{
                abort(404);
            }
        }
        else {
            return view('auth.login');
        }
        
    }
}
