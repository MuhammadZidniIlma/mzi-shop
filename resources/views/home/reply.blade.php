@foreach ($comments as $reply)
    <li class="comment">
        <div class="vcard">
            <img src="{{ $reply->user->avatar ? asset('profile/' . $reply->user->avatar) : asset('profile/default.png') }}"
                alt="Image placeholder">
        </div>
        <div class="comment-body">
            <h3>{{ $reply->user->username }}</h3>
            <div class="meta">{{ $reply->created_at->format('F j, Y \a\t g:i a') }}</div>
            <p>{{ $reply->content }}</p>
            <p><a href="#" class="reply rounded" data-comment-id="{{ $reply->id }}">Reply</a></p>

            <!-- Reply Form for Nested Reply -->
            <form action="" method="POST" class="reply-form" id="reply-form-{{ $reply->id }}"
                style="display: none;">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="parent" value="{{ $reply->id }}">
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="2" placeholder="Write your reply..."></textarea>
                </div>
                <div class="form-group text-end">
                    <button type="submit" class="btn btn-primary btn-sm">Send</button>
                </div>
            </form>
        </div>

        <!-- Recursively Include Replies -->
        @if ($reply->replies)
            <ul class="children">
                @include('home.reply', ['comments' => $reply->replies])
            </ul>
        @endif
    </li>
@endforeach
