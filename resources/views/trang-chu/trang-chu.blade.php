<html xmlns="http://www.w3.org/1999/xhtml">
@include('trang-chu.head')

<body style="background-color: #E7D2BD">
<header class="p-3 bg-dark text-white" style="margin-bottom: 50px;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="/image/120x120-logo-vneid@2x.webp" alt="" sizes="" srcset="" width="50px">
            </a>
        </div>
    </div>
</header>

<main>
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="justify-content: center;">
                <div class="col-md-2">
                    <!-- Sidebar -->
                    <aside class="main-sidebar">
                        <div class="sidebar">
                            <nav class="mt-2" style="display: flex; flex-direction: column; align-items: center;">
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                    <li class="nav-item">
                                        <a href="{{route('upload')}}" class="nav-link nav-chuyen-tab">
                                            <img src="/image/upload.png" alt="" sizes="" srcset="" style="max-width: 50px; max-height: 50px;">
                                            <span>Upload ảnh</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                    <li class="nav-item">
                                        <a href="{{route('realtime')}}" class="nav-link nav-chuyen-tab" id="start-qr-scan">
                                            <img src="/image/real-time.png" alt="" sizes="" srcset="" style="max-width: 50px; max-height: 50px;">
                                            <span>Quét QR</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </aside>
                </div>
                <div class="col-md-7">
                    @yield('content')
                </div>
                <div class="col-md-2">
                    <!-- function -->
                    <aside class="main-sidebar">
                        <div class="sidebar">
                            <nav class="mt-2" style="display: flex; flex-direction: column; align-items: center;">
                                @if (Request::routeIs('upload'))
                                    <!-- Chỉ hiển thị nút Save khi ở trang upload -->
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <li class="nav-item">
                                            <a id="save-btn" type="button" href="" class="nav-link nav-function btn btn-app">
                                                <img src="/image/save.png" alt="" sizes="" srcset="" style="max-width: 50px; max-height: 50px;">
                                                <span style="font-size: 16px">Save</span>
                                            </a>
                                        </li>
                                    </ul>
                                @endif

                                <!-- Hiển thị nút Export khi ở trang upload hoặc realtime -->
                                @if (Request::routeIs('upload') || Request::routeIs('realtime'))
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                                            role="menu" data-accordion="false">
                                            <li class="nav-item">
                                                <a id="export-word-btn" type="button" href="javascript:void(0)"
                                                   class="nav-link nav-function btn btn-app">
                                                    <img src="/image/word.png" alt="" sizes="" srcset=""
                                                         style="max-width: 50px; max-height: 50px;">
                                                    <span style="font-size: 16px">Xuất Word</span>
                                                </a>
                                            </li>
                                        </ul>
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                                            role="menu" data-accordion="false">
                                            <li class="nav-item">
                                                <a id="export-excel-btn" type="button" href="javascript:void(0)"
                                                   class="nav-link nav-function btn btn-app">
                                                    <img src="/image/excel.png" alt="" sizes="" srcset=""
                                                         style="max-width: 50px; max-height: 50px;">
                                                    <span style="font-size: 16px">Xuất Excel</span>
                                                </a>
                                            </li>
                                        </ul>
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                                            role="menu" data-accordion="false">
                                            <li class="nav-item">
                                                <a id="export-pdf-btn" type="button" href="javascript:void(0)"
                                                   class="nav-link nav-function btn btn-app">
                                                    <img src="/image/pdf.png" alt=""
                                                         style="max-width: 50px; max-height: 50px;">
                                                    <span style="font-size: 16px">Xuất PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <li class="nav-item">
                                            <a id="reset-btn" type="button" href="javascript:void(0)"
                                               class="nav-link nav-function btn btn-app">
                                                <img src="/image/reset.png" alt=""
                                                     style="max-width: 50px; max-height: 50px;">
                                                <span style="font-size: 16px">Đặt lại</span>
                                            </a>
                                        </li>
                                    </ul>
                                @endif
                            </nav>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

</main>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script src="/template/trang-chu.js"></script>
<script src="/template/dist/js/adminlte.min.js"></script>

@yield('script')


</body>

</html>
