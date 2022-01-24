@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @include('layouts.flash')
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Books List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <a href="{{ URL::to('book/create'.Helper::queryPageStr($qpArr)) }}">
                                    <button class="btn btn-success btn-sm">Create</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Bookshelf</th>
                                <th>Book Name</th>
                                <th>Author</th>
                                <th>Edition</th>
                                <th>Publication</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Genre</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $page = Request::get('page');
                            $page = empty($page) ? 1 : $page;
                            $sl = 0;
                            ?>
                            @foreach($targetArr as $target)
                            <tr>
                                <td>{{++$sl}}</td>
                                <td>{{$target->bookshelf_no}} - {{$target->bookshelf_name}} </td>
                                <td>{{$target->book_name}}</td>
                                <td>{{$target->author}}</td>
                                <td>{{$target->edition}}</td>
                                <td>{{$target->publication_name}}</td>
                                <td>{{$target->category}}</td>
                                <td>{{$target->type}}</td>
                                <td>{{$target->genre}}</td>
                                <td>
                                    <div>
                                        <form method="post"
                                            action="{{ URL::to('book/' . $target->id .'/'.Helper::queryPageStr($qpArr)) }}">
                                            @csrf
                                            @method('delete')
                                            <a class="btn btn-xs btn-primary tooltips vcenter" title="Edit"
                                                href="{{ URL::to('book/' . $target->id . '/edit'.Helper::queryPageStr($qpArr)) }}">
                                                Edit
                                            </a>
                                            <button class="btn btn-xs btn-danger delete tooltips vcenter"
                                                onclick="return confirm('Are you sure, want to delete!');"
                                                type="submit">
                                                Delete
                                            </button>
                                        </form>

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
