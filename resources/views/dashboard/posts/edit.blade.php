<x-layout-dashboard>
    <div class="row g-6">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Edit Post</h5>
                <div class="card-body">
                    <div>
                        <form action="{{ route('post.update', $post->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="recent_image" class="form-label"> Recent Thumbnail</label>
                                <img src="{{ $post->image ? asset('image/' . $post->image) : asset('image/belum-upload.png') }}"
                                    class="img-thumbnail" alt="post" style="width: 150px">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image Thumbnail</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    value="{{ old('image') }}">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter post title" value="{{ $post->title }}">
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" placeholder="Enter content post" id="content" name="content" style="height: 100px">{{ $post->content }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout-dashboard>
