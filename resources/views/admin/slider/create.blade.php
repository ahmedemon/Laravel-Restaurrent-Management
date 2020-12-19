@extends('layouts.app')

@section('title', 'Create Slider')

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
							<a class="btn btn-sm float-left card-plain disabled text-white">Create new slider</a>
							<a href="{{ route('slider.index') }}" class="btn btn-sm btn-info float-right">Go back</a>
						</h4>
					</div>
					<div class="card-body">
						<form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="col-md-12">
								<div class="form-group">
									<label class="bmd-label-floating">Title</label>
									<input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
									@error('title')
									    <div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label class="bmd-label-floating">Sub Title</label>
									<input type="text" class="form-control" name="sub_title">
								</div>
									<input type="file" class="form-control" name="image">
									<button type="submit" class="btn btn-sm btn-primary">Insert</button>
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