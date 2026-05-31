<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();

        return view('allbooks', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addnewbook');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3',
            'author' => 'required|string|min:3',
            'published_date' => 'required|date'
        ]);

        Books::create([
            'title' => $request->title,
            'author' => $request->author,
            'published_date' => $request->published_date,
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id, Request $request)
    {
        $book = Books::findorFail($id);

        $request->validate([
            'title' => 'required|string|min:3',
            'author' => 'required|string|min:3',
            'published_date' => 'required|date'
        ]);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'published_year' => $request->published_year
        ]);

        return redirect()->route('books.index');
    }

    public function editcreate(int $id){

        $book = Books::findOrFail($id);

        return view('editbook', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $books = Books::findOrFail($id);
        $books->delete();

        return redirect()->route('books.index');
    }
}
