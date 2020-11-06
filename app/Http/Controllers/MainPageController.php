<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Gadget;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_main_page()
    {
        if (Gate::allows('isAdmin')){
            $gadgets = Gadget::select_with_users();
            $is_admin = true;
        }
        else{
            $gadgets = Gadget::select(Auth::user()->id);
            $is_admin = false;
        }
        return view('index',[
            'gadgets' => $gadgets,
            'is_admin' => $is_admin
        ]);
    }

    public function get_json()
    {
        if (Gate::allows('isAdmin')){
            $gadgets = Gadget::select_with_users();
            $is_admin = true;
        }
        else{
            $gadgets = Gadget::select(Auth::user()->id);
            $is_admin = false;
        }
        return[
            'gadgets' => $gadgets,
            'is_admin' => $is_admin
        ];
    }
}
