@extends('admin.main')

@section('content')
<table style="margin-top: 10px">
    @include('admin.alert')
    <thead>
        <th style="width: 50px">ID</th>
        <th>Tên Slider</th>
        <th>Link</th>
        <th>Ảnh</th>
        <th>Active</th>
        <th>Update</th>
        <th style="width: 100px">&nbsp</th>
    </thead>
    <tbody>
    @foreach($sliders as $slider)
        <tr style="margin-top: 10px;">
            <td>{{ $slider->id }}</td>
            <td>{{ $slider->name }}</td>
            <td>{{ $slider->url }}</td>
            <td><img src="/shop/{{ $slider->thumb }}" alt="" width="100px"></td>
            <td>{!! App\Helpers\Helper::active($slider->active) !!}</td>
            <td>{{ $slider->updated_at }}</td>
            <td>
                <a href="/shop/admin/sliders/edit/{{ $slider->id }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{ $slider->id }}, '/shop/admin/sliders/destroy')">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>

{!! $sliders->links() !!}
@endsection