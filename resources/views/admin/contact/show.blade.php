@extends('layouts.app')

@section('title', 'Reservation')

@push('css')

	<link rel="stylesheet" href="{{ asset('backend/css/main.css') }}"> <!-- for data table selector -->

@endpush

@section('content')

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 offset-3 mt-5">
				<div class="card ">
					<div class="card-header card-header-primary">
						<h4 class="card-title mt-2 text-center pl-3 text-uppercase">
							Message From - <strong class="text-info">{{ $contact->name }}</strong>
						</h4>
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
					<div class="card-body px-5">
						<table class="table border-0">
						  <tbody class="lead">
						    <tr>
						      <td>Name</td>
						      <td class="font-weight-bold">:</td>
						      <td class="text-right">{{ $contact->Name }}</td>
						    </tr>
						    <tr>
						      <td>Email</td>
						      <td class="font-weight-bold">:</td>
						      <td class="text-right">{{ $contact->email }}</td>
						    </tr>
						    <tr>
						      <td>Subject</td>
						      <td class="font-weight-bold">:</td>
						      <td class="text-right">{{ $contact->subject }}</td>
						    </tr>
						    <tr>
						      <td class="align-top">Message</td>
						      <td class="font-weight-bold align-top">:</td>
						      <td class="text-justify">{{ $contact->message }}</td>
						    </tr>
						  </tbody>
						</table>
						<div class="card-footer mx-0">
							<a href="{{ route('contact.index') }}" class="btn btn-primary btn-sm">back</a>
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
@endpush