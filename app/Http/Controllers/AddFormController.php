<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddGadgetRequest;
use App\Gadget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Product;

class AddFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_add_form()
    {
        if (!Gate::allows('isAdmin')) {
            return view('add_form');
        }
        else{
            return redirect()
                    ->route('main-page')
                    ->withErrors('Ви не маєте прав доступу');
        }

    }

    public function add_gadget(AddGadgetRequest $request)
    {
        if (Gate::denies('isAdmin')) {
            $number = $request->input('number');
            $chek =  Product::
                        where('serial_number', '=', $number)
                        ->where('shop_id', Auth::user()->id)
                        ->first();
            if($chek){
                $gadget = new Gadget();
                $name = $chek->name;
                $gadget->add(
                    Auth::user()->id,
                    $name,
                    $number
                );

                return redirect()
                        ->back()
                        ->with('message',__('Sale Added'));
            }
        }

        return redirect()
                ->back()
                ->withErrors('Операція відхиленна');

    }

    public function get_json_product_name()
    {
        $equal =  Product::
                select('products.id')
                ->Join('gadgets', 'products.serial_number', '=', 'gadgets.product_number');

        $query = Product::
                select('serial_number', 'name')
                ->whereNotIn('id', $equal)
                ->where('shop_id', Auth::user()->id)
                ->get();
        $result = [];

        foreach($query as $product){
            if($product->name && $product->serial_number){
                $result[] = [
                    'name'=> $product->name,
                    'serial_number' =>$product->serial_number
                ];
            }
        }
        return $result;
    }

}
