@extends('admin.layouts.main')

@section('main')
    
  
    <div class="container z_index5_ms">
      <h1 class="mb-5">Aggiungi il tuo piatto</h1>
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
    
      <form action="{{ route('admin.restaurants.dishes.store', $restaurant->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="name" class="form-label">Nome</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Inserisci nome" value="{{ old('name') }}">
        </div>

        <div class="form-group">
          <label class="d-block" for="img">Aggungi immagine</label>
          <input type="file" id="img" name="img" accept="image/*">
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredienti</label>
            <textarea name="ingredients" id="ingredients" class="form-control" rows="10">{{old('ingredients')}}</textarea>
        </div>

        <div class="form-group">
          <label for="courses" class="form-label">Tipo di portata</label>
          <select class="form-control" name="courses" id="courses">
            @foreach ($courses as $course)
            <option value="{{ $course }}">{{ $course }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" id="description" class="form-control" rows="10">{{old('description')}}</textarea>
        </div>

        <div class="form-group">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" maxlength="6" min="0" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Inserisci il prezzo" value="{{ old('price') }}">
        </div>
        <div>Visibilità</div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="visibility" {{old('visibility') == 1 ? 'checked' : ''}} value='1'>
            <label class="form-check-label">
                Si
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="visibility" {{old('visibility') == 0 ? 'checked' : ''}} value='0'>
            <label class="form-check-label">
                No
            </label>
        </div>
        <button type="submit" class="btn btn-success btn_success_update_restaurant mt-4">Salva</button>
        <a href="{{ route('admin.restaurants.dishes.index', $restaurant->slug) }}" class="btn btn-secondary mt-4">Annulla</a>
      </form>
    </div>
  
    
@endsection