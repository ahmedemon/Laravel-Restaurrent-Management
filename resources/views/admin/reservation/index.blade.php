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
						<h4 class="card-title mt-2 float-left pl-3 text-uppercase">Total Request - {{count($reservations)}}</h4>
						<a href="#" class="btn btn-sm btn-danger float-right">
							Pending Reservation
						</a>
						<a href="#" class="btn btn-sm btn-success float-right">
							Confirmed Reservation
							@while ($reservations == true)
								<span class="badge badge-danger">{{ count($reservations) }}</span>
							@endwhile
							@foreach ($reservations as $reservation)
								@if ($reservation->status == true)
									<span class="badge badge-danger">{{ count($reservations) == true }}</span>
								@endif
							@endforeach
						</a>
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
								@foreach ($reservations as $key=>$reservation)
									<div class="col-md-3 line-content">
										<div class="card" style="height: 250px; width: 260px;">
											<div class="card-header card-header-primary">
												<p class="lead my-0">{{ $key + 1 }}. {{ $reservation->name }}</p>
											</div>
											<div class="card-body">
												<div class="card-title">
													<p class="small my-0 px-1 font-weight-bold">Email <b>:</b> {{ $reservation->email }}</p>
													<hr class="my-1">
													<p class="small my-0 px-1 font-weight-bold">Phone <b>:</b> {{ $reservation->phone }}</p>
													<hr class="my-1">
													<p class="small my-0 px-1 font-weight-bold">Time <b>:</b> {{ $reservation->date_and_time }}</p>
													<hr class="my-1">
													<p class="small my-0 px-1 font-weight-bold">Message <b>:</b> {{ $reservation->message }}</p>
													<hr class="my-1">
													@if ($reservation->status == true)
														<p class="my-0 badge badge-success">Confirmed</p>
													@else
														<p class="my-0 badge badge-danger">Not Confirmed</p>
													@endif
												</div>
												<div class="card-footer">
                          <a href="{{ route('reservation.show', $reservation->id) }}" class="text-primary" style="font-size: 15px; text-decoration: none;">
                            <i class="material-icons">drafts</i>
                          </a>
                          <!---------------------------------------------------------------->
                          {{-- delete reservation --}}
                          <a href="#" class="text-danger" style="font-size: 15px; text-decoration: none;"
                          	onclick="if (confirm('Are you sure? You want to delete {{$reservation->name}}')){
                          		event.preventDefault();
                          		document.getElementById('delete-form-{{ $reservation->id }}').submit();
                          	}"
                          	style="font-size: 15px; text-decoration: none;">
                            <i class="material-icons">delete</i>
                          </a>
                          <form action="{{ route('reservation.destroy', $reservation->id) }}" id="delete-form-{{ $reservation->id }}" method="POST" style="display: none;">
                          	@csrf
                          	@method('DELETE')
                          </form>
                          {{-- delete reservation --}}
                          <!---------------------------------------------------------------->
                          {{-- confirm reservation --}}
                          @if ($reservation->status == false)
	                          <form action="{{ route('reservation.status', $reservation->id) }}" id="confirm-form-{{ $reservation->id }}" method="POST" style="display: none;">
	                          	@csrf
	                          </form>
	                          <a href="#" class="text-info" style="font-size: 15px; text-decoration: none;"
	                          	onclick="if (confirm('Are you sure? You want to Confirm {{$reservation->name}}`s reservation?')){
	                          		event.preventDefault();
	                          		document.getElementById('confirm-form-{{ $reservation->id }}').submit();
	                          	}"
	                          	style="font-size: 15px; text-decoration: none;">
	                            <i class="material-icons">done</i>
	                          </a>
	                        @else
	                          <form action="{{ route('reservation.cancel', $reservation->id) }}" id="cancel-confirm-form-{{ $reservation->id }}" method="POST" style="display: none;">
	                          	@csrf
	                          </form>
	                          <a href="#" class="text-secondary" style="font-size: 15px; text-decoration: none;"
	                          	onclick="if (confirm('Are you sure? You want to cancel {{$reservation->name}}`s reservation?')){
	                          		event.preventDefault();
	                          		document.getElementById('cancel-confirm-form-{{ $reservation->id }}').submit();
	                          	}"
	                          	style="font-size: 15px; text-decoration: none;">
	                            <i class="material-icons">cancel</i>
	                          </a>
                          @endif
                          {{-- confirm reservation --}}
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
{{-- 							<table id="tableID" class="mt-4 table table-hover table-bordered table-striped">
								<thead class="text-center border-top text-white bg-secondary">
									<th class="py-2 font-weight-bold">SL</th>
									<th class="py-2 font-weight-bold">Name</th>
									<th class="py-2 font-weight-bold">Email</th>
									<th class="py-2 font-weight-bold">Phone</th>
									<th class="py-2 font-weight-bold">Expected Momment</th>
									<th class="py-2 font-weight-bold">Message</th>
									<th class="py-2 font-weight-bold">Created At</th>
									<th class="py-2 font-weight-bold">Updated At</th>
									<th class="py-2 font-weight-bold">Action</th>
								</thead>
								<tbody id="tabelData">
									@foreach ($reservations as $key=>$reservation)
										<tr class="text-center line-content">
											<td class="py-1">{{ $key + 1 }}</td>
											<td class="py-1">{{ $reservation->name }}</td>
											<td class="py-1">{{ $reservation->email }}</td>
											<td class="py-1">{{ $reservation->phone }}</td>
											<td class="py-1">{{ $reservation->date_and_time }}</td>
											<td class="py-1">{{ $reservation->message }}</td>
											<td class="py-1">{{ $reservation->created_at->diffForHumans() }}</td>
											<td class="py-1">{{ $reservation->updated_at->diffForHumans() }}</td>
											<td class="py-1">
					                            <a href="{{ route('reservation.edit', $reservation->id) }}" class="text-primary" style="font-size: 15px; text-decoration: none;">
					                              <i class="material-icons">drafts</i>
					                            </a>
					                            <a href="{{ route('message.delete', $reservation->id) }}" class="text-danger" style="font-size: 15px; text-decoration: none;"
					                            	onclick="if (confirm('Are you sure? You want to delete {{$reservation->name}}')){
					                            		event.preventDefault();
					                            		document.getElementById('delete-form').submit();
					                            	}"
					                            	style="font-size: 15px; text-decoration: none;">
					                              <i class="material-icons">delete</i>
					                            </a>
					                            <form action="{{ route('message.delete', $reservation->id) }}" id="delete-form" method="POST" style="visibility: hidden;">
					                            	@csrf
					                            	@method('DELETE')
					                            </form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table> --}}