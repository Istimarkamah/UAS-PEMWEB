<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Buku extends Controller
{

    public function index()
    {

        $datas = DB::table('buku')->get();
        return view('index', ['datas' => $datas]);
    }
    public function create()
    {

        $gambar = request()->file('gambar');
        $gambarName = $gambar->hashName();
        $gambar->move(public_path('images'), $gambarName);
        DB::table('buku')->insert([
            'judul' => request('judul'),
            'penulis' => request('penulis'),
            'tahun_terbit' => request('tahun_terbit'),
            'genre' => request('genre'),
            'gambar' => $gambarName,
            'deskripsi' => request('deskripsi'),
        ]);

        return redirect('/');
    }

    public function update($id)
    {

        $data = DB::table('buku')->where('id', $id)->first();
        return view('update', ['data' => $data]);
    }

    public function updateStore()
    {


        $gambar = request()->file('gambar');
        $old_gambar = request()->input('old_gambar');

        if ($gambar) {
            $old_gambar = $gambar->hashName();
        }

        $data = DB::table('buku')->where('id', request('id'))->first();
        $data = DB::table('buku')->where('id', request('id'))->update([
            'judul' => request('judul'),
            'penulis' => request('penulis'),
            'tahun_terbit' => request('tahun_terbit'),
            'genre' => request('genre'),
            'deskripsi' => request('deskripsi'),
            'gambar' => $old_gambar,
        ]);
        $gambar->move(public_path('images'), $old_gambar);
        return redirect('/');
    }

    public function delete($id)
    {

        DB::table('buku')->where('id', $id)->delete();
        return redirect('/');
    }

    public function register()
    {

        return view('register');
    }

    public function registerStore(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect('/login');
    }

    public function login()
    {

        return view('login');
    }

    public function loginStore(Request $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function laporan()
    {
        $datas = DB::table('buku')->get();
        
        $pdf = PDF::loadView('laporan', [
            'datas' => $datas
        ]);

        return $pdf->download('laporan.pdf');
    }
}
