@extends('main')

@section('content')
<div class="bg0 m-t-23 p-b-140 p-t-40">
		<div class="container">

			@include("products.list")

			{!! $products->links() !!}
		</div>
	</div>
@endsection

