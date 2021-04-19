@extends('layouts.front')


@section('content')
<div class="row mt-5">
    <div class="col-6 row">
        @if($product->photos->count())
        <div class="mr-2" style="display: flex;flex-direction: column; width:15%" >
            @foreach($product->photos as $photo)
            <div >
                <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid img-small mb-3">
            </div>
            @endforeach
        </div>

        <img src="{{asset('storage/' . $product->thumb)}}" alt="" class="card-img-top thumb w-75">
        
        @else
        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
        @endif
    </div>
    <div class="col-lg-6">
        <form action="{{route('cart.add')}}" method="post">
            <h1>{{$product->name}}</h1>
            <p class="text-muted lead">R$ {{number_format($product->price, '2', ',', '.')}}</p>
            <p class="text-small mb-4"> {{$product->description}}</p>
            <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                    <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                        <span class="small text-uppercase text-gray mr-4 no-select">Quantidade</span>
                        <div class="quantity">
                            <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                            <input class="form-control border-0 shadow-0 p-0" type="text" value="1" name="product[amount]">
                            <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 pl-sm-0">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">
    
                    <button
                        class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0"
                        href="cart.html">
                        Adicionar ao carrinho
                    </button>
                </div>
            </div>
            <ul class="list-unstyled small d-inline-block">

                <li class="px-3 py-2 mb-1 bg-white">
                    <strong class="text-uppercase">SKU:</strong>
                    <span class="ml-2 text-muted">{{$product->id}}</span>
                </li>

                <li class="px-3 py-2 mb-1 bg-white text-muted">
                    <strong class="text-uppercase text-dark">Categorias:</strong>

                    @forelse ($product->categories as $category)
                    <a class="reset-anchor ml-2"
                        href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                    @empty
                    Nenhuma Categoria cadastrada
                    @endforelse
                </li>
    
                <li class="px-3 py-2 mb-1 bg-white">
                    <strong class="text-uppercase">Loja:</strong>
                    <span class="ml-2 text-muted">{{$product->store->name}}</span>
                </li>
    
            </ul>
        </form>
    </div>
</div>
<!-- DETAILS TABS-->
<ul class="nav nav-tabs border-0 mt-5" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">
            Descrição
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">
            Reviews
        </a>
    </li>
</ul>
<div class="tab-content mb-5" id="myTabContent">
    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
        <div class="p-4 p-lg-5 bg-white">
        <h6 class="text-uppercase">Descrição do produto</h6>
        <p class="text-muted text-small mb-0">{{$product->body}}</p>
      </div>
    </div>
    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
      <div class="p-4 p-lg-5 bg-white">
        <div class="row">
          <div class="col-lg-8">
            <div class="media mb-3"><img class="rounded-circle" src="https://via.placeholder.com/300x300C/" alt="" width="50">
              <div class="media-body ml-3">
                <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                <ul class="list-inline mb-1 text-xs">
                  <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                </ul>
                <p class="text-small mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
            <div class="media"><img class="rounded-circle" src="https://via.placeholder.com/300x300C/" alt="" width="50">
              <div class="media-body ml-3">
                <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                <ul class="list-inline mb-1 text-xs">
                  <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                </ul>
                <p class="text-small mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection

@section('scripts')
<script>
    let thumb = document.querySelector('img.thumb');
    let imgSmall = document.querySelectorAll('img.img-small');

    imgSmall.forEach(function (el) {
        el.addEventListener('click', function () {
            thumb.src = el.src;
        });
    });

</script>
@endsection
