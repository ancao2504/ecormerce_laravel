@include('backend.dashboard.components.breadcrum', ['title' => $config['seo']['delete']['title']])
<form action="{{route('slide.destroy', $slide->id)}}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Bạn đang muốn xóa slide có tên là : {{ $slide->name }}</p>
                        <p>Lưu ý: Không thể khôi phục slide khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng
                            này.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label">Tên <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" name="name"
                                        value="{{ old('name', isset($slide) ? $slide->name : '') }}" placeholder=""
                                        autocomplete="off" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="text-right mb15">
            <button class="btn btn-danger" name="send" value="send" type="submit">Xóa</button>
        </div>
    </div>
</form>