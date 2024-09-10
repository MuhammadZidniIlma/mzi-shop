<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <!-- Menampilkan judul dinamis -->
                    <h1><span class="d-block">{{ $title }}</span></h1>

                    <!-- Menampilkan deskripsi dinamis -->
                    <p class="mb-4">{{ $description }}</p>

                    <p>
                        <!-- Menampilkan teks dan URL tombol dinamis -->
                        @if (isset($primaryButtonUrl) && isset($primaryButtonText))
                            <a href="{{ $primaryButtonUrl }}" class="btn btn-secondary me-2">{{ $primaryButtonText }}</a>
                        @endif

                        @if (isset($secondaryButtonUrl) && isset($secondaryButtonText))
                            <a href="{{ $secondaryButtonUrl }}"
                                class="btn btn-white-outline">{{ $secondaryButtonText }}</a>
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <!-- Menampilkan gambar dinamis -->
                    @if (isset($imageUrl))
                        <img src="{{ $imageUrl }}" alt="Hero Image" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
