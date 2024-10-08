<!-- Modal -->
<div class="modal fade" id="edit{{ $discount->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('discount.update', $discount->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="name_discount" class="form-label">Discount Name</label>
                        <input type="text" class="form-control" id="name_discount" name="name_discount"
                            placeholder="Enter category name" value="{{ $discount->name_discount ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="persentase_discount" class="form-label">Persentase Discount</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="persentase_discount"
                                name="persentase_discount" placeholder="Enter category name"
                                value="{{ $discount->persentase_discount ?? '' }}">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="amount_discount" class="form-label">Max Amount Discount</label>
                        <input type="number" class="form-control" id="amount_discount" name="amount_discount"
                            placeholder="Enter category name" value="{{ $discount->amount_discount ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            placeholder="Enter category name" value="{{ $discount->start_date ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="expiration_date" class="form-label">Expiration Date</label>
                        <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                            placeholder="Enter category name" value="{{ $discount->expiration_date ?? '' }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
