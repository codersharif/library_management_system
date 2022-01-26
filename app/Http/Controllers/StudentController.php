<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;
use Validator;
use App\User;
use App\UserGroup;
use App\Student;
use Helper;

class StudentController extends Controller {

    public function index(Request $request) {

        $qpArr = $request->all();
        $targetArr = Student::join('users','users.id','=','students.user_id')
                ->join('user_group','user_group.id','=','users.user_group_id')
                ->select('users.*','user_group.group_name','students.id as student_id',
                'students.roll_no','students.dep','students.batch','students.semester')->get();


        // echo "<pre>";
        // print_r($targetArr);
        // exit;
        return view('student.index')->with(compact('targetArr', 'qpArr'));
    }

    public function create(Request $request) {
        $qpArr = $request->all();
        $groupList = UserGroup::where('id','103')->select('user_group.*')->get();
        return view('student.create', compact('qpArr','groupList'));
    }

    public function store(Request $request) {
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];

        $rules = [
            'user_group_id' => 'required',
            'name' => 'required',
            'roll_no' => 'required|unique:students',
            'dep' => 'required',
            'batch' => 'required',
            'email' => 'required|unique:users',
            // 'password' => 'required|complex_password:,' . $request->password,
            'password' => 'required|min:6',
            'conf_password' => 'required|same:password'
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('student/create' . $pageNumber)
                            ->withInput($request->except('password', 'conf_password'))
                            ->withErrors($validator);
        }

        $target = new User;
        $target->user_name = $request->name;
        $target->user_group_id = $request->user_group_id;
        $target->email = $request->email;
        $target->mobile = $request->mobile;
        $target->password = $request->password;
        $target->save();

        if( $target->id ){
            $student = new Student;
            $student->user_id = $target->id;
            $student->roll_no = $request->roll_no;
            $student->batch = $request->batch;
            $student->dep = $request->dep;
            $student->semester = $request->semester;
        }

        if ($student->save()) {
            Session::flash('success', 'Student Create Succesfully');
            return redirect('student');
        } else {
            $target->delete();
            Session::flash('error', 'Student could not be Created');
            return redirect('student/create' . $pageNumber);
        }
    }

    public function edit(Request $request, $id) {
//       $this->authorize('edit',$user);

        $user = Student::join('users','users.id','=','students.user_id')
        ->where('students.id',$id)
        ->select('users.*','students.id as student_id',
        'students.roll_no','students.dep','students.batch','students.semester')->first();

        if (empty($user)) {
            Session::flash('error', 'Invalid data id');
            return redirect('student');
        }
        //passing param for custom function
        $qpArr = $request->all();
        $groupList = UserGroup::where('id','103')->select('user_group.*')->get();
        return view('student.edit')->with(compact('user', 'qpArr','groupList'));
    }

    public function update(Request $request, $id) {

        $student = Student::find($id);
        $target = User::find($student->user_id);

        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = $qpArr['filter'];
        //end back same page after update
        $rules = [
            'user_group_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $target->id,
            'roll_no' => 'required|unique:students,roll_no,' . $id,
            'dep' => 'required',
            'batch' => 'required'
        ];

        if (!empty($request->password)) {
            $rules['password'] = 'required|min:6';
            $rules['conf_password'] = 'same:password';
        }

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('student/' . $id . '/edit' . $pageNumber)
                            ->withInput($request->all)
                            ->withErrors($validator);
        }

        $student->roll_no = $request->roll_no;
        $student->batch = $request->batch;
        $student->dep = $request->dep;
        $student->semester = $request->semester;

        $target->user_name = $request->name;
        $target->user_group_id = $request->user_group_id;
        $target->email = $request->email;
        $target->mobile = $request->mobile;

        if (!empty($request->password)) {
            $target->password = $request->password;
        }

        if ($target->save()) {
            Session::flash('success', 'Student Update Succesfully');
            return redirect('student');
        } else {
            Session::flash('error', 'Student could not be Updated');
            return redirect('student/' . $id . '/edit' . $pageNumber);
        }
    }

    public function destroy(Request $request, $id) {
        $student = Student::find($id);
        $target = User::find($student->user_id);
        //begin back same page after update
        $qpArr = $request->all();
        $pageNumber = !empty($qpArr['page']) ? '?page=' . $qpArr['page'] : '?page=';
        //end back same page after update

        if (empty($target)) {
            Session::flash('error','Invalid Data ID');
        }

        if ($student->delete()) {
            $target->delete();
            Session::flash('error','Student Delete Succesfully');
        } else {
            Session::flash('error', 'Student could not be Deleted');
        }
        return redirect('student' . $pageNumber);
    }

}
