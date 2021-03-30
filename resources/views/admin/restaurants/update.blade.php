@extends('admin.layouts.main')

@section('main')
    
  
    <div class="container z_index5_ms">
      <h1 class="mb-5">Modifica il tuo ristorante</h1>
        {{-- Div in caso di errori di compilazioni del form --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- /Div in caso di errori di compilazioni del form --}}
      <form action="{{ route('admin.restaurants.update', $restaurant->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name" class="form-label">Nome</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$restaurant->name}}">
        </div>

        <div class="form-group">
          <img class="d-block" src="{{ asset('storage/' . $restaurant->img) }}" alt="Miniatura">
          <label class="d-block" for="img">Modifica immagine</label>
          <input type="file" id="img" name="img" accept="image/*">
        </div>

        <div class="form-group">
          <label for="p_iva" class="form-label">Partita Iva</label>
          <input type="text" maxlength="11" class="form-control @error('p_iva') is-invalid @enderror" name="p_iva" id="p_iva" value="{{$restaurant->p_iva}}">
        </div>

        <div class="form-group">
          <label for="address" class="form-label">Indirizzo</label>
          <input type="text" class="form-control" name="address" id="address" value="{{$restaurant->address}}">
        </div>

        

        {{-- Images --}}
       {{--  <h5 class="mt-4 mb-2">Immagini</h5>
        @foreach ($images as $image)
          <div class="form-check d-flex align-items-stretch">
            <input class="form-check-input" type="checkbox" value="{{ $image->id }}" id="image-{{ $image->id }}" name="images[]">
            <label class="form-check-label" for="image-{{ $image->id }}">
              {{ $image->alt}}
            </label>
            <img src="{{ $image->link }}" alt="{{ $image->alt }}" style="width: 50px" class="m-2">
          </div>
        @endforeach --}}
        {{-- /Images --}}

        {{-- Categorie --}}
        @if (count($categories) > 0)
          <h5 class="mt-4 mb-2">Categorie</h5>
          @foreach ($categories as $category)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" name="categories[]" @if ($restaurant->categories->contains($category->id)) checked @endif>
              <label class="form-check-label" for="category-{{ $category->id }}">
                {{ $category->name}}
              </label>
            </div>
          @endforeach
        @endif
          
        <button type="submit" class="btn btn-success btn_success_update_restaurant mt-4">Salva</button>
        <a href="{{ route('admin.restaurants.show', $restaurant->slug) }}" class="btn btn-secondary mt-4">Annulla</a>
      </form>
    </div>
  
    
@endsection