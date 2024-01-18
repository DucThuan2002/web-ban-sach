@extends('admin.main')

@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.23.0/ckeditor.js" ></script>
@endsection
@section('content')
    <form method="post" enctype="multipart/form-data">
        @csrf
        @include("admin.alert")
        <div class="card-body">
            <div class="form-group">
                <label for="product">Tên Slider</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-group">
                <label for="product">Đường Dẫn</label>
                <input type="textarea" name="url" class="form-control" id="url">
            </div>          
            <div class="form-group">
                <label for="product">Ảnh Sản Phẩm</label>
                <input type="file" name="file" class="form-control" id="upload">
                <div class="image_show" id="image_show" name="image_show"></div>
                <input type="hidden" name="thumb" class="thumb" id="thumb">
            </div>
            <div class="form-group">
                <label for="product">Sắp Xếp</label>
                <input type="number" name="sort_by" class="form-control" id="sort_by">
            </div>  
            <div class="form-group">
                <label for="product">Kích Hoạt</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="active" id="active" value="1" checked>
                    <label class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="active" id="noactive" value="0">
                    <label class="form-check-label">Không</label>
                </div>
                </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Slider</button>
        </div>
    </form>
@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.23.0/ckeditor.js" ></script>
        <script>
            CKEDITOR.replace( 'decription' );
        </script>
@endsection
