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
                <label for="menu">Tên Danh Mục</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$menu->name}}">
            </div>
            <div class="form-group">
                <label for="menu">Danh Mục</label>
                <select name="parent_id" class="form-control" id="parent_id">
                    <option value="0">Danh Mục Cha</option>
                    @foreach($menus as $menu2)
                        @if($menu2->id == $menu->id)
                            <option value="{{$menu2->id}}" selected>{{$menu2->name}}</option>
                        @else
                            <option value="{{$menu2->id}}">{{$menu2->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="menu">Mô Tả</label>
                <input type="textarea" name="decription" class="form-control" id="decription" value="{{$menu->decription}}">
            </div>
            <div class="form-group">
                <label for="menu">Nội Dung</label>
                <input type="textarea" name="content" class="form-control" id="content" value="{{$menu->content}}">
            </div>
            <div class="form-group">
                @if($menu->active == 1)
                <label for="menu">Kích Hoạt</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="active" id="active" value="1" checked>
                    <label class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="active" id="noactive" value="0">
                    <label class="form-check-label">Không</label>
                </div>
                @else
                <label for="menu">Kích Hoạt</label>
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
