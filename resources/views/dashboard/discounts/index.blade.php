<x-layout-dashboard>
    <div class="col-12">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Table Discounts</h5>

                <div class="align-self-center mx-3">
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <!-- Tombol untuk create -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add Discount
                        </button>
                        @include('dashboard.discounts.create')
                    @endif
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Discount Name</th>
                            <th> Discount</th>
                            <th>Max Amount</th>
                            <th>Start Date</th>
                            <th>Expiration Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($discounts as $discount)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $discount->name_discount }}</td>
                                <td>
                                    {{ $discount->persentase_discount }}
                                </td>
                                <td>
                                    Rp. {{ number_format($discount->amount_discount) }}
                                </td>
                                <td>
                                    {{ $discount->start_date }}
                                </td>
                                <td>
                                    {{ $discount->expiration_date }}
                                </td>
                                <td>
                                    {{ $discount->status }}
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
                                                    data-bs-target="#delete{{ $discount->id }}">Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    {{-- <button type="buttom" class="btn btn-icon item-edit" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $discount->slug }}">
                                        <i class="bx bx-edit bx-md"></i>
                                    </button>
                                    @include('dashboard.discounts.edit') --}}
                                    @include('dashboard.discounts.delete')
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
