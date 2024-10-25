@foreach($users as $user)
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Kullanıcı Düzenle: {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="userInfoTab{{ $user->id }}" data-bs-toggle="tab" data-bs-target="#userInfo{{ $user->id }}" type="button" role="tab" aria-controls="userInfo{{ $user->id }}" aria-selected="true">
                            <i class="fas fa-user"></i> Kullanıcı Bilgileri
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="userInfo{{ $user->id }}" role="tabpanel" aria-labelledby="userInfoTab{{ $user->id }}">
                        <div class="container">
                            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- PUT method to indicate update -->
                                <br>
                                <input type="hidden" name="id" value="{{ $user->id }}">

                                <div class="mb-3">
                                    <label for="name{{ $user->id }}" class="form-label">Adı</label>
                                    <input type="text" class="form-control" id="name{{ $user->id }}" value="{{ $user->name }}" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email{{ $user->id }}" class="form-label">E-posta</label>
                                    <input type="email" class="form-control" id="email{{ $user->id }}" value="{{ $user->email }}" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password{{ $user->id }}" class="form-label">Şifre</label>
                                    <input type="password" class="form-control" id="password{{ $user->id }}" name="password" placeholder="Yeni şifre girin (değiştirmek istemiyorsanız boş bırakın)">
                                </div>
                                <div class="mb-3">
                                    <label for="remember_token{{ $user->id }}" class="form-label">Remember Token</label>
                                    <input type="text" class="form-control" id="remember_token{{ $user->id }}" value="{{ $user->remember_token }}" name="remember_token" readonly>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
