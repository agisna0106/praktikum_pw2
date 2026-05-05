<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $data['books'] = Book::with('bookshelf')->get();
        return view('books.index', $data);
    }

    // public function show($id)
    // {
    //     $bookshelf = Bookshelf::with('books')->findOrFail($id);
    //     return view('books.show', compact('bookshelf'));
    // }

    public function create()
    {
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');
        return view('books.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'publisher' => 'required|max:100',
            'city' => 'required|max:75',
            'bookshelf_id' => 'required',
            'cover' => 'nullable|image',
        ]);
        if($request->hasFile('cover')) {
            $path = $request->file('cover')->storeAs(
                'cover_buku',
                'cover_buku_'.time() .'.' . $request->file('cover')->extension(),
                'public'
            );
            $validated['cover'] = basename($path);
        }
        Book::create($validated);

        $notification = array(
            'message' => "Data buku berhasil ditambahkan!",
            'alert-type' => 'success'
        );

        if($request->save) {
            return redirect()->route('books')->with($notification);
        } else {
            return redirect()->route('books.create')->with($notification);
        }
    }

    public function edit(string $id) {
        $data['book'] = Book::find($id);
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');
        return view('books.edit', $data);
    }
    
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'publisher' => 'required|max:100',
            'city' => 'required|max:75',
            'bookshelf_id' => 'required',
            'cover' => 'nullable|image',
        ]);
        if($request->hasFile('cover')) {
            if($book->cover != null) {
                Storage::delete('public/cover_buku'.$request->old_cover);
            }
            $path = $request->file('cover')->storeAs(
                'cover_buku',
                'cover_buku_'.time() .'.' . $request->file('cover')->extension(),
                'public'
            );
            $validated['cover'] = basename($path);
        }
        Book::where('id', $id)->update($validated);

        $notification = array(
            'message' => "Data buku berhasil diedit!",
            'alert-type' => 'success'
        );

        return redirect()->route('books')->with($notification);
        
    }

    public function destroy(string $id){
        $book = Book::findOrFail($id);

        Storage::delete('public/cover_buku'.$book->cover);

        $book->delete();

        $notification = array(
            'message' => "Data buku berhasil dihapus!",
            'alert-type' => 'success'
        );

        return redirect()->route('books')->with($notification);
    }

}
