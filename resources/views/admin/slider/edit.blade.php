@extends('layouts.app')

@section('title', 'Update Slider')

@push('css')

@endpush

@section('content')

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-plain">
					<div class="card-header card-header-primary">
						<h4 class="card-title mt-0">
							<a class="btn btn-sm float-left card-plain disabled text-white">Update Slider</a>
							<a href="{{ route('slider.index') }}" class="btn btn-sm btn-info float-right">Go back</a>
						</h4>
					</div>
					<div class="card-body">
						<form action="{{ route('slider.update', $data->id) }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="col-md-12">
								<div class="form-group">
									<label class="bmd-label-floating">Title</label>
									<input type="text" class="form-control" name="title" value="{{ $data->title }}">
								</div>
								<div class="form-group">
									<label class="bmd-label-floating">Sub Title</label>
									<input type="text" class="form-control" name="sub_title" value="{{ $data->sub_title }}">
								</div>
								<img src="{{ asset('uploads/sliders/'.$data->image) }}" alt="default.png" class="border border-secondary" height="200" width="300">
								<input type="file" class="form-control" name="image">
								{{ method_field('PUT') }}
								<button type="submit" class="btn btn-sm btn-primary">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('js')

@endpush