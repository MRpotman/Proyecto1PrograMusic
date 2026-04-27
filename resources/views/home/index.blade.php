@extends('layouts.app')

@section('title', 'Inicio')


@section('content')

<!-- Carousel -->
<div class="carousel-container">
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item">
        <img src="https://i.pinimg.com/736x/30/68/ab/3068ab91ed1033702f6c64cc955d2205.jpg" class="d-block w-100">
      </div>


      <div class="carousel-item active">
        <img src="https://img2.rtve.es/i/?w=1200&i=https://img.rtve.es/imagenes/foto-abbey-road-cumple-50-anos/1565264921818.jpg" class="d-block w-100">
      </div>

      <div class="carousel-item">
        <img src="https://www.laxcali.com/uploads/newsarticle/e98ad8ff665e4508b601555ff09f92d7/ariana-grande-on-stall-chair-photography-cl_b3wZ62a.jpg" class="d-blck w-100">
      </div>

      <div class="carousel-item">
        <img src="https://www.infobae.com/resizer/v2/E73NEXJKIJDDJHI7XPKRUPAH6Q.png?auth=0582aef45efe1475cf5372b646f09d140ca946697ec4dc7f90a49d6d17356e31" class="d-block w-100">
      </div>

      <div class="carousel-item">
        <img src="https://media.pitchfork.com/photos/679cccbab742af95ca81e4fe/16:9/w_1280,c_limit/The-Weeknd-Hurry-Up-Tomorrow.jpeg" class="d-block w-100">
      </div>

    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>
</div>

<!-- COMING SOON -->
<div class="container py-5">
  <h2 class="text-center titulo"> ๋࣭ ⭑ COMING SOON ๋࣭ ⭑ </h2>

  <div class="row row-cols-1 row-cols-md-4 g-4 py-5">

    <div class="col">
      <div class="card">
        <img src="https://imusic.b-cdn.net/images/item/original/266/8800327581266.jpg" class="card-img-top">
        <div class="card-body">
          <button class="btn btn-primary">BTS Lightstick</button>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="https://i.scdn.co/image/ab67616d00001e021a1495ff41046065b9475366" class="card-img-top">
        <div class="card-body">
          <button class="btn btn-primary">Drop Dead Olivia Rodrigo</button>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="https://i.scdn.co/image/ab67616d0000b273bc755429117cac056edd2bf7" class="card-img-top">
        <div class="card-body">
          <button class="btn btn-primary">The Life of a Showgirl - Taylor Swift</button>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4eYTpqw-hYM1rGc0lOtduwxcD9BHmcWEB8w&s" class="card-img-top">
        <div class="card-body">
          <button class="btn btn-primary">DtMF -  Bad Bunny </button>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- CONTACTO -->
<div class="slider">
  <div class="slide-track">
    @for ($i = 0; $i < 10; $i++)
      <div class="slide2">
        <h4>Whatsapp: 8604-1107</h4>
      </div>
    @endfor
  </div>
</div>

<!-- FOOTER -->
<footer>
  <div class="container-fluid bg-frisado">
    <div class="row p-5 bg-secondary-text-black">

      <div class="col-xs-12 col-md-6 col-lg-3">
        <p class="h3 title-bold">Hikari's Records</p>
        <div class="mb-2">
          <img src="https://cdn-icons-png.flaticon.com/512/92/92027.png" style="height: 100px;">
        </div>
      </div>

      <div class="col-xs-12 col-md-6 col-lg-3">
        <p class="h5 mb-3 text-black title-bold">Payment methods</p>
        <div class="mb-2">Paypal: hikaris@gmail.com</div>
        <div class="mb-2">Iban CR72010200009119</div>
        <div class="mb-2">Customer account 102000091197</div>
      </div>

      <div class="col-xs-12 col-md-6 col-lg-3">
        <p class="h5 text-black title-bold">Location</p>
        <div class="mb-2">Country: USA </div>
        <div class="mb-2">California Street</div>
      </div>

      <div class="col-xs-12 col-md-6 col-lg-3">
        <p class="h5 text-black title-bold">Contact</p>
        <div class="mb-2">Whatsapp: 8604-1107</div>
        <div class="mb-2">Facebook: Hikari's Records</div>
        <div class="mb-2">Instagram: Hikari's Records</div>
      </div>

    </div>
  </div>
</footer>

@endsection