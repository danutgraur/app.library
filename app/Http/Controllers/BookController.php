<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::whereHas('tags')->get();
        return view('books.index')
            ->withBooks($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name','id');
        return view('books.create')
            ->withAuthors($authors)
            ->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
           'title' => 'required|max:255',
           'author' => 'required|max:255',
           'tags' => 'required',
           'description' => 'required',
            'cover' => 'mimes: jpeg,bmp,png'
        ])->validate();

        DB::transaction(function () use ($request) {

            $book = new Book;
            $book->title = $request->title;
            $book->author_id = $request->author;
            $book->description = $request->description;
            if($request->file('cover')){
                $cover = $request->file('cover');
                $coverName = $book->title.'.'.$cover->getClientOriginalExtension();
                $cover->storeAs('/covers/',$coverName);
                $book->cover_image = $coverName;
            } else {
                $book->cover_image = 'default.png';
            }

            $book->save();

            if($request->tags){
                foreach ($request->tags as $tag)
                $book->tags()->attach($tag);
            }

        });

        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show')
            ->withBook($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name','id');

        return view('books.edit')
            ->withAuthors($authors)
            ->withBook($book)
            ->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        Validator::make($request->all(),[
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'tags' => 'required',
            'description' => 'required'
        ])->validate();

        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_id = $request->author;
        if($request->cover){
            $cover = $request->file('cover');
            $coverName = $request->title.'.'.$cover->getClientOriginalExtension();
            $cover->storeAs('/covers/',$coverName);
            $book->cover_image = $coverName;
        }
        $book->save();

        if ($request->tags) {
            $book->tags()->sync($request->tags);
        }

        return redirect(route('books.show', $book->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index');
    }

}
