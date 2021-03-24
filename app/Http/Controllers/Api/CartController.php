<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function AddToCart(Request $request, $id)
    {
//        check variable
        $product = DB::table('products')->where('id', $id)->first();

        $check = DB::table('pos')->where('pro_id', $id)->first();

        if ($check) {
            DB::table('pos')->where('pro_id', $id)->increment('pro_quantity');
            $product = DB::table('pos')->where('pro_id', $id)->first();
            $subtotal = $product->pro_quantity * $product->pro_price;
            DB::table('pos')->where('pro_id', $id)->update(['subtotal' => $subtotal]);
        } else {
            $data = array();
            $data['pro_id'] = $id;
            $data['pro_name'] = $product->product_name;
            $data['pro_quantity'] = 1;
            $data['pro_price'] = $product->selling_price;
            $data['subtotal'] = $product->selling_price;
            DB::table('pos')->insert($data);

        }

    }

    public function CartProduct()
    {
        $cart = DB::table('pos')->get();
        return response()->json($cart);

    }

    public function removeCart($id)
    {
        DB::table('pos')->where('id', $id)->delete();
        return response('Done');

    }

    public function increment(Request $request, $id)
    {
        $quantity = DB::table('pos')->where('id', $id)->increment('pro_quantity');
        $product = DB::table('pos')->where('id', $id)->first();
        $subtotal = $product->pro_quantity * $product->pro_price;
        DB::table('pos')->where('id', $id)->update(['subtotal' => $subtotal]);
        return response('done');

    }

    public function decrement(Request $request, $id)
    {
        $quantity = DB::table('pos')->where('id', $id)->decrement('pro_quantity');
        $product = DB::table('pos')->where('id', $id)->first();
        $subtotal = $product->pro_quantity * $product->pro_price;
        DB::table('pos')->where('id', $id)->update(['subtotal' => $subtotal]);
        return response('done');

    }
    public function vats(){
        $vat = DB::table('extra')->first();
        return response()->json($vat);
    }

}
