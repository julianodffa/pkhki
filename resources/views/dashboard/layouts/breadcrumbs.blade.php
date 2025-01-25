{{-- Breadcrumb Section --}}
@if (isset($breadcrumbs) && is_array($breadcrumbs))
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb['active'])
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['label'] }}</li>
                @else
                    <li class="breadcrumb-item">
                        <a class="text-decoration-none text-dark" href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
