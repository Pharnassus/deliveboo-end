@extends('admin.layouts.main')

@section('aside')
    
@endsection

@section('main')
    <div class="container flex_ms">
        <div id="app"></div>
        <div class="card_h_ms mb-3">
            <div class="card card_restaurant_show_ms">

                <div class="card_restaurant_img_ms">
                    @if(!empty($restaurant->img))
                        <img class="card-img-top" src="{{asset('storage/' . $restaurant->img)}}" alt="RISTORANTE">
                    @else
                        <img class="card-img-top" src="{{ asset('images/placeholder.png') }}" alt="PLACEHOLDER">
                    @endif
                </div>

                <div class="card-body">

                    <div class="card_restaurant_info_ms">
                        <div class="statistic_card_restaurant_ms">
                            <h2 class="card-title">{{$restaurant->name}}</h2>
                            <a class="btn btn-primary float-right" id="responsive_show" href="{{ route('admin.restaurants.charts', $restaurant->slug) }}">Statistiche</a>
                        </div>
                        <p class="card-text">Partita IVA: {{$restaurant->p_iva}}</p>
                        <p class="card-text">Indirizzo: {{$restaurant->address}}</p>
                    </div>

                    <div class="card_restaurant_bnt_ms">
                        <a class="btn btn-success" href="{{route('admin.restaurants.dishes.index', $restaurant->slug)}} "><i class="far fa-calendar-minus"></i>Vedi Menù</a>
                        <a class="btn btn-secondary" href="{{ route('admin.restaurants.edit', $restaurant->slug) }}"><i class="fas fa-pencil-alt"></i>Modifica</a>

                        <div id="create_response_ms" class="create_modify_restaurant_ms">
                            <a class="btn btn-secondary btn_secondary_49_ms" href="{{ route('admin.restaurants.edit', $restaurant->slug) }}"><i class="fas fa-pencil-alt"></i>Modifica</a>
                            <a class="btn btn-secondary btn_secondary_49_ms" href="{{route('admin.restaurants.dishes.create', $restaurant->slug)}}"><i class="fas fa-plus"></i>Crea Piatto</a>
                        </div>

                        <form action="{{route('admin.restaurants.destroy', $restaurant->slug)}}" method="POST" onSubmit="return confirm('Sei sicuro di voler eliminare questo ristorante?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Elimina</button>
                        </form>
                    </div>
                    
                </div>

            </div>
        </div>  

        <div id="responsive_hidden" class="statistics_restaurant_ms" style="background-color: white">
            <h3 class="text-center pt-4 mb-5">Statistiche Ordini</h3>
            <canvas id="myCanvas" class="statistics_restaurant_ms" style="margin: 0">

            </canvas>
            <hr class="mx-5">
            <div class="text-center pt-5">
                <a class="btn btn-success mx-5" href="{{ route('admin.restaurants.charts', $restaurant->slug) }}">Dettagli Statistiche</a>
            </div>
        </div>     
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      var ctx = document.getElementById('myCanvas').getContext('2d');
      let myLabels = ['Gennaio:', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
      let slug = @json($restaurant->slug);
      let myData = [];
      $.ajax({
        url: "http://127.0.0.1:8000/api/" + slug + "/statistics",
        type: "GET",
        dataType: 'json',
        success: function(data){
            newdata = data.map(
            element => {
              return element.toFixed(2);
          });
          chart.data.datasets[0].data = newdata;
          chart.update();
        }
});
    Chart.defaults.global.defaultFontFamily = 'Lato';
      var chart = new Chart(myCanvas, {
          // The type of chart we want to create
          type: 'doughnut',

          // The data for our dataset
          data: {
            datasets: [{
              label: '€',
              backgroundColor: ['#85d4d1','#85d4c2','#85d49e','#95d485','#b4d485','#e8e592','#e8c092','#e8a692','#e89292','#e892a2','#d092e8','#92b3e8',],
              data: myData
            }],
            labels: myLabels,
          },

          // Configuration options go here
          options: {
            // title: {
            //   display: true,
            //   text: 'Statistiche',
            //   fontSize: 25,
            // },
            legend: {
                display: false,
                position: 'bottom',
            }
            
          }
        });
    </script>
    
@endsection