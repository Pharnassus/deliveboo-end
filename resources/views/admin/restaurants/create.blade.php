@extends('admin.layouts.main')

@section('main')
    
  
    <div class="container create_ms z_index5_ms">
      <h1 class="mb-5">Crea il tuo ristorante</h1>
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
    
      <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="name" class="form-label">Nome</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Inserisci nome" value="{{old('name')}}">
        </div>

        <div class="form-group">
          <label class="d-block" for="img">Aggungi immagine</label>
          <input type="file" id="img" name="img" accept="image/*">
        </div>

        <div class="form-group">
          <label for="p_iva" class="form-label">Partita Iva</label>
          <input type="text" maxlength="11" class="form-control @error('p_iva') is-invalid @enderror" name="p_iva" id="p_iva" placeholder="Inserisci partita iva" value="{{old('p_iva')}}">
        </div>

        <div class="form-group">
          <label for="address" class="form-label">Indirizzo</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="Inserisci indirizzo" src="" value="{{old('address')}}">
        </div>       

        {{-- Categorie --}}
        @if (count($categories) > 0)
          <h5 class="mt-4 mb-2">Categorie</h5>
          @foreach ($categories as $category)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" name="categories[]">
              <label class="form-check-label" for="category-{{ $category->id }}">
                {{ $category->name}}
              </label>
            </div>
          @endforeach
        @endif
          
        <button type="submit" class="btn btn-success btn_success_update_restaurant mt-4">Salva</button>
        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-secondary mt-4">Home</a>
      </form>
    </div>
  
    
@endsection