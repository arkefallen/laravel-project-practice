<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Middleware\Authenticate;

class BookController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index() {
        $maxPage = 3;
        $bookData = Book::orderBy('id','desc')->paginate($maxPage);
        $totalBooks = Book::count('title');
        $totalPrice = Book::sum('price');

        $num = $maxPage * ($bookData->currentPage()-1);
        return view('book',compact('bookData','num','totalBooks','totalPrice'));
    }

    public function search(Request $req) {
        $maxPage = 3;
        $findBook = $req->sentence;
        $bookData = Book::where('title','like',"%".$findBook."%")->orwhere('author','like',"%".$findBook."%")->paginate($maxPage);
        $totalBooks = count($bookData);
        $totalPrice = 0;
        foreach ($bookData as $book) {
            $totalPrice+=$book->price;
        }

        $num = $maxPage * ($bookData->currentPage()-1);
        return view('book.search',compact('bookData','num','totalBooks','totalPrice','findBook'));
    }

    public function create(){
        return view('book.create');
    }

    public function store(Request $req) {
        $this->validate($req, [
            'title' => 'required|string',
            'author' => 'required|string|max:30',
            'price' => 'required|numeric',
            'published_date' => 'required|date'
        ]);
        $book = new Book;
        $book->title = $req->title;
        $book->author = $req->author;
        $book->price = $req->price;
        $book->published_date = $req->published_date;
        $book->save();
        return redirect('/book')->with('msg_success_store','Successfully saving a data.');
    }

    public function destroy($id) {
        $book = Book::find($id);
        $book->delete();
        return redirect('/book')->with('msg_success_remove','Successfully removing a data');
    }

    public function edit($id, Request $req) {
        $this->validate($req, [
            'title' => 'required|string',
            'author' => 'required|string|max:30',
            'price' => 'required|numeric',
            'published_date' => 'required|date'
        ]);
        $book = Book::find($id);
        $book->title = $req->title;
        $book->author = $req->author;
        $book->price = $req->price;
        $book->published_date = $req->published_date;
        $book->update();
        return redirect('/book')->with('msg_success_update','Successfully updating a data');
    }

    public function update($id){
        $book = Book::find($id);
        return view('book.update', compact('book'));
    }
}
