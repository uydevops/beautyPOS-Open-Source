@include('layouts.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Geri Bildirimler</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ana Sayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Geri Bildirimler</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Geri Bildirimler</h5>
                            <p class="card-title-desc">
                                Müşteri geri bildirimlerinizi buradan görüntüleyebilirsiniz.
                            </p>

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>Geri Bildirim ID</th>
                                            <th>Müşteri ID</th>
                                            <th>Geri Bildirim</th>
                                            <th>Oluşturulma Tarihi</th>
                                            <th>Güncellenme Tarihi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($feedback as $feedbacks)
                                        <tr>
                                            <td>{{ $feedbacks->id }}</td>
                                            <td>{{ $feedbacks->customer_id ?? 'Bilinmiyor' }}</td>
                                            <td>{{ $feedbacks->feedback }}</td>
                                            <td>{{ $feedbacks->created_at }}</td>
                                            <td>{{ $feedbacks->updated_at }}</td>
                                        </tr>
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
