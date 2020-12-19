@extends('layouts.app')

@section('title', 'Slider')

@push('css')

	<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-select.min.css') }}"> <!-- for data table selector -->
	<link rel="stylesheet" href="{{ asset('backend/css/main.css') }}"> <!-- for data table selector -->

@endpush

@section('content')

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-plain">
					<div class="card-header card-header-primary">
						<h4 class="card-title mt-2 float-left pl-3 text-uppercase">Slider Details</h4>
						<a href="{{ route('slider.index') }}" class="btn btn-sm btn-info float-right">Back</a>
					</div>
					<div class="card-body">
						<div class="card col-md-4 offset-4 bg-light text-dark">
							<div class="card-header border-bottom">
								<h2 class="m-0 text-center">{{ $slider->title }}</h2>
							</div>
							<div class="card-body align-content-center text-center">
								<p class="lead">{{ $slider->sub_title }}</p>
								<img src="{{ asset('uploads/sliders/'.$slider->image) }}" alt="default.png" class="border border-secondary" height="200" width="300">
								<br>
								<br>
	                            <a href="/admin/slider/{{$slider->id}}/edit" class="text-primary" style="font-size: 15px; text-decoration: none;">
	                              <i class="material-icons">edit</i>
	                            </a>
	                            <a href="{{ $slider->id }}" class="text-danger" style="font-size: 15px; text-decoration: none;">
	                              <i class="material-icons">delete</i>
	                            </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('js')

	<script src="{{ asset('backend/js/bootstrap-select.min.js') }}"></script> <!-- for data table selector -->

	<script>
		$(document).ready(function(){
		  $("#searchInput").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#tabelData tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });
		});
	</script>

	<script src="{{ asset('backend/js/selectScript.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@endpush