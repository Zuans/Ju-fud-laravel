<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FoodRequest;
use App\cart_food;
use illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\food;
use SebastianBergmann\GlobalState\Snapshot;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        // Apakah user sudah login?
        if (!\Session::get('login')) {
            return redirect('/login')->with('alert', 'Kamu Harus login dulu');
        }
        $datas = food::paginate(5);
        return view('dashboard.index', compact('datas'));
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
    public function store(FoodRequest $request)
    {
        // Jika category yg dimasukkan null masukkan kembalikan error
        if ($request->category != 'Null') {
            // Lakukan validasi
            $request->validated();
            if ($request->hasFile('image_src')) {
                // get full name
                $fileWithEXt = $request->file('image_src')->getClientOriginalName();
                // get just name
                $filename = pathinfo($fileWithEXt, PATHINFO_FILENAME);
                //  get ext file
                $extension = $request->file('image_src')->getClientOriginalExtension();
                //  Filename to store
                $filenameStore = $filename . '_' . time() . '.' . $extension;

                $path = $request->file('image_src')->storeAs('public/images', $filenameStore);
            } else {
                $filenameStore = "noimage.jpg";
            }
            //  Buat object baru
            $data = new food();
            $data->title = $request->title;
            $data->price = $request->price;
            $data->category = $request->category;
            $data->description = $request->description;
            $data->image_src = $filenameStore;
            // Simpan ke db
            $data->save();
            return redirect('dashboard/tambah')->with('success', 'Makanan Berhasil di tambahkan');
        }
        // Karena tidak memasukkan category maka error
        return redirect('dashboard/tambah')->with('error', 'Kategori Tidak Boleh Kosong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(food $food)
    {
        // Apakah user sudah login?
        if (!\Session::get('login')) {
            return redirect('/login')->with('alert', 'Kamu Harus login dulu');
        }
        return view('dashboard.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, food $food)
    {
        // lakukan validasi request form 
        $request->validated();
        if ($food->image_src != 'noimage.jpg') {
            // Jika data sebelumnya memiliki file gambar
            Storage::delete('public/images/' . $food->image_src);
        };
        if ($request->hasFile('image_src')) {
            // get full name
            $fileWithEXt = $request->file('image_src')->getClientOriginalName();
            // get just name
            $filename = pathinfo($fileWithEXt, PATHINFO_FILENAME);
            //  get ext file
            $extension = $request->file('image_src')->getClientOriginalExtension();
            //  Filename to store
            $filenameStore = $filename . '_' . time() . '.' . $extension;

            $path = $request->file('image_src')->storeAs('public/images', $filenameStore);
        } else {
            $filenameStore = "noimage.jpg";
        }

        food::where('id', $food->id)
            ->update([
                // Lakukan update 
                'title' => $request->title,
                'price' => $request->price,
                'category' => $request->category,
                'image_src' => $filenameStore,
                'description' => $request->description,
            ]);
        return redirect('dashboard/index')->with('success', 'Makanan Berhasil di ubah');
    }

    public function destroy($id)
    {
        $data = food::where('id', $id)->first();
        if ($data->image_src != 'noimage.jpg') {
            Storage::delete('public/images/' . $data->image_src);
        }
        food::destroy($data->id);
        return redirect('dashboard/index')->with('success', 'Data Berhasil di hapus');
    }
}
