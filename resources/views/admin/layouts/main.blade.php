<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Spartan:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <section class="flex_ms">  
        
        <div id="back_img_ms" class="back_img">
            <img class="back_img_det_ms" src="{{asset('images/sfondo-back.jpg') }}" alt="Analytics">

        </div>
        <nav class="nav_responsive_backend justify-content-between">
            <a href="{{ route('homepage') }}">
                <img class="mb-2" src="{{ asset('images/logo.png') }}" alt="logo">
            </a>
            <a id="resp_user_ms" href="{{ route('admin.restaurants.index') }}">
                <div class="user">
                    {{Auth::user()->name}}  
                </div>
            </a>
        </nav>
        <aside id="side_resp_ms" class="container_ms">
            <header>
                
                <div class="flex_ms mb-3">
                    <a class="mr-3" href="{{ route('homepage') }}">
                        <img class="mb-2" src="{{ asset('images/logo.png') }}" alt="logo">
                    </a>
                     <h1>{{ Auth::user()->name }}</h1>
                </div>

                @yield('aside')                
                <a href="{{ route('admin.restaurants.create') }}"> 
                    <i class="fas fa-plus plus_ms"> 
                        <span>Aggiungi un ristorante</span>
                    </i>
                </a>  
                <h2>I tuoi ristoranti:</h2> 
            </header>
            
            <main>
                
                
                <div>                    
                    @foreach ($restaurants as $restaurant)                    
                        <a class="prova_ms" href="{{ route('admin.restaurants.show', $restaurant->slug) }}">
                            <h3>{{$restaurant->name}}</h3>
                        </a>
                        <div class="menu_ms flex_ms container_btn_menu_ms">
                            <a class="menu_detail_ms" href="{{route('admin.restaurants.dishes.create', $restaurant->slug)}}">
                                <i class="fas fa-plus plus_ms"> 
                                </i>
                                <span>Crea Piatto</span> 
                            </a>
                        </div>                        
                    @endforeach    
                </div>

            </main>

            <footer>
                <a class="btn_logout" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fas fa-door-open"></i>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                </form>
            </footer>
            
            
        </aside>
        
        
        <main id="hide_main_ms" class="main_ms">
            @yield('main')
        </main>

    </section>

</body>
</html>
