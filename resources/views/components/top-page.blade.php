<div class="page-title">
    <div class="row">
        <div class="col-12 col-sm-6">
            <h3>{{ $title }}</h3>
        </div>
        <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ $homeUrl ?? '#' }}"><i data-feather="home"></i></a>
                </li>
                @foreach($items as $item)
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                        {{ $item }}
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
