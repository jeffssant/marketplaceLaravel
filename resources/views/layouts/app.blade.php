<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        
        <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('admin/stores')) active @endif">
                        <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/products')) active @endif">
                        <a class="nav-link" href="{{route('admin.products.index')}} ">Produtos</a>
                    </li>
                </ul>
                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" onclick="document.querySelector('form.logout').submit();" href="#">Sair</a>
                            <form action="{{route('logout')}}" class="logout" method="POST" style="display: none">
                                @csrf
                            </form>
                           
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{auth()->user()->name}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth
        
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
</body>

</html>
