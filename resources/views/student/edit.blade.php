@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: 10px;">
                <div class="card-header">
                    <h4>Edit Student</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{URL::to('/student/update/'.$user->student_id)}}">
                        <input type="hidden" name="filter" value="{{Helper::queryPageStr($qpArr)}}" />
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <select name="user_group_id" class="form-control">
                                <option value="">Select User Group</option>
                                @foreach($groupList as $group)
                                <?php
                                    $selected = '';
                                    if( $group->id == $user->user_group_id ){
                                        $selected = 'selected';
                                    }
                                ?>
                                <option value="{{$group->id}}" <?=$selected?>>{{$group->group_name}}</option>
                                @endforeach
                            </select>
                            @error('user_group_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{$user->user_name}}"
                                class="form-control" />
                            @error('name')
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" />
                            @error('email')
                            <span class="text-danger">{{$errors->first('email')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="roll_no">Roll No.</label>
                            <input type="text" name="roll_no" value="{{$user->roll_no}}" id="roll_no"
                                class="form-control" />
                            @error('roll_no')
                            <span class="text-danger">{{$errors->first('roll_no')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dep">Department</label>
                            <input type="text" name="dep" value="{{$user->dep}}" id="dep" class="form-control" />
                            @error('dep')
                            <span class="text-danger">{{$errors->first('dep')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="batch">Batch</label>
                            <input type="text" name="batch" value="{{$user->batch}}" id="batch" class="form-control" />
                            @error('batch')
                            <span class="text-danger">{{$errors->first('batch')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" name="semester" value="{{$user->semester}}" id="semester"
                                class="form-control" />
                            @error('semester')
                            <span class="text-danger">{{$errors->first('semester')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" value="{{$user->mobile}}" id="mobile"
                                class="form-control" />
                            @error('email')
                            <span class="text-danger">{{$errors->first('mobile')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" />
                            @error('password')
                            <span class="text-danger">{{$errors->first('password')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="conf_password">Confirm Password</label>
                            <input type="password" name="conf_password" id="conf_password" class="form-control" />
                            @error('conf_password')
                            <span class="text-danger">{{$errors->first('conf_password')}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ URL::to('/student'.Helper::queryPageStr($qpArr)) }}"
                            class="btn btn-circle btn-outline grey-salsa">Cancel</a>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
