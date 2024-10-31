@foreach($services as $product)
    <div class="modal fade" id="editServiceModal{{ $product->id }}" tabindex="-1" aria-labelledby="productEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hizmet Düzenle: {{ $product->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('services.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="mb-3 text-center">
                                <img src="{{ $product->image ? asset('images/'.$product->image) : asset('images/no_image.png') }}" alt="{{ $product->image ? 'Hizmet Görseli' : 'Görsel Yok' }}" class="img-thumbnail" style="width: 200px; height: 200px;">
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">Hizmetin Adı</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Hizmetin Açıklaması</label>
                                <textarea class="form-control" name="description" required>{{ $product->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Hizmetin Fiyatı</label>
                                <input type="number" class="form-control" name="price" value="{{ $product->price }}" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="productDuration" class="form-label">Hizmetin Süresi (dakika)</label>
                                <input type="number" class="form-control" name="duration" value="{{ $product->duration }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="employee" class="form-label">Hizmeti Yapan Çalışan</label>
                                <select class="form-select" name="employee_id" required>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id == $product->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="isActive" class="form-label">Hizmet Aktif mi?</label>
                                <select class="form-select" name="is_active" required>
                                    <option value="1" {{ $product->is_active ? 'selected' : '' }}>Evet</option>
                                    <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Hayır</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="discountPrice" class="form-label">İndirimli Fiyat</label>
                                <input type="number" class="form-control" name="discount_price" value="{{ $product->discount_price }}" step="0.01">
                            </div>

                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Hizmet Kategorisi</label>
                                <select class="form-select" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
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


<style>
    .modal-body {
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }

    .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background-color: #007bff;
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }
</style>