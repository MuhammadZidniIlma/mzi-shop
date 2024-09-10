<x-layout-dashboard>
    <div class="col-12">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Table Users</h5>

                <div class="align-self-center mx-3">
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <!-- Tombol untuk create -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add User
                        </button>
                        @include('dashboard.users.create')
                        {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#import">
                                Import User
                            </button> --}}
                        {{-- @include('dashboard.user.import') --}}
                    @endif
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="ps-3">Profile</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>
                                    <img src="{{ $user->avatar ? asset('profile/' . $user->avatar) : asset('profile/default.png') }}"
                                        class="avatar avatar-sm me-3" alt="user1" style="border-radius: 50%">
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    <span
                                        class="badge bg-label-{{ $user->role == 'admin' ? 'primary' : ($user->role == 'pegawai' ? 'warning' : 'danger') }} me-1 text-capitalize">{{ $user->role }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-label-{{ $user->status == 'active' ? 'success' : ($user->status == 'inactive' ? 'warning' : 'danger') }} me-1 text-capitalize">{{ $user->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-inline-block"><a href="javascript:;"
                                            class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end m-0" style="">
                                            <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                            <div class="dropdown-divider"></div>
                                            <li>
                                                <a type="button" class="dropdown-item text-danger delete-record"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $user->id }}">Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <button type="buttom" class="btn btn-icon item-edit" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $user->id }}">
                                        <i class="bx bx-edit bx-md"></i>
                                    </button>
                                    @include('dashboard.users.edit')
                                    @include('dashboard.users.delete')
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
