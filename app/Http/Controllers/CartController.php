<?php

namespace App\Http\Controllers;

use App\Course;
use App\Time;
use Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller {

    public function index()
    {
        $content = Cart::content();
//        dd($content);
        return view('cart.index', ['content' => $content]);
    }

    public function add(Course $course, Time $time)
    {
        Cart::add($course->id, $course->name, 1, $course->price,
            [
                'time_id' => $time->id,
                'beginning_date'=>$time->beginning_date->toFormattedDateString(),
                'end_date'=>$time->end_date->toFormattedDateString(),
                'start_time' => $time->start_time->toTimeString(),
                'end_time'=>$time->end_time->toTimeString(),
                'days' => $time->days()
            ]);

        flash()->success('Item Added', 'Item has been added to your cart.');

        return back();
    }

    public function update(Request $request, $row)
    {
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
}
