@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: 10px;">
                <div class="card-header">
                    <h4>Create Book Issue</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{URL::to('/bookIssue/store')}}">
                        <input type="hidden" name="filter" value="{{Helper::queryPageStr($qpArr)}}" />
                        @csrf
                        <div class="form-group">
                            <label for="student_id">Students</label>
                            <select name="student_id" class="form-control">
                                <option value="">Select Student</option>
                                @foreach($studentList as $val)
                                <option value="{{$val->id}}">{{$val->roll_no}}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Books</label>
                            <select name="book_id" class="form-control">
                                <option value="">Select Book</option>
                                @foreach($bookList as $val)
                                <option value="{{$val->id}}">{{$val->book_name}}</option>
                                @endforeach
                            </select>
                            @error('book_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="issue_date">Issue Date</label>
                            <input type="date" name="issue_date" id="issue_date" class="form-control" />
                            @error('issue_date')
                            <span class="text-danger">{{$errors->first('issue_date')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="return_date">Return Date</label>
                            <input type="date" name="return_date" id="return_date" class="form-control" />
                            @error('return_date')
                            <span class="text-danger">{{$errors->first('return_date')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="number" min="1" name="qty" id="qty" class="form-control" />
                            @error('qty')
                            <span class="text-danger">{{$errors->first('qty')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="received_date">Receive Data</label>
                            <input type="date" name="received_date" id="received_date" class="form-control" />
                            @error('received_date')
                            <span class="text-danger">{{$errors->first('received_date')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Return Status</label>
                            <select name="return_status" class="form-control">
                                <option value="1">Pending</option>
                                <option value="2">Received</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
