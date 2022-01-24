<div class="row">
    <div class="col-md-10">
        {{ $users->appends(Request::all())->links() }}
        <?php
        $start = empty($users->total()) ? 0 : (($users->currentPage() - 1) * $users->perPage() + 1);
        $end = ($users->currentPage() * $users->perPage() > $users->total()) ? $users->total() : ($users->currentPage() * $users->perPage());
        ?> <br />
        Showing {{ $start }} To {{$end}} Of  {{$users->total()}} Records
    </div>
    <div class="col-md-2" id="recordPerPageHolder">					
        {!! Form::open(array('group' => 'form', 'url' => 'setRecordPerPage', 'class' => '')) !!}
        <div class="input-group">
            <div class="input-icon">
                <i class="fa fa-list fa-fw"></i>
                {!! Form::text('record_per_page', Session::get('paginatorCount'), ['class' => 'form-control integer-only tooltips'
                , 'title' => 'Recorde Per Page', 'placeholder' => 'Recorde Per Page', 'id' => 'recordPerPage',
                'maxlength' => 3]) !!}
            </div>
            <span class="input-group-btn">
                <button id="" class="btn btn-success" type="submit">
                    <i class="fa fa-arrow-right fa-fw"></i></button>
            </span>
        </div>
        {!! Form::close() !!}
    </div>
</div>