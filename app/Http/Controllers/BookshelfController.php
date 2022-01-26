<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;
use Validator;
use App\BookShelf;
use Helper;

class BookshelfController extends Controller {

    public function index(Request $request) {

        $qpArr = $request->all();
        $targetArr = BookShelf::select('bookshelf.*')->get();
        return view('bookshelf.index')->with(compact('targetArr', 'qpArr'));
    }

    public function create(Request $request) {
        $qpArr = $request->all();
        return view('bookshelf.create', compact('qpArr'));
    }

    public function store(Request $request) {
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];

        $rules = [
            'bookshelf_no' => 'required|unique:bookshelf',
            'bookshelf_name' => 'required'
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('bookshelf/create' . $pageNumber)
                            ->withInput($request->all())
                            ->withErrors($validator);
        }

        $target = new BookShelf;
        $target->bookshelf_no = $request->bookshelf_no;
        $target->bookshelf_name = $request->bookshelf_name;

        if ($target->save()) {
            Session::flash('success', 'BookShelf Create Succesfully');
            return redirect('bookshelf');
        } else {
            Session::flash('error', 'BookShelf could not be Created');
            return redirect('bookshelf/create' . $pageNumber);
        }
    }

    public function edit(Request $request, $id) {
//       $this->authorize('edit',$user);

        $target = BookShelf::find($id);

        if (empty($target)) {
            Session::flash('error', 'Invalid data id');
            return redirect('bookshelf');
        }
        //passing param for custom function
        $qpArr = $request->all();
        return view('bookshelf.edit')->with(compact('target', 'qpArr'));
    }

    public function update(Request $request, $id) {

        $target = BookShelf::find($id);
        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];
        //end back same page after update
        $rules = [
            'bookshelf_name' => 'required',
            'bookshelf_no' => 'required|unique:bookshelf,bookshelf_no,' . $id,

        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('bookshelf/' . $id . '/edit' . $pageNumber)
                            ->withInput($request->all())
                            ->withErrors($validator);
        }


        $target->bookshelf_no = $request->bookshelf_no;
        $target->bookshelf_name = $request->bookshelf_name;

        if ($target->save()) {
            Session::flash('success', 'BookShelf Update Succesfully');
            return redirect('bookshelf');
        } else {
            Session::flash('error', 'BookShelf could not be Updated');
            return redirect('bookshelf/' . $id . '/edit' . $pageNumber);
        }
    }

    public function destroy(Request $request, $id) {
        $target = BookShelf::find($id);
        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = !empty($qpArr['page']) ? '?page=' . $qpArr['page'] : '?page=';
        //end back same page after update

        if (empty($target)) {
            Session::flash('error','Invalid Data ID');
        }

        if ($target->delete()) {
            Session::flash('error','BookShelf Delete Succesfully');
        } else {
            Session::flash('error', 'BookShelf could not be Deleted');
        }
        return redirect('bookshelf' . $pageNumber);
    }

}
