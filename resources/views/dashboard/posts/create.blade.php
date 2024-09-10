<x-layout-dashboard>
    <div class="row g-6">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Add Post</h5>
                <div class="card-body">
                    <div>
                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="image" class="form-label">Image Thumbnail</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    value="{{ old('image') }}">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter post title" value="{{ old('title') }}">
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" placeholder="Enter content post" id="content" name="content" style="height: 100px">{{ old('content') }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('posts') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-dashboard>
