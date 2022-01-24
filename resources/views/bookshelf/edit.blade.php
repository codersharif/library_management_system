@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: 10px;">
                <div class="card-header">
                    <h4>Edit Bookshelf</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{URL::to('/bookshelf/update/'.$target->id)}}">
                        <input type="hidden" name="filter" value="{{Helper::queryPageStr($qpArr)}}" />
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="bookshelf_no">Bookshelf No.</label>
                            <input type="text" name="bookshelf_no" id="bookshelf_no" value="{{$target->bookshelf_no}}"
                                class="form-control" />
                            @error('bookshelf_no')
                            <span class="text-danger">{{$errors->first('bookshelf_no')}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bookshelf_name">Bookshelf Name</label>
                            <input type="text" name="bookshelf_name" id="bookshelf_name"
                                value="{{$target->bookshelf_name}}" class="form-control" />
                            @error('bookshelf_name')
                            <span class="text-danger">{{$errors->first('bookshelf_name')}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ URL::to('/bookshelf'.Helper::queryPageStr($qpArr)) }}"
                            class="btn btn-circle btn-outline grey-salsa">Cancel</a>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
