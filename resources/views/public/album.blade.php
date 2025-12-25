@extends('layout.public')
@section('title', 'Album')
@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center" data-aos="fade-up" data-aos-delay="100">
                <h2><span>WOKA </span><span class="underlight">ACADEMY</span></h2>
                <p>CV. WOKA PROJECT MANDIRI</p>
                <p>{{ $album->title }}</p>
                <a href="contact.html" class="btn-get-started">Available for Hire<br></a>
            </div>
        </div>
    </div>
</section><!-- /Hero Section -->
<!-- Gallery Section -->
<section id="gallery" class="gallery section">
    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4 justify-content-center">

            @forelse ($photos as $photo)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="gallery-item h-100">
                    <img src="{{ asset('storage/'.$photo->file) }}" class="img-fluid w-100"
                        style="aspect-ratio: 1 / 1; object-fit: cover;" alt="{{ $photo->caption }}">
                    <div class="gallery-links d-flex align-items-center justify-content-center">
                        <a href="{{ asset('storage/'.$photo->file) }}" class="glightbox preview-link" title="{{ $photo->caption }}">
                            <i class="bi bi-arrows-angle-expand"></i>
                        </a>
                        <a href="#" class="details-link"><i class="bi bi-link-45deg"></i></a>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Tidak ada foto</p>
            </div>
            @endforelse

        </div>
    </div>
</section>
@endsection