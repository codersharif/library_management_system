<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;
use Validator;
use App\BookShelf;
use App\Book;
use App\Student;
use App\User;
use App\BookIssue;
use Helper;

class BookIssueController extends Controller {

    public function index(Request $request) {

        $qpArr = $request->all();
        $targetArr = BookIssue::join('books','books.id','=','book_issue.book_id')
                    ->join('students','students.id','=','book_issue.student_id')
                    ->select('book_issue.*','books.book_name','students.roll_no')->get();

        return view('bookIssue.index')->with(compact('targetArr', 'qpArr'));
    }

    public function create(Request $request) {
        $qpArr = $request->all();
        $bookList = Book::select('books.*')->get();
        $studentList = Student::select('students.*')->get();
        return view('bookIssue.create', compact('qpArr','bookList','studentList'));
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
            return redirect('bookIssue/create' . $pageNumber)
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
            return redirect('bookIssue');
        } else {
            Session::flash('error', 'Book could not be Created');
            return redirect('bookIssue/create' . $pageNumber);
        }
    }

    public function edit(Request $request, $id) {
//       $this->authorize('edit',$user);

        $target = BookIssue::find($id);

        if (empty($target)) {
            Session::flash('error', 'Invalid data id');
            return redirect('bookIssue');
        }
        //passing param for custom function
        $qpArr = $request->all();
        $bookList = Book::select('books.*')->get();
        $studentList = Student::select('students.*')->get();
        return view('bookIssue.edit', compact('qpArr','target','bookList','studentList'));
    }

    public function update(Request $request, $id) {

        $target = Book::find($id);

        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];
        //end back same page after update
        $rules = [
            'bookshelf_id' => 'required',
            'book_name' => 'required',
        ];

        $messages = [];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('bookIssue/' . $id . '/edit' . $pageNumber)
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
            return redirect('bookIssue');
        } else {
            Session::flash('error', 'Book could not be Updated');
            return redirect('bookIssue/' . $id . '/edit' . $pageNumber);
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
        return redirect('bookIssue' . $pageNumber);
    }

}
