@extends('admin.main')

@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.23.0/ckeditor.js" ></script>
@endsection
@section('content')
    <form method="post">
        @csrf
        @include("admin.alert")
        <div class="card-body">
            <div class="form-group">
                <label for="product">Tên Sản Phẩm</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label for="product">Danh Mục</label>
                <select name="menu_id" class="form-control" id="menu_id">
                    @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ $menu->id == $product->menu_id ? 'selected' : '' }}>{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="product">Mô Tả</label>
                <input type="textarea" name="decription" class="form-control" id="decription" value="{{$product->decription}}">
            </div>
            <div class="form-group">
                <label for="product">Nội Dung</label>
                <input type="textarea" name="content" class="form-control" id="content" value="{{$product->content}}">
            </div>
            <div class="form-group">
                <label for="product">Giá Gốc</label>
                <input type="text" name="price" class="form-control" id="price" value="{{$product->price}}">
            </div>
            <div class="form-group">
                <label for="product">Giá Bán</label>
                <input type="text" name="price_sale" class="form-control" id="price_sale" value="{{$product->price_sale}}">
            </div>
            <div class="form-group">
                <label for="product">Ảnh Sản Phẩm</label>
                <input type="file" name="file" class="form-control" id="upload">
                <div class="image_show" id="image_show" name="image_show" >
                    <a href="" target="_blank">
                        <img src="http://localhost/shop/{{$product->thumb}}" width="100px">
                    </a>
                    
                </div>
                <input type="hidden" name="thumb" class="thumb" id="thumb" value="{{$product->thumb}}">
            </div>
            <div class="form-group">
                @if($product->active == 1)
                <label for="product">Kích Hoạt</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="active" id="active" value="1" checked>
                    <label class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="active" id="noactive" value="0">
                    <label class="form-check-label">Không</label>
                </div>
                @else
                <label for="product">Kích Hoạt</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="active" id="active" value="1">
                    <label class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="active" id="noactive" value="0" checked>
                    <label class="form-check-label">Không</label>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
        </div>
    </form>
@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.23.0/ckeditor.js" ></script>
        <script>
            CKEDITOR.replace( 'decription' );
        </script>
@endsection
