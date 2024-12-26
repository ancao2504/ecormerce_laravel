@include('backend.dashboard.components.breadcrum', ['title' => $config['seo'][$config['method']]['title']])

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="uk-flex uk-flex-middle" style="gap: 10px;">
                @foreach ($languages as $key => $language)
                @php
                $url = session('app_locale') == $language->canonical ? route('menu.edit', ['id' => $id])
                : route('menu.translate', ['languageId' => $language->id, 'id' => $id]);
                @endphp
                <a href="{{$url}}" class="language-item {{ $language->current == 1 ? 'active' : '' }}">
                    {{ $language['name'] }}
                </a>
                @endforeach
            </div>

            <div class="panel-title">Danh sách menu</div>
            <div class="panel-description">
                <p>+ Danh sách menu giúp bạn dễ dàng kiểm soát bố cục menu. Bạn có thể thêm mới hoặc cập nhật menu bằng
                    nút <span class="text-success">
                        Cập nhật Menu
                    </span>
                </p>
                <p>+ Bạn có thể thay đổi vị trí hiển thị của menu bằng cách <span class="text-success">kéo menu đến vị
                        trí
                        mong muốn</span>
                </p>
                <p>+ Bạn có thể dễ dàng khởi tạo menu con bằng cách ấn vào nút <span class="text-success">Quản lý menu
                        con</span></p>
                <p><span class="text-danger">+ Hỗ trợ tới danh mục con cấp 5</span></p>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <h5 style="margin: 0;">{{$menuCatalogue->name}}</h5>
                        <a href="{{ route('menu.editMenu', ['id' => $id]) }}" class="custom-button">Cập
                            nhật Menu</a>
                    </div>
                </div>

                <div class="ibox-content" id="dataCatalogue" data-catalogueId="{{ $id }}">
                    @php
                    $menus = recursive($menus);
                    $menuHtml = recursive_menu($menus);
                    @endphp

                    @if(count($menus))
                    <div class="dd" id="nestable2">
                        <ol class="dd-list">
                            {!! $menuHtml !!}
                        </ol>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>