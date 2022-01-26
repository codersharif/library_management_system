<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('dashboard')}}" class="nav-link">Dahsboard</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form action="{{URL::to('/book/filter')}}" method="POST" class="form-inline ml-3">
        @csrf
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="fil_book" placeholder="Enter Book Name"
                aria-label="Search" value="{{Request::get('fil_book')}}" style="margin-right: 5px;">
            <input class="form-control form-control-navbar" type="text" name="fil_bookshelf_no"
                placeholder="Enter Bookshelf No." value="{{Request::get('fil_bookshelf_no')}}" aria-label="Search2">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</nav>
