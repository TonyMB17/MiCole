@include('home/layout/header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h3 class="display-3 font-weight-bold text-white">Galeria</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Galeria</p>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Gallery Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5"><span class="px-2">Fotos</span></p>
            <h1 class="mb-4">Galeria de Fotos</h1>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-2">
                <ul class="list-inline mb-4" id="portfolio-flters">
                    <li class="btn btn-outline-primary m-1 active" data-filter="*">Todas</li>
                    {{-- <li class="btn btn-outline-primary m-1" data-filter=".first">Agua</li>
                    <li class="btn btn-outline-primary m-1" data-filter=".second">Drawing</li>
                    <li class="btn btn-outline-primary m-1" data-filter=".third">Reading</li> --}}
                </ul>
            </div>
        </div>
        <div class="row portfolio-container">
            @foreach($images as $image)
            <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
                <div class="position-relative overflow-hidden mb-2">
                    <img class="img-fluid w-100 portfolio-img" src="{{ asset($image->ruta) }}" alt="">
                    <div class="portfolio-btn bg-primary-gallery d-flex align-items-center justify-content-center">
                        <a href="{{ asset($image->ruta) }}" data-lightbox="portfolio">
                            <i class="fa fa-plus text-white" style="font-size: 60px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

<style>
    .portfolio-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
</style>
<!-- Gallery End -->

<!-- Blog Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Videos</span>
            </p>
            <h1 class="mb-4">Ultimos Videos</h1>
        </div>
        <div class="row pb-3">
            @foreach ($videos as $index => $video)
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                        <video id="miVideo{{ $index }}" class="card-img-top mb-2"
                            src="{{ asset($video->route) }}" controls></video>
                        <div class="card-body bg-light text-center p-4">
                            <h4 class="">{{ $video->title }}</h4>
                            <p>
                                {{ $video->description }}
                            </p>
                            <a href="{{ route('home.content_detail', $video->id) }}"
                                class="btn btn-primary px-4 mx-auto my-2">Conocer Mas</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Blog End -->
<script>
    // Seleccionar todos los videos
    const videos = document.querySelectorAll('video');

    videos.forEach(video => {
        video.addEventListener('loadedmetadata', function() {
            this.currentTime = 2; // Establecer el tiempo inicial en 1 segundo
        });
    });
</script>

@include('home/layout/footer')
