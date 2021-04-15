<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style_template.css')}}">
    <style>
        .front.row {
            margin-bottom: 40px;
        }

    </style>
    @yield('stylesheets')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0 container"><a class="navbar-brand" href="index.html">
        <span class="font-weight-bold text-uppercase text-dark">Boutique</span></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <!-- Link--><a class="nav-link active" href="{{route('home')}}">Home</a>
                </li>
                @if ($categories)     
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias</a>
                        <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown">
                            @foreach($categories as $category)
                                <a class="dropdown-item border-0 transition-link"
                                href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                            @endforeach
                            </div>
                    </li>
                @endif
                
            </ul>
            <ul class="navbar-nav ml-auto">
                @if(session()->has('cart'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cart.index')}}">
                            <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>
                            Carrinho
                            <small class="text-gray">( {{count(session()->get('cart'))}})</small>
                        </a>
                    </li>
                @endif
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{route('user.orders')}}"> <i
                                class="fas fa-user-alt mr-1 text-gray"></i>Meus pedidos</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit(); ">
                            <i class="fas fa-user-alt mr-1 text-gray"></i>Sair
                        </a>
                        <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </li>
                @endauth
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"> 
                        <i class="fas fa-user-alt mr-1 text-gray"></i>Login</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row py-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="text-uppercase mb-3">Customer services</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a class="footer-link" href="#">Help &amp; Contact Us</a></li>
                        <li><a class="footer-link" href="#">Returns &amp; Refunds</a></li>
                        <li><a class="footer-link" href="#">Online Stores</a></li>
                        <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="text-uppercase mb-3">Company</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a class="footer-link" href="#">What We Do</a></li>
                        <li><a class="footer-link" href="#">Available Services</a></li>
                        <li><a class="footer-link" href="#">Latest Posts</a></li>
                        <li><a class="footer-link" href="#">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="text-uppercase mb-3">Social media</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a class="footer-link" href="#">Twitter</a></li>
                        <li><a class="footer-link" href="#">Instagram</a></li>
                        <li><a class="footer-link" href="#">Tumblr</a></li>
                        <li><a class="footer-link" href="#">Pinterest</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{asset('js/app.js')}}"></script>
    @yield('scripts')
</body>

</html>
