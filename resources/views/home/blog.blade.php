<x-layout-home>
    <!-- Memanggil komponen Hero Home dengan variabel khusus untuk halaman About -->
    <x-hero-home title="Blog"
        description="Explore our expert tips, inspiring ideas, and the latest trends in marble products. Discover how to elevate your space with stylish and elegant marble solutions. Join us for a wealth of insights to help you create the perfect look for your home or project."
        :imageUrl="asset('images/couch.png')" />

    <x-blog-post title='Blog Posts' :posts="$posts" />
</x-layout-home>
