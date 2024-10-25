@foreach($ads as $ad)
<div class="modal fade" id="editAdModal{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="editAdModal{{ $ad->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdModal{{ $ad->id }}Label">Reklam Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ads.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $ad->id }}" hidden>
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="slider_title_{{ $ad->id }}">Başlık</label>
                        <input type="text" class="form-control" id="slider_title_{{ $ad->id }}" name="slider_title" value="{{ $ad->slider_title }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="slider_description_{{ $ad->id }}">Açıklama</label>
                        <textarea class="form-control" id="slider_description_{{ $ad->id }}" name="slider_description" rows="4" required>{{ $ad->slider_description }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="slider_image_{{ $ad->id }}">Slider Resmi (1110x520)</label>
                        <input type="file" class="form-control" id="slider_image_{{ $ad->id }}" name="slider_image" onchange="previewImage('{{ $ad->id }}', 'slider_image')">
                        <img id="slider_image-preview_{{ $ad->id }}" src="{{ asset('images/' . $ad->slider_image) }}" alt="Slider Resmi" class="img-thumbnail mt-2" style="max-width: 200px;">
                    </div>
                    <hr>
                    <!-- Küçük Banner Reklam Ayarları -->
                    <div class="form-group mb-3">
                        <label for="small_banner_title_{{ $ad->id }}">Başlık</label>
                        <input type="text" class="form-control" id="small_banner_title_{{ $ad->id }}" name="small_banner_title" value="{{ $ad->small_banner_title }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="small_banner_description_{{ $ad->id }}">Açıklama</label>
                        <textarea class="form-control" id="small_banner_description_{{ $ad->id }}" name="small_banner_description" rows="4" required>{{ $ad->small_banner_description }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="small_banner_image_{{ $ad->id }}">Küçük Banner Resmi (575x200)</label>
                        <input type="file" class="form-control" id="small_banner_image_{{ $ad->id }}" name="small_banner_image" onchange="previewImage('{{ $ad->id }}', 'small_banner_image')">
                        <img id="small_banner_image-preview_{{ $ad->id }}" src="{{ asset('images/' . $ad->small_banner_image) }}" alt="Küçük Banner Resmi" class="img-thumbnail mt-2" style="max-width: 200px;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="small_banner_image_{{ $ad->id }}">Küçük Banner 2 Resmi (575x200)</label>
                        <input type="file" class="form-control" id="small_banner_image_{{ $ad->id }}" name="small_banner_image_2" onchange="previewImage('{{ $ad->id }}', 'small_banner_image')">
                        <img id="small_banner_image-preview_{{ $ad->id }}" src="{{ asset('images/' . $ad->small_banner_image_2) }}" alt="Küçük Banner Resmi" class="img-thumbnail mt-2" style="max-width: 200px;">
                    </div>
                    <hr>
                    <!-- Orta Banner Reklam Ayarları -->
                    <div class="form-group mb-3">
                        <label for="medium_banner_title_{{ $ad->id }}">Başlık</label>
                        <input type="text" class="form-control" id="medium_banner_title_{{ $ad->id }}" name="medium_banner_title" value="{{ $ad->medium_banner_title }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="medium_banner_description_{{ $ad->id }}">Açıklama</label>
                        <textarea class="form-control" id="medium_banner_description_{{ $ad->id }}" name="medium_banner_description" rows="4" required>{{ $ad->medium_banner_description }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="medium_banner_image_{{ $ad->id }}">Orta Banner Resmi (1110x345)</label>
                        <input type="file" class="form-control" id="medium_banner_image_{{ $ad->id }}" name="medium_banner_image" onchange="previewImage('{{ $ad->id }}', 'medium_banner_image')">
                        <img id="medium_banner_image-preview_{{ $ad->id }}" src="{{ asset('images/' . $ad->medium_banner_image) }}" alt="Orta Banner Resmi" class="img-thumbnail mt-2" style="max-width: 200px;">
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
function previewImage(adId, inputId) {
    const input = document.getElementById(inputId + '_' + adId);
    const preview = document.getElementById(inputId + '-preview_' + adId);
    const file = input.files[0];
    const reader = new FileReader();

    reader.onloadend = function() {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}
</script>
