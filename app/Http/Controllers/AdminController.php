<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }
    public function books()
    {
        $user = Auth::user();
        $books = Book::all();
        return view('book', compact('user', 'books'));
    }
    public function submit_book(Request $req)
    {
        $book = new Book;

        $book->judul = $req->get('judul');
        $book->penulis = $req->get('penulis');
        $book->tahun = $req->get('tahun');
        $book->penerbit = $req->get('penerbit');

        if($req->hasFile('cover')) {
            $extension = $req->file('cover')->extension();
            $filename = 'cover_buku_'.time().'.'.$extension;
            $req->file('cover')->storeAs(
                'public/cover_buku', $filename
            );

            $book->cover = $filename;
        }

        $book->save();

        $notification = array(
            'message' => 'Data buku berhasil ditambahkan',
            'alert-type' => 'succes'
        );

        return redirect()->route('admin.books')->with($notification);
    }
    public function update_book(Request $req)
    {
        $book = Book::find($req->get('id'));

        $book->judul = $req->$get('judul');
        $book->penulis = $req->$get('penulis');
        $book->tahun = $req->$get('tahun');
        $book->penerbit = $req->$get('penerbit');

        if ($req->hasFile('cover')) {
            $extension = $req->file('cover')->extension();
            $filename = 'cover_buku_'.time().'.'.$extension;
            $req->file('cover')->storeAs(
                'public/cover_buku', $filename
            );

            Storage::delete('public/cover_buku/'.$req->get('old_cover'));

            $book->cover = $filename;
        }

        $book->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.books')->with($notification);
    }
    public function delete_book(Request $req)
    {
        $book = Book::find($req->get('id'));
        Storage::delete('public/cover_buku/'.$req->get('old_cover'));

        $book->delete();

        $notification = array(
            'message' => 'Data buku berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.books')->width($notification);
    }
    // AJAX PROCESS
    public function getDataBuku($id)
    {
        $buku = Book::find($id);

        return response()->json($buku);
    }

}
