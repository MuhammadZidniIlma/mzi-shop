<x-layout-home>
    <!-- Memanggil komponen Hero Home dengan variabel khusus untuk halaman About -->
    <x-hero-home title="About Us"
        description="MZI Shop offers premium marble products that bring elegance and sophistication to any space. From stylish tables to chic accessories, our curated collection enhances your environment with timeless luxury."
        imageUrl="{{ asset('images/couch.png') }}" />

    <!-- Bagian Services -->
    <x-service />

    <!-- Bagian Testimonials -->
    <x-testimonial />
</x-layout-home>
