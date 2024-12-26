@php
$title = str_replace('{language}', $language->name, $config['seo']['translate']['title']) . ' ' . $menuCatalogue->name;
@endphp

@include('backend.dashboard.components.breadcrum', ['title' => $title])

@if (isset($errors) && $errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('menu.translate.save', ['languageId' => $languageId])}}" method="post">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel-title">Danh sách bản dịch</div>
                <div class="panel-description">
                    <p>+ Danh sách menu giúp bạn dễ dàng kiểm soát bố cục menu. Bạn có thể thêm mới hoặc cập nhật menu bằng
                        nút <span class="text-success">
                            Cập nhật Menu
                        </span>
                    </p>
                    <p>+ Bạn có thể thay đổi vị trí hiển thị của menu bằng cách <span class="text-success">kéo menu đến vị trí mong muốn</span>
                    </p>
                    <p>+ Bạn có thể dễ dàng khởi tạo menu con bằng cách ấn vào nút <span class="text-success">Quản lý menu con</span></p>
                    <p><span class="text-danger">+ Hỗ trợ tới danh mục con cấp 5</span></p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                            <h5 style="margin: 0;">Danh sách bản dịch</h5>
                        </div>
                    </div>
                    <div class="ibox-content" style="display: grid; gap: 20px;">
                        @if (count($menus))
                        @foreach ($menus as $key => $value)
                        <div class="menu-translate-item">
                            <div class="row">
                                <div class="col-lg-12 mb10">
                                    <div class="text-danger text-bold">Menu: {{$value->position}}</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle">
                                            <div class="menu-name">Tên menu</div>
                                            <input type="text" class="form-control" placeholder="" autocomplete="off"
                                                value="{{$value->languages->first()->pivot->name}}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle">
                                            <div class="menu-name">Đường dẫn</div>
                                            <input type="text" class="form-control" placeholder="" autocomplete="off"
                                                value="{{$value->languages->first()->pivot->canonical}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle">
                                            <input type="text" value="{{$value->translate_name ?? ''}}" name="translate[name][]" class="form-control" placeholder="Nhập vào bản dịch của bạn..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle">
                                            <input type="text" value="{{$value->translate_canonical ?? ''}}" name="translate[canonical][]" class="form-control" placeholder="Nhập vào bản dịch của bạn..." autocomplete="off">
                                            <input type="hidden" value="{{$value->id ?? ''}}" name="translate[id][]" class="form-control" placeholder="Nhập vào bản dịch của bạn..." autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mb15">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </div>
</form>