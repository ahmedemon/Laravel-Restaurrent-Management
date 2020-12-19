@extends('layouts.app')

@section('title', 'All Item')

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
						<h4 class="card-title mt-2 float-left pl-3 text-uppercase">All Item</h4>
						<a href="{{ route('item.create') }}" class="btn btn-sm btn-info float-right">Create</a>
					</div>
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('danger') }}</span>
                        </div>
                    @endif
					<div class="card-body">
						<div class="table-responsive">

				            <div class="row m-0">
				            	<div class="col-md-3 p-0">
				            		<strong class="font-weight-bold">Showing</strong>
					            		<select name="" id="selectOption" class="selectpicker" data-style="btn-success text-white" data-width="fit">
					            			<option value="5000">All</option>
					            			<option value="10">10</option>
					            			<option value="25">25</option>
					            			<option value="50">50</option>
					            			<option value="100">100</option>
					            		</select>
				            		<strong class="font-weight-bold">Entries</strong>
				            	</div>
				            	<div class="col-md-6"></div>
				            	<div class="col-md-3">
						            <form class="navbar-form mt-2 pt-1">
							            <div class="input-group no-border">
							            	<input type="text" id="searchInput" value="" class="form-control" placeholder="Search...">
							            </div>
						            </form>
				            	</div>
				            </div>
	<table id="tableID" class="mt-4 table table-hover table-bordered table-striped">
		<thead class="text-center border-top text-white bg-secondary">
			<th class="py-2 font-weight-bold">SL</th>
			<th class="py-2 font-weight-bold">Category</th>
			<th class="py-2 font-weight-bold">Item Name</th>
			<th class="py-2 font-weight-bold">Description</th>
			<th class="py-2 font-weight-bold">Price</th>
			<th class="py-2 font-weight-bold">Image</th>
			<th class="py-2 font-weight-bold">Created At</th>
			<th class="py-2 font-weight-bold">Updated At</th>
			<th class="py-2 font-weight-bold">Action</th>
		</thead>
		<tbody id="tabelData">
			@foreach ($items as $key=>$item)
				<tr class="text-center line-content">
					<td class="py-1">{{ $key + 1 }}</td>
					<td class="py-1">{{ $item->category_id }}</td>
					<td class="py-1">{{ $item->name }}</td>
					<td class="py-1">{{ $item->description }}</td>
					<td class="py-1">{{ $item->price }}</td>
					<td class="py-1" width="20">
						<a href="{{ asset('uploads/items/'.$item->image) }}" target="_blank" class="text-success font-weight-bold">
							<img src="{{ asset('uploads/items/'.$item->image) }}" class="border border-secondary" alt="default.png" height="60" width="120">
						</a>
					</td>
					<td class="py-1">{{ $item->created_at->diffForHumans() }}</td>
					<td class="py-1">{{ $item->updated_at->diffForHumans() }}</td>
					<td class="py-1">
                        <a href="{{ route('item.edit', $item->id) }}" class="text-primary" style="font-size: 15px; text-decoration: none;">
                          <i class="material-icons">edit</i>
                        </a>
                        <a href="{{ route('item.show', $item->id) }}" class="text-success" style="font-size: 15px; text-decoration: none;">
                          <i class="material-icons">assignment</i>
                        </a>
                        <a href="{{ route('item.destroy', $item->id) }}" class="text-danger" style="font-size: 15px; text-decoration: none;"
                        	onclick="if (confirm('Are you sure? You want to delete {{$item->title}}')){
                        		event.preventDefault();
                        		document.getElementById('delete-form').submit();
                        	}"
                        	style="font-size: 15px; text-decoration: none;">
                          <i class="material-icons">delete</i>
                        </a>
                        <form action="{{ route('item.destroy', $item->id) }}" id="delete-form" method="POST" style="visibility: hidden;">
                        	@csrf
                        	@method('DELETE')
                        </form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
							<nav aria-label="Page navigation example">
								<ul class="pagination float-right" id="pagin"></ul>
							</nav>
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