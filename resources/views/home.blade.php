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

                    {{ __('You are logged in!') }}
                </div>

            </div>
            <div class="container">
                <a href="{{ route('admin.restaurants.create') }}" class="btn btn-secondary mt-4">Crea ristorante</a>
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-info mt-4">Lista ristoranti</a>
            </div>
        </div>
    </div>
</div>
@endsection
