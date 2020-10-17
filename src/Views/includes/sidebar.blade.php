<aside id="sidebar" class="bg-blue-grey d-flex flex-column justify-content-between collapsed">
    <div class="w-100">
        <div class="navbar">
            <a class="sidebar-brand" href="{{ route('control-panel') }}">
                {{------------------------
                 | Includeing brand logo |
                 -----------------------}}
                @include('control-panel::includes.brand-logo')

                <span class="brand-text">
                    @lang('Control Panel')
                </span>
            </a>

            <button class="mx-2 btn btn-light border-0 d-lg-none" data-toggle="expand-sidebar" data-target="#sidebar">
                <i class="fa toggler-icon"></i>
            </button>
        </div>

        <ul class="accordion list-unstyled m-0">
            @foreach(app('control-panel')->menus() as $menu => $items)
                <li class="position-relative">
                    <button class="sidebar-collapse-toggler" type="button" data-toggle="collapse" data-target="#collapse-{{ $loop->index }}">
                        {!! $menu !!}
                    </button>

                    <div class="sidebar-collapse-dropdown" id="collapse-{{ $loop->index }}">
                        @foreach($items as  $item) @php($item = (object) $item)
                            <a class="sidebar-collapse-item" href="#/{{ ltrim($item->url, '/') }}" data-route>
                                {!! $item->title !!}
                            </a>
                        @endforeach
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</aside>


