<?php

namespace App\Http\Controllers;

use App\Course;
use Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller {

    public function index()
    {
        $content = Cart::content();

        return view('cart.index', ['content' => $content]);
    }

    public function add(Course $course)
    {
        Cart::add($course->id, $course->name, 1, $course->price);

        return back();
    }

    public function update(Request $request, $row)
    {
        dd($request);
        $rowId = Cart::search(['id' => $request->get('')]);
        $quantity = $request->get('quantity');

        Cart::update($rowId, $quantity);
    }

    public function destroy($rowid)
    {
        Cart::remove($rowid);

        return redirect()->action('CartController@index');
    }

    public function destroyCart()
    {
        Cart::destroy();

        return redirect()->action('CartController@index');
    }

    public function buy()
    {
        return view('cart.buy');
    }
}
