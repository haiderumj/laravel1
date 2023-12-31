@php
$sliders = DB::table('sliders')->get();
@endphp

<section id="hero">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

    <ol class="carousel-indicators" id="hero-carousel-indicators">
      @foreach($sliders as $key => $slider)
        <li data-target="#heroCarousel" data-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}"></li>
      @endforeach
    </ol>

    <div class="carousel-inner" role="listbox">
      @foreach($sliders as $key => $slider)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image: url({{ asset($slider->image) }});">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2>{{ $slider->title }}</h2>
              <p>{{ $slider->description }}</p>
              <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</section>
