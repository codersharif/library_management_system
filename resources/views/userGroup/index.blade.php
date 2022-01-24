@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @include('layouts.flash')
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">User Group List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($targetArr as $target)
                            <tr>
                                <td>{{$target->id}}</td>
                                <td>{{$target->group_name}}</td>
                                <td>
                                    <div>
                                        <a class="btn btn-xs btn-primary tooltips vcenter" title="Edit" href="{{ URL::to('userGroup/' . $target->id . '/edit') }}">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
