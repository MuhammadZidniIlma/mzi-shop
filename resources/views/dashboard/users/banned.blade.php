<!-- Modal -->
<div class="modal fade" id="ban{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Banned User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.ban', $user->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <p>You want to ban this user ({{ $user->username }})?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Banned</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="unban{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Unbanned User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.unban', $user->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <p>You want to unban this user ({{ $user->username }})?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Unbanned</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="actived{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Actived User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.unban', $user->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <p>You want to actived this user ({{ $user->username }})?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Actived</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
