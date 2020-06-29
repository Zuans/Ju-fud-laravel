<?php

namespace App\Http\Controllers;

use App\food;
use Illuminate\Http\Request;
use App\cart_food;
use App\User;
use App\transaction;
use App\food_request;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Session;
use Psy\Command\ListCommand\FunctionEnumerator;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = food::all();
        return view('index.welcome', compact('food'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $food = food::where('id', $request->id)->first();
        if (Session::get('login')) {
            $cart_food = User::find(Session::get('id'))->cartfoods()->where('price', $food->price)->first();
            if (!$cart_food) {
                return view('index.detail', compact('food'));
            }
            return view('index.detail', compact('food'), compact('cart_food'));
        } else {
            return view('index.detail', compact('food'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, food $food)
    {
        if (Session::get('login')) {
            $food = food::where('id', $request->id)->first();
            $user = User::find(Session::get('id'));
            $foodExist = $user->cartfoods()->where([
                ['user_id', Session::get('id')],
                ['price', $food->price],
            ])->first();
            if (!$foodExist) {
                $cartFood = cart_food::create([
                    'title' => $food->title,
                    'food_id' => $food->id,
                    'price' => $food->price,
                    'jumlah' => $request->jumlah,
                    'total' => $request->total,
                    'category' => $food->category,
                    'description' => $food->description,
                    'image_src' => $food->image_src,
                ]);
                $foodExist = $user->cartfoods()->save($cartFood);
            } else {
                $foodExist->update([
                    'total' => $request->total,
                    'jumlah' => $request->jumlah,
                ]);
            }

            echo 'wadwad';
        } else {
            return FALSE;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\food  $food
     * @return \Illuminate\Http\Response
     */

    public function updateCartFood()
    {
    }

    public function destroy($id, food $food)
    {
        cart_food::destroy($id);
        return redirect('/cart');
    }

    public function home()
    {
        $datas = food::paginate(3);
        return view('index.welcome', compact('datas'));
    }
    public function category($cate)
    {
        $cate = urldecode($cate);
        $datas = food::where('category', $cate)->paginate(3);
        return view('index.category', compact('datas'), compact('cate'));
    }

    public function cart()
    {
        $foods = cart_food::where('user_id', Session::get('id'))->get();
        return view('index.cart', compact('foods'));
    }

    public function reqTotal(Request $request)
    {
        User::where('id', Session::get('id'))->update([
            "total_price" => $request->totalHarga,
        ]);
        return response()->json(array('success' => true,));
    }

    public function checkout()
    {
        $user = User::where('id', Session::get('id'))->first();
        $carts = cart_food::where('user_id', Session::get('id'))->get();

        \Stripe\Stripe::setApiKey('sk_test_51GvFZvL2Z5NpIn2qXm8NNMRZ0xs8Ds40cyoUHebe1nTExTrVb13Df8DEsBn0IUA1k1prZ5CfsGOeavs8nQN5d6Iv000NfTQsYh');
        $user = User::where('id', Session::get('id'))->first();
        $amount = $user->total_price . "00";
        $intent = \Stripe\PaymentIntent::create([
            'amount' => (int) $amount,
            'currency' => 'idr',
            // Verify your integration in this guide by including this parameter
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);


        return view('index.payment', [
            'user' => $user,
            'carts' => $carts,
            'intent' => $intent,
        ]);
    }

    public function payProcess(Request $request)
    {
        $cart_foods = cart_food::where('user_id', Session::get('id'))->get();
        $createTransaction = transaction::create([
            "nama" => $request->name,
            "email" => $request->email,
            "alamat" => $request->alamat,
            "jumlah" => $request->jumlah,
            'telp' => $request->telp
        ]);
        $transaction = transaction::find($createTransaction->id);
        foreach ($cart_foods as $cf) {
            $foodRequest = new food_request();
            $foodRequest->nama_barang = $cf->title;
            $foodRequest->jumlah_barang = $cf->jumlah;
            $foodRequest->image_src = $cf->image_src;
            $transaction->foodRequest()->save($foodRequest);
        }
        $cartDel = cart_food::where('user_id', Session::get('id'))->delete();

        $html = view('index.success')->render();
        return response()->json(array('success' => true, 'html' => $html));
    }
}
