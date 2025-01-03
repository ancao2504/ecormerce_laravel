<div class="ibox slide-setting slide-normal">
    <div class="ibox-title">
        <h5>Cài đặt cơ bản</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label">Tên slide <span
                            class="text-danger">(*)</span></label>
                    <input type="text" name="name"
                        value="{{ old('name', isset($slide) ? $slide->name : '') }}" placeholder=""
                        autocomplete="off" class="form-control">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label">Từ khóa <span
                            class="text-danger">(*)</span></label>
                    <input type="text" name="keyword"
                        value="{{ old('keyword', isset($slide) ? $slide->keyword : '') }}" placeholder=""
                        autocomplete="off" class="form-control">
                </div>
            </div>
        </div>

        <div class="row mb15">
            <div class="slide-setting">
                <div class="setting-item">
                    <div class="uk-flex uk-flex-middle">
                        <div class="setting-text">Chiều rộng</div>
                        <div class="setting-value">
                            <input type="text" name="setting[width]" class="form-control" value="0">
                            <span class="px">px</span>
                        </div>
                    </div>
                </div>

                <div class="setting-item">
                    <div class="uk-flex uk-flex-middle">
                        <div class="setting-text">Chiều cao</div>
                        <div class="setting-value">
                            <input type="text" name="setting[height]" class="form-control" value="0">
                            <span class="px">px</span>
                        </div>
                    </div>
                </div>

                <div class="setting-item">
                    <div class="uk-flex uk-flex-middle">
                        <div class="setting-text">Hiệu ứng</div>
                        <div class="setting-value">
                            <select name="setting[animation]" id="" class="form-control">
                                @foreach (__('module.effect') as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="setting-item">
                    <div class="uk-flex uk-flex-middle">
                        <div class="setting-text">Mũi tên</div>
                        <div class="setting-value">
                            <input type="checkbox" name="setting[arrow]" value="accept" checked>
                        </div>
                    </div>
                </div>

                <div class="setting-item">
                    <div class="uk-flex uk-flex-middle">
                        <div class="setting-text">Thanh điều hướng</div>
                        <div class="setting-value">
                            @foreach (__('module.navigate') as $key => $value)
                            <div class="nav-setting-item uk-flex uk-flex-middle">
                                <input
                                    type="radio"
                                    name="setting[navigate]"
                                    value="{{$value}}"
                                    id="navigate-{{ $key }}"
                                    {{old('setting.navigate', 'dots')  === $key ? 'checked' : ''}}>
                                <label for="navigate-{{ $key }}">{{ $value }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ibox slide-setting slide-advance">
    <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
        <h5>Cài đặt nâng cao</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>

    <div class="ibox-content">
        <div class="setting-item">
            <div class="uk-flex uk-flex-middle">
                <span class="setting-text">Tự động chạy</span>
                <div class="setting-value">
                    <input type="checkbox" name="setting[autoplay]" value="accept">
                </div>
            </div>
        </div>

        <div class="setting-item">
            <div class="uk-flex uk-flex-middle">
                <span class="setting-text">Dừng khi di chuột</span>
                <div class="setting-value">
                    <input type="checkbox" name="setting[pauseOnHover]" value="">
                </div>
            </div>
        </div>

        <div class="setting-item">
            <div class="uk-flex uk-flex-middle">
                <span class="setting-text">Thời gian chuyển ảnh</span>
                <div class="setting-value">
                    <input type="text" name="setting[animationDelay]" value="" class="form-control">
                    <span class="px">ms</span>
                </div>
            </div>
        </div>

        <div class="setting-item">
            <div class="uk-flex uk-flex-middle">
                <span class="setting-text">Tốc độ hiệu ứng</span>
                <div class="setting-value">
                    <input type="text" name="setting[animationSpeed]" value="" class="form-control">
                    <span class="px">ms</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ibox short-code">
    <div class="ibox-title">
        <h5>Short code</h5>
    </div>

    <div class="ibox-content">
        <textarea name="short-code" id="" class="textarea form-control"></textarea>
    </div>
</div>