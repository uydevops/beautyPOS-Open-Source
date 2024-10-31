@include('layouts.header')
@include('layouts.module.customer_edit_modal')
@include('layouts.module.customer_add_modal')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Müşteri Ayarları</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Analiz</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Müşteri Ayarları</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Müşteriler</h5>
                            <p class="card-title-desc">
                                Müşterilerinizi buradan yönetebilirsiniz.
                            </p>

                            <div class="row mb-4 justify-content-end">
                                <div class="col-sm-4 text-end">
                                    <button class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#addCustomerModal"><i class="fas fa-plus"></i> Yeni Müşteri Ekle</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>Adı</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $customer)
                                        <tr class="{{ $customer->is_vip ? 'vip-customer' : '' }}">
                                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone ?? 'N/A' }}</td> <!-- Telefon alanı -->
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomerModal{{ $customer->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="{{ route('customers.delete', $customer->id) }}" class="btn btn-danger" onclick="return confirm('Bu müşteriyi silmek istediğinize emin misiniz?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    
                                        @include('layouts.module.customer_edit_modal', ['customer' => $customer])
                                    
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
<style>
    .vip-customer {
    background-color: #ffe0b2 !important; /* Arka plan rengi */
    font-weight: bold; /* Kalın yazı */
}

</style>