<div class="ibox">
    <div class="ibox-title">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <h5>Danh sách slide</h5>
            <button type="button" class="addSlide btn btn-success">Thêm slide</button>
        </div>
    </div>

    <div class="ibox-content">
        <div id="sorttable" class="row slide-list ui-sorttable ui-sortable">
            <div class="text-danger slide-notification">Chưa có ảnh nào được chọn...</div>

            @php
            $slides = old('slide', $slideItem ?? null);
            $i = 1;
            @endphp

            @if (isset($slides) && is_array($slides))
            @foreach ($slides['image'] as $key => $value)
            @php
            $image = $value;
            $description = $slides['description'][$key];
            $url = $slides['url'][$key];
            $name = $slides['name'][$key];
            $alt = $slides['alt'][$key];
            $window = isset($slides['window'][$key]) ? $slides['window'][$key] : '';
            @endphp
            <div class="col-lg-12 ui-state-default ui-sortable-handle">
                <div class="slide-item mb20">
                    <div class="row custom-row">
                        <div class="col-sm-3">
                            <div class="slide-image">
                                <img src="{{ $image }}" alt="">
                                <input type="hidden" name="slide[image][]" value="{{ $image }}">
                                <span class=" delete-slide"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab{{$i}}" aria-expanded="true"> Thông tin chung</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab{{$i+1}}" aria-expanded="false">SEO</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab{{$i}}" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="label-text mb5">Mô tả</div>
                                            <div class="form-row mb10">
                                                <textarea name="slide[description][]" id="" class="form-control">{{ $description }}</textarea>
                                            </div>
                                            <div class="form-row form-row-url">
                                                <input type="text" class="form-control" placeholder="URL" name="slide[url][]" value="{{ $url }}">
                                                <div class="overlay">
                                                    <div class="uk-flex uk-flex-middle">
                                                        <label for="input_tab-{{$i}}">Mở trong tab mới</label>
                                                        <input type="checkbox" value="_blank" id="input_tab-{{$i}}" name="slide[window][]"
                                                            {{$window == '_blank' ? 'checked' : ''}}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab{{$i+1}}" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="form-row form-row-url slide-seo-tab mb15">
                                                <div class="label-text mb5">Tiêu đề ảnh</div>
                                                <input type="text" class="form-control" placeholder="Tiêu đề ảnh" name="slide[name][]" value="{{ $name }}">
                                            </div>

                                            <div class="form-row form-row-url slide-seo-tab">
                                                <div class="label-text mb5">Mô tả ảnh</div>
                                                <input type="text" class="form-control" placeholder="Mô tả ảnh" name="slide[alt][]" value="{{ $alt }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            @php
            $i+=2;
            @endphp
            @endforeach
            @endif


        </div>
    </div>
</div>