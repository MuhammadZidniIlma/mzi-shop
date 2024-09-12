<x-layout-dashboard>
    <div class="col-12">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Table Post</h5>

                <div class="align-self-center mx-3">
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <!-- Tombol untuk create -->
                        <a href="{{ route('postscreate') }}" class="btn btn-primary">
                            Add Post
                        </a>
                    @endif
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">Image</th>
                            <th>Title</th>
                            <th>Penulis</th>
                            <th>Published At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($posts as $post)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td class="d-flex justify-content-center">
                                    <img src="{{ $post->image ? asset('image/' . $post->image) : asset('image/belum-upload.png') }}"
                                        class="img-thumbnail" alt="post" style="width: 150px">
                                </td>
                                <td>{{ Str::words($post->title, 5, '...') }}</td>
                                <td>
                                    {{ $post->user->username }}
                                </td>
                                <td>
                                    {{ $post->published_at }}
                                </td>
                                <td>
                                    <span
                                        class="badge bg-label-{{ $post->status == 'publish' ? 'primary' : 'danger' }} me-1 text-capitalize">{{ $post->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-inline-block"><a href="javascript:;"
                                            class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end m-0" style="">
                                            <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                            <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                            <div class="dropdown-divider"></div>
                                            <li>
                                                <a type="button" class="dropdown-item text-danger delete-record"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $post->slug }}">Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-icon item-edit">
                                        <i class="bx bx-edit bx-md"></i>
                                    </a>
                                    @include('dashboard.posts.delete')
                                </td>
                            </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
</x-layout-dashboard>
