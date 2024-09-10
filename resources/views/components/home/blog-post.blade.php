<div class="blog-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">{{ $title }}</h2>
            </div>
            @if (isset($viewAllPost))
                <div class="col-md-6 text-start text-md-end">
                    <a href="{{ route('blog') }}" class="more">{{ $viewAllPost }}</a>
                </div>
            @endif
        </div>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-3 md-0">
                    <div class="post-entry">
                        <a href="{{ route('blog-detail', $post->slug) }}" class="post-thumbnail">
                            <img src="{{ $post->image ? asset('image/' . $post->image) : asset('image/belum-upload.png') }}"
                                class="img-fluid post-thumbnail" alt="{{ $post->title }}">
                        </a>
                        <div class="post-content-entry">
                            <h3><a href="#">{{ $post->title }}</a></h3>
                            <div class="meta">
                                <span>by <a href="#">{{ $post->user->username }}</a></span> <span>on <a
                                        href="#">{{ $post->created_at->format('M d, Y') }}</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
