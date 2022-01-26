@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @include('layouts.flash')
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Books List</h3>
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
