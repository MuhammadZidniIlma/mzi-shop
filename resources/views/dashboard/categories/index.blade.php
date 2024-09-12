<x-layout-dashboard>
    <div class="col-12">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Table Category</h5>

                <div class="align-self-center mx-3">
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <!-- Tombol untuk create -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add Category
                        </button>
                        @include('dashboard.categories.create')
                        {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#import">
                            Import User
                        </button>
                        @include('dashboard.user.import') --}}
                    @endif
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $category)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $category->name_category }}</td>
                                <td>
                                    {{ $category->slug }}
                                </td>
                                <td>
                                    <button type="buttom" class="btn btn-icon item-edit" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $category->slug }}">
                                        <i class="bx bx-edit bx-md"></i>
                                    </button>
                                    <button type="buttom" class="text-danger btn btn-icon item-delete"
                                        data-bs-toggle="modal" data-bs-target="#delete{{ $category->slug }}">
                                        <i class="bx bx-trash bx-md"></i>
                                    </button>
                                    @include('dashboard.categories.edit')
                                    @include('dashboard.categories.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
</x-layout-dashboard>
