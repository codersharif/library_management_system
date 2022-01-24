<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;
use Validator;
use App\User;
use App\UserGroup;
use Helper;

class UserController extends Controller {

    public function index(Request $request) {

        $qpArr = $request->all();
        $targetArr = User::join('user_group','user_group.id','=','users.user_group_id')
                ->where('users.user_group_id','!=','103')
                ->select('users.*','user_group.group_name')->get();


        // echo "<pre>";
        // print_r($targetArr);
        // exit;
        return view('users.index')->with(compact('targetArr', 'qpArr'));
    }

    public function create(Request $request) {
        $qpArr = $request->all();
        $groupList = UserGroup::where('id','!=','103')->select('user_group.*')->get();
        return view('users.create', compact('qpArr','groupList'));
    }

    public function store(Request $request) {
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];

        $rules = [
            'user_group_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            // 'password' => 'required|complex_password:,' . $request->password,
            'password' => 'required|min:6',
            'conf_password' => 'required|same:password'
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('users/create' . $pageNumber)
                            ->withInput($request->except('password', 'conf_password'))
                            ->withErrors($validator);
        }

        $target = new User;
        $target->user_name = $request->name;
        $target->user_group_id = $request->user_group_id;
        $target->email = $request->email;
        $target->designation = $request->designation;
        $target->mobile = $request->mobile;
        $target->password = $request->password;

        if ($target->save()) {
            Session::flash('success', 'Users Create Succesfully');
            return redirect('users');
        } else {
            Session::flash('error', 'Users could not be Created');
            return redirect('users/create' . $pageNumber);
        }
    }

    public function edit(Request $request, $id) {
//       $this->authorize('edit',$user);

        $user = User::find($id);
        $groupList = UserGroup::where('id','!=','103')->select('user_group.*')->get();

        if (empty($user)) {
            Session::flash('error', 'Invalid data id');
            return redirect('users');
        }
        //passing param for custom function
        $qpArr = $request->all();

        return view('users.edit')->with(compact('user', 'qpArr','groupList'));
    }

    public function update(Request $request, $id) {

        $target = User::find($id);
        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];
        //end back same page after update
        $rules = [
            'user_group_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
        ];

        if (!empty($request->password)) {
            $rules['password'] = 'required|min:6';
            $rules['conf_password'] = 'same:password';
        }

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('users/' . $id . '/edit' . $pageNumber)
                            ->withInput($request->all)
                            ->withErrors($validator);
        }

        $target->user_name = $request->name;
        $target->user_group_id = $request->user_group_id;
        $target->email = $request->email;
        $target->designation = $request->designation;
        $target->mobile = $request->mobile;

        if (!empty($request->password)) {
            $target->password = $request->password;
        }

        if ($target->save()) {
            Session::flash('success', 'Users Update Succesfully');
            return redirect('users');
        } else {
            Session::flash('error', 'Users could not be Updated');
            return redirect('users/' . $id . '/edit' . $pageNumber);
        }
    }

    public function destroy(Request $request, $id) {
        $target = User::find($id);
        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = !empty($qpArr['page']) ? '?page=' . $qpArr['page'] : '?page=';
        //end back same page after update

        if (empty($target)) {
            Session::flash('error','Invalid Data ID');
        }

        if ($target->delete()) {
            Session::flash('error','Users Delete Succesfully');
        } else {
            Session::flash('error', 'Users could not be Deleted');
        }
        return redirect('users' . $pageNumber);
    }

    public function setRecordPerPage(Request $request) {
        $referrerArr = explode('?', URL::previous());
        $queryStr = '';
        if (!empty($referrerArr[1])) {
            $queryParam = explode('&', $referrerArr[1]);
            foreach ($queryParam as $item) {
                $valArr = explode('=', $item);
                if ($valArr[0] != 'page') {
                    $queryStr .= $item . '&';
                }
            }
        }

        $url = $referrerArr[0] . '?' . trim($queryStr, '&');

        if ($request->record_per_page > 999) {
            Session::flash('error', "No of Record Must be less than 999");
            return redirect($url);
        }

        if ($request->record_per_page < 1) {
            Session::flash('error', "No of Record Must be Greater than 1");
            return redirect($url);
        }

        $request->session()->put('paginatorCount', $request->record_per_page);
        return redirect($url);
    }

}
