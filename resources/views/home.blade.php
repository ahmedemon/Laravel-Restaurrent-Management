@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <strong>{{ Auth::user()->name }}</strong> You are already logger in! &nbsp;
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-info">Go back to dashboard!!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
