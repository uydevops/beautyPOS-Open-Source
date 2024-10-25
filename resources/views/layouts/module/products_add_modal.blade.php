    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ürün Oluştur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="productName" class="form-label">Ürün Adı</label>
                                <input type="text" class="form-control" name="name" value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Ürün Özelliği</label>
                                <textarea class="form-control" name="product_description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Ürün Açıklaması</label>
                                <textarea class="form-control" name="aciklama" rows="3" required></textarea>
                            </div>


                            <div class="mb-3">
                                <label for="productStock" class="form-label ">Stok Miktarı</label>
                                <input type="number" class="form-control" name="quantity" value="" required>
                            </div>


                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Fiyat</label>
                                <input type="number" class="form-control"  id="priceFormat" name="price" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">S Adet</label>
                                <input type="text" class="form-control" name="s" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">M Adet </label>
                                <input type="text" class="form-control" name="m" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">L Adet </label>
                                <input type="text" class="form-control" name="l" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">XL Adet </label>
                                <input type="text" class="form-control" name="xl" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">XXL Adet </label>
                                <input type="text" class="form-control" name="xxl" value="" required>
                            </div>
           

                            <div class="mb-3">
                                <label for="productImage" class="form-label">Ürün Fotoğrafı(Kapak)</label>
                                <input class="form-control" type="file" name="image">
                            </div>

                            <div class="mb-3">
                                <label for="productImage" class="form-label">Toplu Ürün Fotoğrafları</label>
                                <input class="form-control" type="file" name="images[]" multiple>
                            </div>


                            <div class="mb-3">
                                <label for="productVisibility" class="form-label">Ürün Görünürlük Durumu</label>
                                <select class="form-select" name="visible" required>
                                    <option value="1">Görünür</option>
                                    <option value="0">Gizli</option>
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

