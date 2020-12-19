@extends('layouts.app')

@section('title', 'Create Item')

@push('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
@endpush

@section('content')

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-plain">
					<div class="card-header card-header-primary">
						<h4 class="card-title mt-0">
							<a class="btn btn-sm float-left card-plain disabled text-white">Create new item</a>
							<a href="{{ route('item.index') }}" class="btn btn-sm btn-info float-right">Go back</a>
						</h4>
					</div>
                    @if (session('danger'))
                        <div class="alert alert-danger mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('danger') }}</span>
                        </div>
                    @endif
					<div class="card-body">
						<form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="col-md-10 offset-1">
								<div class="form-group">
									<big class="font-weight-bold">Choose Category</big>
									<select class="selectpicker @error('category') is-invalid @enderror" data-width="150px" name="category">
										<option selected>Choose</option>
										@foreach ($categories as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
									@error('category')
									    <div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label class="bmd-label-floating">Item Name</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
									@error('name')
									    <div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label class="bmd-label-floating">Description</label>
									<textarea name="description" class="form-control @error('name') is-invalid @enderror" rows="5"></textarea>
									@error('description')
									    <div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label class="bmd-label-floating">Price</label>
									<input type="text" class="form-control @error('price') is-invalid @enderror" name="price">
									@error('price')
									    <div class="alert alert-danger">{{ $message }}</div>
									@enderror
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