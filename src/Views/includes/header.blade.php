<header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm justify-content-start position-sticky sticky-top">
    <button class="mx-2 btn btn-light border-0 d-lg-none" data-toggle="expand-sidebar" data-target="#sidebar">
        <i class="fa toggler-icon"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto align-items-center">
            <li class="nav-item mx-3">
                <form class="form-inline">
                    <div class="input-group position-relative navbar-search">
                        <label class="sr-only" for="search">@lang('Search')</label>
                        <input type="text" id="search" name="search" class="form-control bg-light border-0" placeholder="Search">

                        <button class="btn btn-light search-btn p-0" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </li>
        </ul>

        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <form method="POST" action="{{ Route::has('logout') ? route('logout') : url('/logout') }}">
                    <button type="submit" class="btn btn-light btn-sm">
                        <i class="fa fa-sign-out"></i> @lang('Sign out')
                    </button>
                </form>
            </li>
        </ul>
    </div>
</header>
