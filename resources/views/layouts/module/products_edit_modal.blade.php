@foreach($products as $product)
    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="productEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ürün Düzenle: {{ $product->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="mb-3 text-center">
                                <img src="{{ $product->image ? asset('images/'.$product->image) : asset('images/no_image.png') }}" alt="{{ $product->image ? 'Product Image' : 'No Image' }}" class="img-thumbnail" style="width: 200px; height: 200px;">
                            </div>

                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Ürün Kategorisi</label>
                                <select class="form-select" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Ürün Tipi</label>
                                <select class="form-select" name="unit" required>
                                    @foreach($products_unit as $units)
                                        <option value="{{ $units->id }}" {{ $units->id == $product->unit ? 'selected' : '' }}>{{ $units->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">Ürün Adı</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Ürün Özelliği</label>
                                <textarea class="form-control" name="product_description" rows="3" required>{{ $product->product_details }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Ürün Açıklaması</label>
                                <textarea class="form-control" name="aciklama" rows="3" required>{{ $product->aciklama }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="productStock" class="form-label">Stok Miktarı</label>
                                <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Fiyat</label>
                                <input type="number" class="form-control" id="priceFormat" name="price" value="{{ $product->price }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">S Adet</label>
                                <input type="text" class="form-control" name="s" value="{{ $product->s }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">M Adet</label>
                                <input type="text" class="form-control" name="m" value="{{ $product->m }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">L Adet</label>
                                <input type="text" class="form-control" name="l" value="{{ $product->l }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">XL Adet</label>
                                <input type="text" class="form-control" name="xl" value="{{ $product->xl }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">XXL Adet</label>
                                <input type="text" class="form-control" name="xxl" value="{{ $product->xxl }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productImage" class="form-label">Ürün Fotoğrafı</label>
                                <input class="form-control" type="file" name="image">
                            </div>

                            <div class="mb-3">
                                <label for="productImage" class="form-label">Toplu Ürün Fotoğrafları</label>
                                <input class="form-control" type="file" name="images[]" multiple>
                            </div>

                            <div class="mb-3">
                                <label for="productVisibility" class="form-label">Ürün Görünürlük Durumu</label>
                                <select class="form-select" name="active" required>
                                    <option value="1" {{ $product->active == 1 ? 'selected' : '' }}>Görünür</option>
                                    <option value="0" {{ $product->active == 0 ? 'selected' : '' }}>Gizli</option>
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
