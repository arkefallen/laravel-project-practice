<?php

namespace App\Http\Controllers;

use App\Book;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Middleware\Authenticate;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Auth;
use Image;

class BookController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function bookGallery(){
        $maxPage = 6;
        $bookData = Book::orderBy('id','desc')->paginate($maxPage);

        $num = $maxPage * ($bookData->currentPage()-1);
        return view('book.booklist',compact('bookData','num'));
    }

    public function bookGalleries($title){
        $bookData = Book::where('book_seo',$title)->first();
        $galleries = $bookData->photos()->orderBy('id','desc')->paginate(6);
        $comments = $bookData->comments()->orderBy('id','desc')->paginate(9999);

        return view('book.bookdetail',compact('bookData','galleries','comments'));
    }

    public function comment(Request $req, $book_id) {
        $this->validate($req, [
            'comment' => 'required'
        ]);

        $user_id = Auth::id();


        $comment = new Comment;
        $comment->book_id = $book_id;
        $comment->user_id = $user_id;
        $comment->comment = $req->comment;

        $comment->save();

        $bookData = Book::where('id',$book_id)->first();
        $galleries = $bookData->photos()->orderBy('id','desc')->paginate(6);
        $comments = $bookData->comments()->orderBy('id','desc')->paginate(9999);

        return view('book.bookdetail',compact('bookData','galleries','comments'))->with('msg_success_comment','Successfully comment a book.');
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

    public function like($id) {
        $books = Book::find($id);
        $books->increment('like');
        Return back();
    }

    public function create(){
        return view('book.create');
    }

    public function store(Request $req) {
        $this->validate($req, [
            'title' => 'required|string',
            'author' => 'required|string|max:30',
            'price' => 'required|numeric',
            'published_date' => 'required|date',
            'photo' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        
        $book = new Book;
        $book->title = $req->title;
        $book->author = $req->author;
        $book->price = $req->price;
        $book->published_date = $req->published_date;
        $book->book_seo = Str::slug($book->title,'-');

        $photo = $req->photo;
        $photoFile = time().'.'.$photo->getClientOriginalExtension();

        Image::make($photo)->resize(200,150)->save('assets/img/'.$photoFile);
        $photo->move('images/'.$photoFile);

        $book->photo = $photoFile;

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
