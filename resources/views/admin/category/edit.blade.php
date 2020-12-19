@extends('layouts.app')

@section('title', 'Update Category')

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
							<a class="btn btn-sm float-left card-plain disabled text-white">Update Category</a>
							<a href="{{ route('category.index') }}" class="btn btn-sm btn-info float-right">Go back</a>
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
					<div class="card-body mt-3">
						<form action="{{ route('category.update', $category->id) }}" method="POST">
							@csrf
							@method('PUT')
							<div class="col-md-12">
								<div class="form-group">
									<label class="bmd-label-floating">Category Name</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}">
									@error('name')
									    <div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
								<button type="submit" class="btn btn-sm btn-primary">Update</button>
								<a href="{{ route('category.index') }}" class="btn btn-sm btn-warning">
									Cancel
								</a>
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