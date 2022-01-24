@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: 10px;">
                <div class="card-header">
                    <h4>Create book</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{URL::to('/book/store')}}">
                        <input type="hidden" name="filter" value="{{Helper::queryPageStr($qpArr)}}" />
                        @csrf
                        <div class="form-group">
                            <label for="bookshelf_id">Bookshelf</label>
                            <select name="bookshelf_id" class="form-control">
                                <option value="">Select Bookshelf</option>
                                @foreach($bookshelf as $val)
                                <option value="{{$val->id}}">{{$val->bookshelf_no}} - {{$val->bookshelf_name}}</option>
                                @endforeach
                            </select>
                            @error('bookshelf_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="book_name">Book Name</label>
                            <input type="text" name="book_name" id="book_name" class="form-control" />
                            @error('book_name')
                            <span class="text-danger">{{$errors->first('book_name')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="author" name="author" id="author" class="form-control" />
                            @error('author')
                            <span class="text-danger">{{$errors->first('author')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edition">Edition</label>
                            <input type="text" name="edition" id="edition" class="form-control" />
                            @error('edition')
                            <span class="text-danger">{{$errors->first('edition')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="publication_name">Publication</label>
                            <input type="text" name="publication_name" id="publication_name" class="form-control" />
                            @error('publication_name')
                            <span class="text-danger">{{$errors->first('publication_name')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category" class="form-control" />
                            @error('category')
                            <span class="text-danger">{{$errors->first('category')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" name="type" id="type" class="form-control" />
                            @error('type')
                            <span class="text-danger">{{$errors->first('type')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <input type="text" name="genre" id="genre" class="form-control" />
                            @error('genre')
                            <span class="text-danger">{{$errors->first('genre')}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
