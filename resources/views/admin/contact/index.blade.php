@extends('layouts.app')

@section('title', 'All Reservation')

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
						<h4 class="card-title mt-2 float-left pl-3 text-uppercase">Total message - {{count($contacts)}}</h4>
{{-- 						<a href="#" class="btn btn-sm btn-danger float-right">Pending Reservation</a>
						<a href="#" class="btn btn-sm btn-success float-right">Confirmed Reservation</a> --}}
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
					<div class="card-body px-0">
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
				            	<div class="col-md-6">
				            	</div>
				            	<div class="col-md-3">
						            <form class="navbar-form mt-2 pt-1">
							            <div class="input-group no-border">
							            	<input type="text" id="searchInput" value="" class="form-control" placeholder="Search...">
							            </div>
						            </form>
				            	</div>
				            </div>

							<div class="row m-0" id="tabelData">
								@foreach ($contacts as $key=>$contact)
									<div class="col-md-3 line-content">
										<div class="card" style="height: 250px; width: 260px;">
											<div class="card-header card-header-primary">
												<p class="lead my-0">{{ $key + 1 }}. {{ $contact->name }}</p>
											</div>
											<div class="card-body">
												<div class="card-title">
													<p class="small my-0 px-1 font-weight-bold">Name <b>:</b> {{ $contact->name }}</p>
													<hr class="my-1">
													<p class="small my-0 px-1 font-weight-bold">Email <b>:</b> {{ $contact->email }}</p>
													<hr class="my-1">
													<p class="small my-0 px-1 font-weight-bold">Subject <b>:</b> {{ $contact->subject }}</p>
													<hr class="my-1">
													<p class="small my-0 px-1 font-weight-bold">Message <b>:</b> {{ $contact->message }}</p>
													<hr class="mb-2">
												</div>
												<div class="card-footer">
                          <a href="{{ route('contact.show', $contact->id) }}" class="text-primary" style="font-size: 15px; text-decoration: none;">
                            <i class="material-icons">drafts</i>
                          </a>
                          <!---------------------------------------------------------------->
                          {{-- delete reservation --}}
                          <a href="#" class="text-danger" style="font-size: 15px; text-decoration: none;"
                          	onclick="if (confirm('Are you sure? You want to delete {{$contact->name}}')){
                          		event.preventDefault();
                          		document.getElementById('delete-form-{{ $contact->id }}').submit();
                          	}"
                          	style="font-size: 15px; text-decoration: none;">
                            <i class="material-icons">delete</i>
                          </a>
                          <form action="{{ route('contact.destroy', $contact->id) }}" id="delete-form-{{ $contact->id }}" method="POST" style="display: none;">
                          	@csrf
                          	@method('DELETE')
                          </form>
                          {{-- delete reservation --}}
                          <!---------------------------------------------------------------->
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>

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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="{{ asset('backend/js/bootstrap-select.min.js') }}"></script> <!-- for data table selector -->
	<script src="{{ asset('backend/js/selectScript.js') }}"></script>

	<script>
		$(document).ready(function(){
		  $("#searchInput").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#tabelData .col-md-3").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });
		});
	</script>
@endpush