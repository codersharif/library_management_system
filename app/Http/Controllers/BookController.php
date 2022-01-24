<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;
use Validator;
use App\BookShelf;
use App\Book;
use Helper;

class BookController extends Controller {

    public function index(Request $request) {

        $qpArr = $request->all();
        $targetArr = Book::join('bookshelf','bookshelf.id','=','books.bookshelf_id')
                ->select('books.*','bookshelf.bookshelf_no','bookshelf.bookshelf_name')->get();

        return view('book.index')->with(compact('targetArr', 'qpArr'));
    }

    public function create(Request $request) {
        $qpArr = $request->all();
        $bookshelf = BookShelf::select('bookshelf.*')->get();
        return view('book.create', compact('qpArr','bookshelf'));
    }

    public function store(Request $request) {
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];

        $rules = [
            'bookshelf_id' => 'required',
            'book_name' => 'required',
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('book/create' . $pageNumber)
                            ->withInput($request->all())
                            ->withErrors($validator);
        }

        $target = new Book;
        $target->book_name = $request->book_name;
        $target->bookshelf_id  = $request->bookshelf_id ;
        $target->author = $request->author;
        $target->edition = $request->edition;
        $target->type = $request->type;
        $target->genre = $request->genre;
        $target->publication_name = $request->publication_name;
        $target->category = $request->category;

        if ($target->save()) {
            Session::flash('success', 'Book Create Succesfully');
            return redirect('book');
        } else {
            Session::flash('error', 'Book could not be Created');
            return redirect('book/create' . $pageNumber);
        }
    }

    public function edit(Request $request, $id) {
//       $this->authorize('edit',$user);

        $target = Book::join('bookshelf','bookshelf.id','=','books.bookshelf_id')
        ->where('books.id',$id)
        ->select('books.*','bookshelf.bookshelf_no','bookshelf.bookshelf_name')->first();

        if (empty($target)) {
            Session::flash('error', 'Invalid data id');
            return redirect('book');
        }
        //passing param for custom function
        $qpArr = $request->all();
        $bookshelf = BookShelf::select('bookshelf.*')->get();
        return view('book.edit')->with(compact('target', 'qpArr','bookshelf'));
    }

    public function update(Request $request, $id) {

        $target = Book::find($id);

        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];
        //end back same page after update
        $rules = [
            'bookshelf_id ' => 'required',
            'book_name' => 'required',
        ];

        $messages = [];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('book/' . $id . '/edit' . $pageNumber)
                            ->withInput($request->all())
                            ->withErrors($validator);
        }

        $target->book_name = $request->book_name;
        $target->bookshelf_id  = $request->bookshelf_id ;
        $target->author = $request->author;
        $target->edition = $request->edition;
        $target->type = $request->type;
        $target->genre = $request->genre;
        $target->publication_name = $request->publication_name;
        $target->category = $request->category;

        if ($target->save()) {
            Session::flash('success', 'Book Update Succesfully');
            return redirect('book');
        } else {
            Session::flash('error', 'Book could not be Updated');
            return redirect('book/' . $id . '/edit' . $pageNumber);
        }
    }

    public function destroy(Request $request, $id) {
        $target = Book::find($id);
        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = !empty($qpArr['page']) ? '?page=' . $qpArr['page'] : '?page=';
        //end back same page after update

        if (empty($target)) {
            Session::flash('error','Invalid Data ID');
        }

        if ($target->delete()) {
            Session::flash('error','Book Delete Succesfully');
        } else {
            Session::flash('error', 'Book could not be Deleted');
        }
        return redirect('book' . $pageNumber);
    }

}
