@extends('includes.panel.base')
@section('page_title')
    @lang('اعلان‌ها')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            @if (isset($data))
                @foreach ($data as $item)
                    <div class="alert alert-{{ $item->type }}" role="alert">
                        {!! $item->content !!}
                    </div>
                @endforeach
                {{ $data->onEachSide(5)->links() }}
            @else
                <div class="alert alert-warning" role="alert">
                    اعلانی جهت نمایش وجود ندارد !
                </div>
            @endif
        </div>
    </div>
@endsection
