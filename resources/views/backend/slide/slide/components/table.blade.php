<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th>Tên nhóm</th>
            <th>Từ khóa</th>
            <th>Danh sách hình ảnh</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($slides) && is_object($slides))
        @foreach ($slides as $key => $slide)
        <tr>
            <td>
                <input type="checkbox" value="{{ $slide->id }}" class="input-checkbox checkBoxItem">
            </td>
            <td>
                {{ $slide->name }}
            </td>
            <td>
                {{ $slide->keyword }}
            </td>
            <td style="display: flex; gap: 5px;">
                @foreach ($slide->item[$language] as $key => $item)
                <span class="image img-cover"><img src="{{ $item['image'] }}" alt="{{ $item['alt'] }}"></span>
                @endforeach
            </td>
            <td class="text-center js-switch-{{ $slide->id }}">
                <input type="checkbox" value="{{ $slide->publish }}" class="js-switch status"
                    data-field="publish" data-model="slide" data-modelId="{{ $slide->id }}"
                    {{ $slide->publish == 2 ? 'checked' : '' }} />
            </td>
            <td class="text-center" style="display: flex; justify-content: center; gap: 5px;">
                <a href="{{ route('slide.edit', $slide->id) }}" class="btn btn-success"><i
                        class="fa fa-edit"></i></a>
                <form action="{{ route('slide.delete', $slide->id) }}" method="get">
                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

{{ $slides->links('pagination::bootstrap-4') }}