<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/payment.css') }}" rel="stylesheet">
    <script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.73.1/js/hosted-fields.min.js"></script>
    <title>payment</title>
</head>
<body>
  {{-- Header --}}
  <header>
    <div class="nav_bar pl-4" id="nav_bar_res"> 
      <div class="cont_img" id="cont_img_res">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <ul>
          <li>
            <a href="{{ route('homepage') }}">Home</a>
          </li>
        </ul>
      </div>
    </div>
    
    {{-- jumbotron e Form --}}
    <div class="jumbotron" id="jumbotron_res">     
      <div class="order-pay-container container">
        <div class="cont-marg-left">
            <div id="order-summary">
              <div class="content pay-box">
                <form class="container" method="post" id="payment-form" action="{{url('/checkout')}}">
                  @csrf
                  @method('post')
                  @if(count($errors) > 0)
                    <div class="alert alert-danger p-4">
                      @foreach ($errors->all() as $error)
                          <div>{{$error}}</div>
                      @endforeach
                    </div>
                  @endif
                  <section class="mx-0">
                    <div id="app">
                      <div class="order-summary-box">
                        <div class="separate-summary mb-2">
                          <h2>Riepilogo dell'ordine</h2>
                        </div>
                        <div class="logo_ms">
                          <img src="{{ asset("images/logo.png") }}" alt="logo">
                        </div>
                        <div class="item_order" v-for="(dish,index) in order" v-if="dish.count > 0">
                          <span class="mx-3">@{{ dish.count }}</span>
                          <div>@{{dish.name}}</div>
                          <input class="input_ms" type="hidden" :name="'dish_name['+index+']'" :value="dish.name" readonly>
                          <input type="hidden" :name="'dish_count['+index+']'" :value="dish.count" readonly>
                          <input id="price" class="input_ms price" type="hidden"  :name="'dish_price['+index+']'" :value="dish.price" readonly>
                          <div class="price_resume">
                            <p class="m-0">@{{ dish.price.toFixed(2) }}</p>
                            <span>&euro;</span>
                          </div>
                        </div>
                        
                        <label for="amount" class="tot_order mt-2">
                            <span class="input-label">Totale</span>
                            <h4 class="mt-3">@{{total.toFixed(2)}} &euro;</h4>
                            <input id="total" class="input_ms" type="hidden" id="amount" name="amount" :value="total" min="1" readonly>
                          </label>
                          
                        </div>                      
                      </div>
                  </section>
                  <div class="cont_form d-flex my-0 mx-0">
                    <div class="cont_pay_left">
                      <h3>I TUOI DATI</h3>
                      <div class="form-group">
                        {{-- <label class="form-label" for="name">Nome</label> --}}
                        <input type="text" id="name" name="client_name" value="{{old('client_name')}}" placeholder="Inserisci nome">
                      </div>
                      <div class="form-group">
                        {{-- <label class="form-label" for="surname">Cognome</label> --}}
                        <input id="surname" type="text" name="client_surname" value="{{old('client_surname')}}" placeholder="Inserisci cognome">
                      </div>
                      <div class="form-group">
                        {{-- <label class="form-label" for="email">Email</label> --}}
                        <input type="email" id="email" name="client_mail" value="{{old('client_mail')}}" placeholder="Inserisci email">
                      </div>
                      <div class="form-group">
                        {{-- <label class="form-label" for="address">Indirizzo</label> --}}
                        <input type="text" id="address" name="client_address" value="{{old('client_address')}}" placeholder="Inserisci indirizzo">
                      </div>
                      <div class="form-group">
                        <label class="form-label" for="order_date">Data Ordine</label>
                        <input class="form-control" type="datetime-local" id="order_date" name="order_date" value="{{old('order_date')}}" min="2021-03-29T11:00" max="2021-03-29T23:59">
                      </div>
                  </div>
                  
                  <div class="cont_pay_right">
                    <h3>PAGAMENTO</h3>
                    <div class="bt-drop-in-wrapper">
                      <div id="bt-dropin"></div>
                    </div>
                    <input type="hidden" id="nonce" name="payment_method_nonce" type="text" readonly />
                    
                    <button id="pay-button" class="btn" type="submit" v-on:click="deleteOrder()">
                      <div>Effettua il Pagamento</div>
                    </button>
                  </div>                      
                  {{-- </div> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      {{-- jumbotron e Form --}}
      
    </header>
      {{-- Header --}}
      
    
    
  <script src="{{asset('js/payment.js')}}"></script>
  <script>
    var form = document.querySelector('#payment-form');
    var client_token ="{{$token}}";
    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      // paypal: {
      //   flow: 'vault'
      // }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
  </script>   
</body>
</html>
