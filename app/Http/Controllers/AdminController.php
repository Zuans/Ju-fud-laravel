<?php

namespace App\Http\Controllers;

use App\Http\Requests\passwordRequest;
use App\Http\Requests\profileRequest;
use App\transaction;
use Illuminate\Support\Facades\Session;
use illuminate\Support\Facades\Storage;
use App\User;
use App\succes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengecek apakah sudah login?
        if (!\Session::get('login')) {
            return redirect('/login')->with('alert', 'Kamu Harus login dulu');
        }
        $data = User::where('email', session('email'))->first();
        return view('dashboard.admin', compact('data'));
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
    public function editPass($id)
    {
        // Mengecek apakah sudah login?
        if (!\Session::get('login')) {
            return redirect('/login')->with('alert', 'Kamu Harus login dulu');
        }
        $data = User::where('id', $id)->first();
        return view('dashboard.EditPass', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePass(passwordRequest $request, $id)
    {
        // Menngganti password dan melakukan pengecekan apakah password sudah benar
        $data = User::where('id', $id)->first();
        $passConfirm = \Hash::check($request->passwordLama, $data->password);
        if ($passConfirm) {
            // JIka Benar maka password akan diupdate
            $request->validated();
            User::where('id', $id)
                ->update([
                    'password' => \Hash::make($request->password),
                ]);
            return redirect('/dashboard')->with('success', 'Profile kamu berhasil diubah');
        } else {
            // Jika salah
            return redirect('/dashboard')->with('alert', 'Yahh Salah Password Coba lagi yaa..');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function editProfile($id)
    {
        // Mengecek apakah sudah login ?
        if (!\Session::get('login')) {
            return redirect('/login')->with('alert', 'Kamu Harus login dulu');
        }
        $data = User::where('id', $id)->first();
        return view('dashboard.editProfile', compact('data'));
    }

    public function updateProfile(profileRequest $request, $id)
    {
        // Mengambil data data user
        $data = User::where('id', $id)->first();
        // Apakah email yang direquest sama dengan email yang tersimpan agar tidak kesalahan saat if email exist
        if ($request->email == $data->email) {
            // Jika ya lakukan hash compare apakah password 
            $confirmPass = \Hash::check($request->password, $data->password);
            if ($confirmPass) {
                // Lakukan validasi
                $request->validated();
                // Apakah data sebelumnnya memeliki gambar profil jika iya  maka hapus gambar
                if ($data->profile_image != 'noimage.jpg') {
                    \Storage::delete('public/profile_image/' . $data->profile_image);
                }

                // Jika Reqeust memiliki gambar maka simpan gambar
                if ($request->hasFile('profile_image')) {
                    //get name with ext / mendapatkan nama file beserta ext-nya
                    $fileWithExt = $request->file('profile_image')->getClientOriginalName();
                    //get filename / mendapat filename nya saja
                    $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
                    //get extension / hanya ingin mendapatkan  ext nya saja
                    $extension = $request->file('profile_image')->getClientOriginalExtension();
                    // File name to store / membuat filename yang ingin disimpan ( menggunkan now () agar unique ) dan ext juga
                    $filenameStore = $filename . '_' . time() . '.' . $extension;
                    // Make path / meletakkan gambar pada file storege 
                    $path = $request->file('profile_image')->storeAs('public/profile_image/', $filenameStore);
                } else {
                    // Jika request jika terdapat gambar
                    $filenameStore = 'noimage.jpg';
                }
                User::where('id', $id)
                    //  lakukan update pada data ini
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'updated_at' => now(),
                        'profile_image' => $filenameStore,
                    ]);
                // Juga lakukan update pada session nya agar info nya juga berubah
                Session::put('name', $request->name);
                Session::put('email', $request->email);
                Session::put('profile', $filenameStore);
                return redirect('dashboard')->with('success', 'Data berhasil diubah');
            } else {
                // Jika password yang dimasukkan salah
                return redirect('/dashboard')->with('alert', 'Yahh Salah Password Coba lagi yaa..');
            }
        } else {
            // mencari apakah request memiliki email yang sama di database
            $emailExist = User::where('email', $request->email)->first();
            if (!$emailExist) {
                // Jika tidak ada email yang sama dan lakukan compare pada password
                $confirmPass = \Hash::check($request->password, $data->password);
                if ($confirmPass) {
                    if ($request->hasFile('profile_image')) {
                        //get name with ext
                        $fileWithExt = $request->file('profile_image')->getClientOriginalName();
                        //get filename
                        $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
                        //get extension
                        $extension = $request->file('profile_image')->getClientOriginalExtension();
                        // File name to store
                        $filenameStore = $filename . '_' . time() . '.' . $extension;
                        // Make path
                        $path = $request->file('profile_image')->storeAs('public/profile_image/', $filenameStore);
                    } else {
                        $filenameStore = 'noimage.jpg';
                    }
                    $request->validated();
                    if ($data->profile_image != 'noimage.jpg') {
                        // Jika data sebelumnya memiliki gambar maka hapus dulu
                        \Storage::delete('public/profile_image/' . $data->profile_image);
                    }
                    User::where('id', $id)
                        // lakukan update pada data
                        ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'updated_at' => now(),
                            'profile_image' => $filenameStore,
                        ]);
                    // Juga lakukan update pada session nya agar info nya juga berubah
                    Session::put('name', $request->name);
                    Session::put('email', $request->email);
                    Session::put('profile', $filenameStore);
                    return redirect('dashboard')->with('success', 'Data berhasil diubah');
                } else {
                    // Password salah
                    return redirect('/dashboard')->with('alert', 'Yahh Salah Password Coba lagi yaa..');
                }
            } else {
                // Email yang dimasukkan telah terdaftar
                return redirect('/dashboard')->with('alert', 'Email Telah digunakan');
            }
        };
    }

    public function destroy($id)
    {
        //
    }

    public function payment()
    {
        // Mengambil semua data transaksi dan menyusun nya berdasarkan desc
        $transactions = transaction::orderBy('created_at', 'desc')->paginate(7);
        return view('dashboard.transaksi', compact('transactions'));
    }

    public function detailTrans($id)
    {
        // Menampilkan detail barang barang yang di beli pada sebuah transaksi
        $transaction = transaction::find($id);
        $foods = $transaction->foodRequest()->orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.detailTrans', compact('foods'), compact('transaction'));
    }

    public function updateTrans($id)
    {
        // Melakukan udpate pada transaksi bahwa pesanan selesai dan menambahkan ke pesanan selesai
        $data = transaction::where('id', $id)->first();
        $create = succes::create([
            'nama' => $data->nama,
            'jumlah' => $data->jumlah,
        ]);
        // menghapus tranksaksi karena pesanan telah selesai
        transaction::destroy($id);
        return redirect('/dashboard/payment')->with('success', 'Pesanan atas nama' . " " . $data->nama . " " . 'berhasil');
    }


    //Payment sucesss
    public function indexSuccess()
    {
        // Mengambil pesanan selesai dan mengurutkannya
        $datas = succes::orderBy('created_at', 'desc')->paginate(7);
        return view('dashboard.selesai', compact('datas'));
    }
}
