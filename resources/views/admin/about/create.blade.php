@extends('layouts.app')

@section('title', 'Create About')

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
							<a class="btn btn-sm float-left card-plain disabled text-white">Create new about</a>
							<a href="{{ route('about.index') }}" class="btn btn-sm btn-info float-right">Go back</a>
						</h4>
					</div>
                    @if (session('danger'))
                        <div class="alert alert-danger mt-3 mb-0">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('danger') }}</span>
                        </div>
                    @endif
					<div class="card-body">
						<form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="col-md-12">
								<div class="form-group">
									<label class="bmd-label-floating">Name</label>
									<input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
									@error('name')
									    <p class="small text-danger">{{ $message }}</p>
									@enderror
								</div>
								<div class="form-group">
									<label class="bmd-label-floating">About</label>
									<textarea name="about" class="form-control @error('about') is-invalid @enderror" rows="5"></textarea>
									@error('about')
									    <p class="small text-danger">{{ $message }}</p>
									@enderror
								</div>
									<input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
									@error('image')
									    <p class="small text-danger">{{ $message }}</p>
									@enderror
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