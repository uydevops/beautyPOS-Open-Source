<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ürün Oluştur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('services.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Ürün Kategorisi</label>
                            <select class="form-select" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="form-label">Hizmetin Adı</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Hizmetin Açıklaması</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Hizmetin Fiyatı</label>
                            <input type="number" class="form-control" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDuration" class="form-label">Hizmetin Süresi (dakika)</label>
                            <input type="number" class="form-control" name="duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="employee" class="form-label">Hizmeti Yapan Çalışan</label>
                            <select class="form-select" name="employee_id" required>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="isActive" class="form-label">Hizmet Aktif mi?</label>
                            <select class="form-select" name="is_active" required>
                                <option value="1">Evet</option>
                                <option value="0">Hayır</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="discountPrice" class="form-label">İndirimli Fiyat</label>
                            <input type="number" class="form-control" name="discount_price" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Hizmetin Görseli</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Ürünü Oluştur</button>
                </div>
            </form>
        </div>
    </div>
</div>
