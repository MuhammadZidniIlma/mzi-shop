<div class="col-12">

    <div class="card mb-4">
        <div class="d-flex justify-content-between px-4 pt-3">
            <div class="card-header pb-0">
                <h6>Table Order</h6>
            </div>
            {{-- <div class="col-4">
                <form action="{{ route('userSearch') }}" method="GET" class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="search" placeholder="Type here...">
                </form>
            </div> --}}
        </div>

        <div class="card-body px-0 pt-0 pb-2 mb-5">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    {{ $slot }}
                </table>
            </div>
        </div>
    </div>
</div>
