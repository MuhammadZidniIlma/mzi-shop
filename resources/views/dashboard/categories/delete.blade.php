{{-- @foreach ($categories as $category) --}}
<!-- Modal -->
<div class="modal fade" id="delete{{ $category->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.delete', $category->slug) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="mb-3">
                        <p>You want to delete this category ({{ $category->name_category }})?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- @endforeach --}}
