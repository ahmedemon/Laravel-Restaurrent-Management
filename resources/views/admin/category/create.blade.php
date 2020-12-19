@extends('layouts.app')

@section('title', 'Create Category')

@push('css')

@endpush

@section('content')

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-plain">
					<div class="card-header card-header-primary">
						<h4 class="card-title mt-2 float-left pl-3 text-uppercase">Create a new category</h4>
						<a href="{{ route('category.index') }}" class="btn btn-sm btn-info float-right">Go back</a>
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
						<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="col-md-12">
								<div class="form-group">
									<label class="bmd-label-floating">Category Name</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
									@error('name')
									    <div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
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