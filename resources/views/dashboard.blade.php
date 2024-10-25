@include('layouts.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Analiz</a>
                                </li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div> <!-- End page-title-box -->
                </div> <!-- End col-12 -->
            </div> <!-- End row -->
        </div> <!-- End container-fluid -->
    </div> <!-- End page-content -->
</div> <!-- End main-content -->

@include('layouts.footer')
