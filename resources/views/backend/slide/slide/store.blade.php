@include('backend.dashboard.components.breadcrum', ['title' => $config['seo'][$config['method']]['title']])

@if (isset($errors) && $errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@php
$url = $config['method'] == 'create' ? route('slide.store') : route('slide.update', $slide->id);
@endphp

<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row mb15">
            <div class="col-lg-9">
                @include('backend.slide.slide.components.list')
            </div>

            <div class="col-lg-3">
                @include('backend.slide.slide.components.aside')
            </div>

        </div>


        <hr>

        <div class="text-right mb15">
            @if ($config['method'] == 'create')
            <button class="btn btn-primary" name="send" value="send" type="submit">Thêm </button>
            @else
            <button class="btn btn-primary" name="send" value="send" type="submit">Lưu thông tin
            </button>
            @endif
        </div>
    </div>
</form>