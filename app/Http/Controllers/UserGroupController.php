<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;
use Validator;
use App\UserGroup;
use Helper;

class UserGroupController extends Controller {

    public function index(Request $request) {

        $qpArr = $request->all();
        $targetArr = UserGroup::select('user_group.*')->get();
        return view('userGroup.index')->with(compact('targetArr', 'qpArr'));
    }

    public function edit(Request $request, $id) {
        $group = UserGroup::find($id);


        if (empty($group)) {
            Session::flash('error', 'Invalid data id');
            return redirect('userGroup');
        }
        //passing param for custom function
        $qpArr = $request->all();

        return view('userGroup.edit')->with(compact('group', 'qpArr'));
    }

    public function update(Request $request, $id) {

        $target = UserGroup::find($id);
        //begin back same page after update
        $qpArr = $request->all();
        //end back same page after update
        $rules = [
            'group_name' => 'required|unique:user_group,group_name,' . $id,
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('userGroup/' . $id . '/edit')
                            ->withInput($request->all)
                            ->withErrors($validator);
        }

        $target->group_name = $request->group_name;

        if ($target->save()) {
            Session::flash('success', 'Group Name Update Succesfully');
            return redirect('userGroup');
        } else {
            Session::flash('error', 'Group Name could not be Updated');
            return redirect('userGroup/' . $id . '/edit');
        }
    }

}
