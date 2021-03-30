@extends('admin.layouts.main')

@section('aside')
    
@endsection

@section('main')
<div class="container" style="z-index: 2">
    @if (session('message'))
    <div class="alert alert-success mt-2 ml-2">
        {{ session('message') }}
    </div>
    @endif
    
    {{-- <a class="btn btn-secondary float-right" href="{{ route('admin.restaurants.index') }}">Indietro</a> --}}
    <div class="d-flex flex-wrap justify-content-around position_card_index_ms">
        @foreach ($restaurant->dishes->sortBy('name') as $dish)
        <div class="shadow_card_ms card m-2 d-flex justify-content-end">

            <div class="position_card_index_img_ms">
                @if(!empty($dish->img))
                    <img class="img_ms" src="{{asset('storage/' . $dish->img)}}" alt="PIATTO">
                @else
                    <img class="img_ms" src="{{ asset('images/placeholder.png') }}" alt="PLACEHOLDER">
                @endif
            </div>

            <div class="position_card_index_category_ms">
                <h4>{{$dish->courses}}</h4>
            </div>
            <div class="position_card_index_h2_ms">
                <h2>{{$dish->name}}</h2>

            </div>


            <div class="position_card_index_a_ms">
                <a class="btn btn-info" href="{{route('admin.restaurants.dishes.show', ['restaurant' => $restaurant->slug, 'dish' => $dish->slug])}}">Mostra</a>
            </div>
            
        </div>
        @endforeach
    </div>
</div>
@endsection

