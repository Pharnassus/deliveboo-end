<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    {{-- Google font Spartan --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
    <title>Details</title>
</head>
<body>
  <div id="app">
    <header>
      <div class="nav_bar d-flex justify-content-between align-items-center">
        <div class="cont_img">
          <img class="ml-4" src="{{ asset('images/logo.png') }}" alt="logo">
          <ul :class="navHidden">
            <li>
              <a href="{{ route('homepage') }}">Home</a>
            </li>
            <li>
              <a href="#contact">Contatti</a>
            </li>
          </ul>
        </div>

        <div class="hamb_icon">
          <i class="fas fa-hamburger" v-on:click="showNavList()"></i>
        </div>


        <div class="d-flex justify-content-end cont_shop pr-4">
          <div class="chart d-flex justify-content-between align-items-center"  v-on:click="changeVisibility()">
            <i class="fas fa-shopping-cart" v-on:click="changeVisibility()"></i>
            <span class="chartCount" :class="(count === 0 ? 'hiddenChart' : '' )">x @{{count}}</span>
            <span class="pipe" :class="(count === 0 ? 'hiddenChart' : '' )">|</span>
            <span :class="(count === 0 ? 'hiddenChart' : '' )">@{{total.toFixed(2)}}€</span>
          </div>
        </div>
      </div>
    </header>
    <div class="jumbotron" style="background-image: url({{asset('storage/' . $restaurant->img)}})">
        <h1 id="title_res" class="float-right">{{$restaurant->name}}</h1>
    </div>

    {{-- Main --}}
    <main>
      @foreach ($restaurant->dishes as $dish)
        <div class="card" id="id_card">
          <img src="{{asset('storage/' . $dish->img)}}" class="card-img-top" alt="...">
          <div class="card-body d-flex flex-column justify-content-between">
              <div class="info" id="info_id">
                  <h3 class="card-title">{{"$dish->name"}}</h2>
                  <p><strong>Descrizione: </strong>{{$dish->description}}</p>
                  <p><strong>Ingredienti: </strong>{{$dish->ingredients}}</p>
              </div>
              <div id="price_id" class="d-flex justify-content-between align-items-center">
                  <span><strong>Prezzo: </strong>{{number_format($dish->price, 2)}}€</span>
                    @if ($dish->visibility == 1)
                    <button v-if="inOrder('{{$dish->name}}') == false" class="btn btn_orange" v-on:click="chart('{{$dish->name}}',{{number_format($dish->price, 2)}})">Aggiungi al carrello</button>
                    <div v-else>
                      <button class="btn btn_orange btn-sm mr-2" v-on:click="addDish('{{$dish->name}}')">
                        <i class="fas fa-plus"></i>
                      </button>
                      <button v-for="ordered_dish in order" v-if="ordered_dish.count > 0 && ordered_dish.name == '{{$dish->name}}'" class="btn btn_orange btn-sm" v-on:click="leaveDish('{{$dish->name}}')">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                    @else
                      <button id="not_cursor" class="btn btn-danger">Non Disponibile</button>
                    @endif                    
              </div>             
            </div>
        </div>
      @endforeach
      <div class="chart" :class="chartVisibility" v-if="total > 0">
        <div class="listDishes">
          <div class="chart_header d-flex justify-content-between align-items-center">
            <img src="{{asset('images/logo.png')}}" alt="LOGO">
            <div>
              <button class="btn btn_delete" v-on:click="deleteOrder()">Annulla</button>
              <a href="{{route('payment')}}" class="btn btn_confirm">Conferma</a>
            </div>
          </div>
          <hr>
          <div v-for="ordered_dish in order" class="order mb-3" v-if="ordered_dish.count > 0">
              <div class="mb-2">
                  <span class="shop_dish_name">@{{ordered_dish.name}}</span>
                  <span class="float-right " v-on:click="deleteDishOrder(ordered_dish.name)"><i class="delete fas fa-trash-alt"></i></span>
              </div>
              <div class="d-flex justify-content-between align-items-center info">
                <div class="quantity">
                  <button  class="btn btn_plusmin btn-sm mr-2" v-on:click="addDish(ordered_dish.name)"><i class="fas fa-plus"></i></button>
                  <button class="btn btn-sm btn_plusmin" v-if="ordered_dish.count > 1" v-on:click="leaveDish(ordered_dish.name)"><i class="fas fa-minus"></i></button>
                </div>
                <div>n. @{{ordered_dish.count}}</div>
                <div v-if="ordered_dish.count > 0" class="text-right font-weight-bold">@{{ordered_dish.price.toFixed(2)}}€</div>
              </div>
          </div>
          <hr v-if="total > 0">
          <div v-if="total > 0" class="total btn_confirm">
              <span>Totale: </span>
              <span >@{{total.toFixed(2)}}€</span>
          </div>
        </div>
      </div>
    </main>
    {{-- Main --}}
    
    {{-- Footer --}}
    <footer>
      
      <div class="container_footer" id="cont_footer_resp">
        <div class="footer_left">
          <img src="{{asset('images/del-rider.jpg')}}" alt="">
        </div>

        <div class="footer_center" id="foot_cent_resp">
          <h3>TEAM DI SVILUPPO</h3>
          <ul>
            <li>
              <a href="https://www.linkedin.com/in/nicola-porta-846ba6207/" class="btn btn-dark"><i class="fas fa-user-tie"></i>Nicola Porta</a>
            </li>
            <li>
              <a href="https://www.linkedin.com/in/vincenzo-antignani-195710114/" class="btn btn-dark"><i class="fas fa-user-astronaut"></i>Vincenzo Antignani</a>
            </li>
            <li>
              <a href="https://www.linkedin.com/in/marian-corlade-703958208/" class="btn btn-dark"><i class="fas fa-user-tag"></i>Marian Corlade</a>            
            </li>
            <li>
              <a href="https://www.linkedin.com/in/cristian-mihai-trusca/" class="btn btn-dark"><i class="fas fa-user-ninja"></i>Cristian Mihai Trusca</a>
            </li>
            <li>
              <a href="https://www.linkedin.com/in/matteopirovano/" class="btn btn-dark"><i class="fas fa-user-plus"></i>Matteo Pirovano</a>
            </li>
          </ul>
        </div>
        <a id="contact"></a>

        <div class="footer_right">
          <img src="{{ asset('images/del-app.jpg') }}" alt="app-phone">
          <div class="btn go_up">
            <a href=""><i class="fas fa-chevron-up"></i></a>        
          </div>
        </div>

      </div>
      
    </footer>
    {{-- Footer --}}
  </div>
  <script src="{{asset('js/details.js')}}"></script>
</body>
</html>