@include('layouts.header')
@include('layouts.module.categories_add_modal')
@include('layouts.module.services_add_modal')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Hızlı Randevu Oluştur</h4>
                            <p class="card-title-desc">Güzellik salonu için hızlı randevu oluşturabilirsiniz.</p>

                            <div class="row mb-4 justify-content-end">
                                <div class="col-sm-4 text-end">
                                    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                        <i class="mdi mdi-plus"></i> Kategori Ekle
                                    </button>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                        <i class="mdi mdi-plus"></i> Hizmet Ekle
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>Hizmet Adı</th>
                                            <th>Açıklama</th>
                                            <th>Fiyat</th>
                                            <th>İşlem Süresi</th>
                                            <th>İlgilenen Personel</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td>{{ $service->price }} ₺</td>
                                            <td>{{ $service->duration }} dakika</td>
                                            <td>{{ $service->staff_name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal{{ $service->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="{{ route('services.delete', $service->id) }}" class="btn btn-danger" onclick="return confirm('Bu hizmeti silmek istediğinize emin misiniz?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('layouts.module.services_edit_modal')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            @include('layouts.footer')
            @include('layouts.datatable')
        </div> <!-- end container-fluid -->
    </div> <!-- end page-content -->
</div> <!-- end main-content -->