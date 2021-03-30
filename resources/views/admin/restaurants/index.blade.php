@extends('admin.layouts.main')

@section('aside')

@endsection

@section('main')
    <div class="container">        
        @if (session('message'))
        <div class="alert alert-success mt-2 ml-2">
            {{ session('message') }}
        </div>
        @endif        
    </div>
@endsection
<div class="d-flex flex-wrap justify-content-around position_card_index_ms">
    @foreach ($restaurants->sortBy('name') as $restaurant)
    <div class="shadow_card_ms card m-2 d-flex justify-content-center">

        <div class="position_card_index_img_ms">
            @if(!empty($restaurant->img))
                <img class="img_ms" src="{{asset('storage/' . $restaurant->img)}}" alt="PIATTO">
            @else
                <img class="img_ms" src="{{ asset('images/placeholder.png') }}" alt="PLACEHOLDER">
            @endif
        </div>

        <div class="position_card_index_h2_ms">
            <h2>{{$restaurant->name}}</h2>
        </div>


        <div class="position_card_index_a_ms">
            <a class="btn btn-info" href="{{route('admin.restaurants.show', ['restaurant' => $restaurant->slug])}}">Mostra</a>
        </div>
        
    </div>
    @endforeach
</div>