<x-layout-home>

    <x-hero-home title="Shop"
        description="Welcome to MZI Shop! Discover tips, inspiration, and the latest trends in marble products to enhance your space with style and elegance."
        :imageUrl="asset('images/couch.png')" />

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">

                @foreach ($products as $product)
                    <!-- Start Column 1 -->
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <a class="product-item" type="button" data-bs-toggle="modal"
                            data-bs-target="#card{{ $product->slug }}">
                            <img src="{{ $product->image ? asset('image/' . $product->image) : asset('image/belum-upload.png') }}"
                                class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{ $product->name_product }}</h3>
                            <strong
                                class="product-price">Rp.{{ $product->price_discount ? $product->price_discount : $product->price }}</strong>

                            <span class="icon-cross">
                                <img src="images/cross.svg" class="img-fluid">
                            </span>
                        </a>
                        @include('home.card')
                    </div>
                    <!-- End Column 1 -->
                @endforeach

            </div>
        </div>
    </div>
</x-layout-home>
