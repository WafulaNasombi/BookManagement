<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Author;
use App\Models\Book;


class BookController extends Controller
{
    public function index(){

        $books = Book::all();
        return view('books',compact('books'));
    }

    public function addBook()
    {   $authors = Author::all();
        return view('addBook',compact('authors'));
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn',
            'pages'=> 'required',
            'category'=>'required|string',
            'cover_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Updated validation
            'authors_id' => 'required|integer|exists:authors,id',
            'description'=>'required',
        ]);

        


     $book = new Book;
     $book->name = $validatedData['name'];
     $book->isbn = $validatedData['isbn'];
     $book->pages = $validatedData['pages'];
     $book->category = $validatedData['category'];
     $book->authors_id = $validatedData['authors_id'];
     $book->description = $validatedData['description'];
 
     // Handle image upload and save URL to cover_url
     $imagePath = $request->file('cover_url')->store('book_covers', 'public');
     $book->cover_url = '/storage/' . $imagePath;
 
     $book->save();
 
     return redirect()->route('books.index')->with('success', 'Book created successfully');
 }

     
     
       

    public function show($id){

        $book = Book::with('author')->findOrFail($id);
        if(!empty($book)){

        return response()->json($book);

        }

        else
        {
            return response()->json([

                "message"=> "Book not found"],404);
        }
    }

    public function edit(Request $request,$id)
     {

        $book = Book::findOrFail($id);
        
        $authors = Author::all();
        return view('edit_book', compact('book','authors'));

     }

    public function update(Request $request, Book $book)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'cover_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Updated validation
            'pages'=> 'required',
            'author_id' => 'required|integer|exists:authors,id',
            'category' => 'required|string',
        ]);

        $book->update($validatedData);
    
        return response()->json([
            'message' => 'Book updated successfully',
            'book' => $book
        ]);

   }

    public function destroy($id)
    {
      if(Book::where('id', $id)->exists()){
        $book = Book::find($id);
        $book ->delete();

        return response()->json([
            "message"=>"records deleted ."
        ],202);
      }

      else{
        return response()->json([
            "message"=>"Book not found ."
        ], 404);
      }
    }
}
