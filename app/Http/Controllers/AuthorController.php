<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
 public function index()
 {
    $authors = Author::all();
    return view('authors', compact('authors'));
 }

 public function register()
 {
    return view('register');
 }

 public function store(Request $request)
 {
     $validatedData = $request->validate([
         'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         'firstname' => 'required|string|max:255',
         'lastname' => 'required|string|max:255',
         'type' => 'required|string',
         'email' => 'required|email|max:255',
         'write_up' => 'required|string',
     ]);


 
     $author = new Author;
     $author->firstname = $validatedData['firstname'];
     $author->lastname = $validatedData['lastname'];
     $author->type = $validatedData['type'];
     $author->email = $validatedData['email'];
     $author->write_up = $validatedData['write_up'];
 
     // Handle image upload and save URL to image_url
     $imagePath = $request->file('image_url')->store('author_images', 'public');
     $author->image_url = '/storage/' . $imagePath;
 
     $author->save();
 
     return redirect()->route('authors.index')->with('success', 'Author created successfully');
 }
 

 public function show($authorId)
 {
     $author = Author::with('books')->findOrFail($authorId);
     return response()->json($author);
 }

public function update(Request $request, $id)
{
    $author = Author::findOrFail($id);
    $author->update($request->all());
    return response()->json($author, 200);
}

public function destroy($id)
{
    Author::destroy($id);
    return response()->json(null, 204);
}
}
