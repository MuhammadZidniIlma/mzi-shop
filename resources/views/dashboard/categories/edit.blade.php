@foreach ($categories as $category)
    <!-- Modal -->
    <div class="modal fade" id="edit{{ $category->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.update', $category->slug) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name_category" class="form-label">Name Category</label>
                            <input type="text" class="form-control" id="name_category" name="name_category"
                                placeholder="Enter category name"
                                value="{{ old('name_category') ?? $category->name_category }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-2"
                                data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
