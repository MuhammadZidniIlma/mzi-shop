<x-layout-home>
    <x-hero-home title="Modern Interior Design Studio"
        description="Discover the beauty of premium marble, from tables to accessories, all in one place. Elevate your space with high-quality products and elegant designs."
        primaryButtonUrl="{{ route('shop') }}" primaryButtonText="Shop Now" secondaryButtonUrl="#products"
        secondaryButtonText="Explore" imageUrl="{{ asset('images/couch.png') }}" />
    <!-- Start Product Section -->
    <div id="products" class="product-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                    <p class="mb-4">This product blends beauty and strength, creating a piece that is not only
                        visually stunning but also durable in its use. </p>
                    <p><a href="{{ route('shop') }}" class="btn">Explore</a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                @foreach ($products as $product)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" type="button" data-bs-toggle="modal"
                            data-bs-target="#card{{ $product->slug }}">
                            <img src="{{ $product->image ? asset('image/' . $product->image) : asset('image/belum-upload.png') }}"
                                class="img-fluid product-thumbnail" alt="{{ $product->name_product }}">
                            <h3 class="product-title">{{ $product->name_product }}</h3>
                            <strong class="product-price">Rp.
                                {{ number_format($product->price_discount ? $product->price_discount : $product->price) }}</strong>

                            <span class="icon-cross">
                                <img src="images/cross.svg" class="img-fluid">
                            </span>
                        </a>
                        @include('home.card')
                    </div>
                @endforeach
                <!-- End Column 2 -->

            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <x-service />
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
    <x-service-more url="Explore" />
    <!-- End We Help Section -->

    <!-- Start Discount Section -->
    <section id="discount my-5">
        <div class="container my-5">
            @if ($banner && $banner->image)
                <div class="banner-item">
                    <img src="{{ asset('image/' . $banner->image) }}" alt="Discount Image"
                        style="width: 100%; height: 550px; border-radius: 10px">
                </div>
            @endif
        </div>
    </section>
    <!-- End Discount Section -->

    <!-- Start Testimonial Slider -->
    <x-testimonial />
    <!-- End Testimonial Slider -->

    <!-- Start Blog Section -->
    <x-blog-post title='Recent Blog' :posts="$posts" viewAllPost='View All Posts' />
    <!-- End Blog Section -->
</x-layout-home>
