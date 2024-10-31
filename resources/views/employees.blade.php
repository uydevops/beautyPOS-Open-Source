@include('layouts.header')
@include('layouts.module.employee_add_modal')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Çalışanlar</h4> <!-- "Çalişanlar" yerine "Çalışanlar" -->

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Analiz</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Personeller</a></li> <!-- "Çalişanlar" yerine "Çalışanlar" -->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Personeller</h5>
                            <p class="card-title-desc">
                                Personellerinizi buradan yönetebilirsiniz.
                            </p>

                            <div class="row mb-4 justify-content-end">
                                <div class="col-sm-4 text-end">
                                    <button class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i class="fas fa-plus"></i> Yeni Personel Ekle</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>Çalışan Adı</th>
                                            <th>Kullanılan İzin Günleri</th>
                                            <th>Yıllık İzin Günleri</th>
                                            <th>İşe Giriş Tarihi</th>
                                            <th>İşlemler</th> <!-- "İşlemler" eklendi -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->leave_days }}</td>
                                            <td>{{ $employee->annual_leave_days }}</td>
                                            <td>{{ \Carbon\Carbon::parse($employee->hire_date)->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('employees.delete', ['id' => $employee->id]) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $employee->id }}"><i class="fas fa-pencil-alt"></i></button>
                                            </td>
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
