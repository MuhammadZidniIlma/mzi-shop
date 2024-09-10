<x-layout-home>

    <section id="blog-detail">
        <div class="hero"
            style="background-image: url({{ $posts->image ? asset('image/' . $posts->image) : asset('images/belum upload.png') }});">
            <div class="hero-content">
                <h2 class="mb-4 text-white">{{ $posts->title }}</h2>
                <div class="info-container d-flex align-items-center">
                    <figure class="me-3 d-inline-block">
                        <img src="{{ $posts->user->image ? asset('profile/' . $posts->user->image) : asset('profile/default.png') }}"
                            alt="Image" class="img-fluid" style="width: 30px">
                    </figure>
                    <div class="info-text">
                        <span>{{ $posts->user->username }}</span>
                        <span>&nbsp;-&nbsp;{{ \Carbon\Carbon::parse($posts->published_at)->format('F j, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="content py-5">
            <div class="container" style="width: 70%">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <img src="{{ $posts->image ? asset('image/' . $posts->image) : asset('images/belum upload.png') }}"
                            alt="Image placeholder" class="img-fluid mb-5 rounded-3">
                        <p class="mb-4 text-justify">{{ $posts->content }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-5 comment-wrap">
            <h3 class="mb-5 heading">{{ $posts->comments()->where('parent', 0)->count() }} Comments
                {{ $posts->comments()->where('parent', 0)->count() > 1 ? '' : '' }}</h3>
            <ul class="comment-list">
                @foreach ($posts->comments()->where('parent', 0)->get() as $comment)
                    <li class="comment">
                        <div class="vcard">
                            <img src="{{ $comment->user->avatar ? asset('profile/' . $comment->user->avatar) : asset('profile/default.png') }}"
                                alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                            <h3>{{ $comment->user->username }}</h3>
                            <div class="meta">{{ $comment->created_at->format('F j, Y \a\t g:i a') }}
                            </div>
                            <p>{{ $comment->content }}</p>

                            @guest
                                <p><a href="{{ route('login') }}" class="rounded text-black"
                                        style="padding:3px 10px; background-color: rgb(227, 227, 227); font-size: 13px">Reply</a>
                                </p> <br>
                            @endguest
                            @auth
                                <p><a href="#" class="reply rounded" data-comment-id="{{ $comment->id }}">Reply</a>
                                </p> <br>
                                <form action="" method="POST" class="reply-form" id="reply-form-{{ $comment->id }}"
                                    style="display:none;">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="parent" value="{{ $comment->id }}">
                                        <textarea name="content" id="message" cols="30" rows="2" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group text-end">
                                        <input type="submit" value="Send" class="btn btn-primary"
                                            style="padding:10px; font-size: 10px">
                                    </div>
                                </form>
                            @endauth
                        </div>
                        <!-- Display Replies -->
                        @auth
                            @if ($comment->replies)
                                <ul class="children">
                                    @include('home.reply', [
                                        'comments' => $comment->replies,
                                    ])
                                </ul>
                            @endif
                        @endauth
                    </li>
                @endforeach
            </ul>
            <!-- END comment-list -->

            <div class="comment-form-wrap pt-5">
                <h3 class="mb-3">Leave a comment</h3>
                <form action="" class="p-2" method="POST">
                    @csrf
                    <div class="form-group">
                        @auth
                            <input type="hidden" name="post_id" value="{{ $posts->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        @endauth
                        <textarea name="content" id="message" cols="30" rows="10" class="form-control mb-3"
                            placeholder="Write your comment..."></textarea>
                    </div>
                    <div class="form-group">
                        @auth
                            <input type="submit" value="Post Comment" class="btn btn-primary">
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary">Post Comment</a>
                        @endguest
                    </div>
                </form>
            </div>
        </div>

    </section>

    <div style="height: 100px">

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua tombol reply
            var replyButtons = document.querySelectorAll('.reply');

            replyButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Ambil ID komentar dari data-comment-id
                    var commentId = this.getAttribute('data-comment-id');

                    // Toggle form reply berdasarkan ID
                    var replyForm = document.getElementById('reply-form-' + commentId);
                    if (replyForm.style.display === 'none') {
                        replyForm.style.display = 'block';
                    } else {
                        replyForm.style.display = 'none';
                    }
                });
            });
        });
    </script>
</x-layout-home>
