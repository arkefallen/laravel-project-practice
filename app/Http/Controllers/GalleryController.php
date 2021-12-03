<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Book;
use File;
use Image;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maxPage = 3;
        $galleries = Gallery::orderBy('id','desc')->paginate($maxPage);
        $totalGallery = Gallery::count('gallery_name');

        $num = $maxPage * ($galleries->currentPage()-1);
        return view('gallery.gallery',compact('galleries','num','totalGallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        
        return view('gallery.create',compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req,[
            'gallery_name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        $gallery = new Gallery;
        $gallery->gallery_name = $req->gallery_name;
        $gallery->description = $req->description;
        $gallery->book_id = $req->book_id;

        $image = $req->image;
        $imgFile = time().'.'.$image->getClientOriginalExtension();

        Image::make($image)->save('assets/img/'.$imgFile);
        $image->move('images/'.$imgFile);

        $gallery->image = $imgFile;
        $gallery->save();
        
        return redirect('/gallery')->with('msg_success_store','Succefully saving a data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::find($id);
        $books = Book::all();

        return view('gallery.edit', compact('gallery','books'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'gallery_name' => 'required',
            'description' => 'required',
            'book_id' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        $gallery = Gallery::find($id);
        $gallery->gallery_name = $req->gallery_name;
        $gallery->description = $req->description;
        $gallery->book_id = $req->book_id;

        $image = $req->image;
        $imgFile = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(200,150)->save('assets/img/'.$imgFile);
        $image->move('images/'.$imgFile);
        $gallery->image = $imgFile;

        $gallery->update();
        return redirect('/gallery')->with('msg_success_update','Successfully updating a data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        return redirect('/gallery')->with('msg_success_remove','Successfully removing a data');
    }
}
