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
Use Auth;
use Helper;

class BookIssueController extends Controller {

    public function index(Request $request) {

        $qpArr = $request->all();
        $targetArr = BookIssue::join('books','books.id','=','book_issue.book_id')
                    ->join('students','students.id','=','book_issue.student_id')
                    ->select('book_issue.*','books.book_name','students.roll_no');

         if( Auth::user()->user_group_id == '103' ){
             $student =  Student::where('user_id',Auth::user()->id)->select('id')->first();
            $targetArr = $targetArr->where('book_issue.student_id',$student->id);
         }
         $targetArr = $targetArr->orderBy('book_issue.id','DESC')->get();

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
            'student_id' => 'required',
            'book_id' => 'required',
            'issue_date' => 'required',
            'qty' => 'required',
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('bookIssue/create' . $pageNumber)
                            ->withInput($request->all())
                            ->withErrors($validator);
        }

        $target = new BookIssue;
        $target->student_id = $request->student_id;
        $target->book_id  = $request->book_id ;
        $target->issue_date = $request->issue_date;
        $target->return_date = $request->return_date;
        $target->return_status = $request->return_status;
        $target->qty = $request->qty;
        $target->received_date = $request->received_date;

        if ($target->save()) {
            Session::flash('success', 'Book Issue Create Succesfully');
            return redirect('bookIssue');
        } else {
            Session::flash('error', 'Book Issue could not be Created');
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

        $target = BookIssue::find($id);

        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];
        //end back same page after update
        $rules = [
            'student_id' => 'required',
            'book_id' => 'required',
            'issue_date' => 'required',
            'qty' => 'required',
        ];

        $messages = [];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('bookIssue/' . $id . '/edit' . $pageNumber)
                            ->withInput($request->all())
                            ->withErrors($validator);
        }

        $target->student_id = $request->student_id;
        $target->book_id  = $request->book_id ;
        $target->issue_date = $request->issue_date;
        $target->return_date = $request->return_date;
        $target->return_status = $request->return_status;
        $target->qty = $request->qty;
        $target->received_date = $request->received_date;

        if ($target->save()) {
            Session::flash('success', 'Book Issue Update Succesfully');
            return redirect('bookIssue');
        } else {
            Session::flash('error', 'Book Issue could not be Updated');
            return redirect('bookIssue/' . $id . '/edit' . $pageNumber);
        }
    }



}
