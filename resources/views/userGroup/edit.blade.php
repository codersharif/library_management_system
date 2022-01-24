@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: 10px;">
                <div class="card-header">
                    <h5>Edit User Group</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{URL::to('/userGroup/update/'.$group->id)}}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="group_name">Group Name</label>
                            <input type="text" name="group_name" id="group_name" value="{{$group->group_name}}"
                                class="form-control" />
                            @error('group_name')
                            <span class="text-danger">{{$errors->first('group_name')}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ URL::to('/userGroup') }}" class="btn btn-circle btn-outline grey-salsa">Cancel</a>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
