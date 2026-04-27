@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<!-- LINK CSS ESPECÍFICO DE ABOUT -->
<link rel="stylesheet" href="{{ asset('assets/css/aboutus.css') }}">

<!-- HERO -->
<div class="background">
  <div class="text-box">
      <h1>Hikari's Records</h1>
      <p>
        We are a music company founded in 2020, specialized in the distribution of music
        from various genres around the world.<br>
        Currently, we have established ourselves as one of the most prominent digital
        music platforms in the country.
      </p>
  </div>
</div>

<!-- SECTION -->
<div class="course">
  <h1>Why music?</h1>
  <p>
    We believe music is for everyone. Our mission is to make music accessible,
    promoting artists and helping listeners discover new sounds without limits.<br>
    Music connects emotions, cultures, and people all over the world.
  </p>

  <div class="row">

      <div class="course-col">
          <h3>Passion</h3>
          <p>
            We are driven by passion for music. Every track, artist and album is selected
            with care to ensure quality and emotion.
          </p>
      </div>

      <div class="course-col">
          <h3>Trust</h3>
          <p>
            We build trust with artists and users by offering transparent systems,
            fair distribution and reliable service.
          </p>
      </div>

      <div class="course-col">
          <h3>Innovation</h3>
          <p>
            We constantly innovate to improve how people discover, listen and experience music.
          </p>
      </div>

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