<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Validator;

class BookController extends Controller
{
    // all books
    public function index()
    {
        $books = Book::all()->toArray();
        return array_reverse($books);
    }

    // add book
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|unique:books',
            'author' => 'required',
        ],[
            'name.required' => 'The Book name field is required.',
            'name.unique' => 'The Book name has already been taken.',
            'author.required' => 'The Author name field is required.'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ],201);
        }
        $book = new Book([
            'name' => $request->name,
            'author' => $request->author
        ]);
        $book->save();

        return response()->json('The book successfully added');
    }

    // edit book
    public function edit($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    // update book
    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());

        return response()->json('The book successfully updated');
    }

    // delete book
    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json('The book successfully deleted');
    }
}
