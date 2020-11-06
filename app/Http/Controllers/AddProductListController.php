<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddGadgetListRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class AddProductListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_add_form_product_list(){
        if (Gate::denies('isAdmin')) {
            return view('add_product_list');
        }
        else{
            return redirect()
                ->route('main-page')
                ->withErrors('Ви не маєте прав доступу');
        }

    }

    public function store(AddGadgetListRequest $request){
        if (Gate::denies('isAdmin')) {
            Excel::import(new ProductsImport, $request->file('list'));
            return redirect()
                ->back()
                ->with('message',__('Data Sent'));
        }
    }
}
