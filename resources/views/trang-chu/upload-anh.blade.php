@extends('trang-chu.trang-chu')

@section('content')
    <!-- Form Card -->
    <div class="card card-info">
        <div class="id-card-info">
            <!-- Hiển thị ảnh mặt trước và mặt sau -->
            <form id="cccd-form" action="{{ route('addCCCD') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="id-card-info">
                    <div class="id-card-image">
                        <!-- Ảnh mặt trước -->
                        <div class="image-cccd" id="imageFrontDiv" style="background-size: cover;">
                            <!-- Chọn ảnh mặt trước -->
                            <div class="input-group mb-3" id="frontInputGroup"
                                 style="margin: 0px !important;">
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input"
                                           id="imageFrontInput" name="imageFront">
                                    <label class="custom-file-label" for="imageFrontInput"><i
                                            class="fi fi-rr-clip"></i> Chọn ảnh mặt trước</label>
                                </div>
                            </div>
                        </div>

                        <!-- Ảnh mặt sau -->
                        <div class="image-cccd" id="imageBackDiv" style="background-size: cover;">
                            <!-- Chọn ảnh mặt sau -->
                            <div class="input-group mb-3" id="backInputGroup"
                                 style="margin: 0px !important;">
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input"
                                           id="imageBackInput" name="imageBack">
                                    <label class="custom-file-label" for="imageBackInput"><i
                                            class="fi fi-rr-clip"></i> Chọn ảnh mặt sau</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Họ và tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="">
                        </div>
                    </div>
                    <div class="row" style="margin: 0px;justify-content: space-between;">
                        <div class="form-group row" style="flex-basis: 51%;">
                            <label for="id" class="col-sm-6 col-form-label">Số CCCD</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="id" name="id" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" style="flex-basis: 51%;justify-content: end;">
                            <label for="dob" class="col-sm-4 col-form-label">Ngày sinh</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="dob" name="dob" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 0px;justify-content: space-between;">
                        <div class="form-group row" style="flex-basis: 51%;">
                            <label for="sex" class="col-sm-6 col-form-label">Giới tính</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="sex" name="sex" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" style="flex-basis: 51%;justify-content: end;">
                            <label for="nationality" class="col-sm-4 col-form-label">Quốc tịch</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="home" class="col-sm-3 col-form-label">Quê quán</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="home" name="home" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Nơi thường trú</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="address" name="address" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="features" class="col-sm-3 col-form-label">Đặc điểm nhận dạng</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="features" name="features" placeholder="">
                        </div>
                    </div>
                    <div class="row" style="margin: 0px;justify-content: space-between;">
                        <div class="form-group row" style="flex-basis: 51%;">
                            <label for="issue_date" class="col-sm-6 col-form-label">Ngày cấp</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="issue_date" name="issue_date" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" style="flex-basis: 51%;justify-content: end;">
                            <label for="doe" class="col-sm-4 col-form-label">Có giá trị đến</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="doe" name="doe" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            //Lưu thông tin
            document.getElementById('save-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Ngăn chặn form gửi theo cách truyền thống

                var form = document.getElementById('cccd-form');
                var formData = new FormData(form);

                fetch("{{ route('addCCCD') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hiển thị thông báo khi thêm thành công
                            Toast.fire({
                                icon: 'success',
                                title: 'Thêm thông tin thành công'
                            });

                            // setTimeout(() => {
                            //     location.reload();
                            // }, 2000);
                        } else {
                            // Hiển thị thông báo lỗi nếu id_cccd đã tồn tại
                            Toast.fire({
                                icon: 'error',
                                title: 'Thông tin đã có trong hệ thống' // Thông báo lỗi trùng lặp
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            // Xuất file Word
            document.getElementById('export-word-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Ngăn không cho trang reload

                var form = document.getElementById('cccd-form');
                var formData = new FormData(form);

                fetch("{{ route('exportToWord') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.blob())
                    .then(blob => {
                        // Tạo URL tạm thời cho file và tải xuống
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'ThongTinCanCuoc.docx'; // Tên file bạn muốn tải
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url); // Giải phóng tài nguyên
                    })
                    .catch(error => console.error('Lỗi:', error));
            });

            // Xuất file Excel
            document.getElementById('export-excel-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Ngăn không cho trang reload

                var form = document.getElementById('cccd-form');
                var formData = new FormData(form);

                fetch("{{ route('exportToExcel') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.blob())
                    .then(blob => {
                        // Tạo URL tạm thời cho file và tải xuống
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'ThongTinCanCuoc.xlsx'; // Tên file bạn muốn tải
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url); // Giải phóng tài nguyên
                    })
                    .catch(error => console.error('Lỗi:', error));
            });

            // Xuất file PDF
            document.getElementById('export-pdf-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Ngăn không cho trang reload

                var form = document.getElementById('cccd-form');
                var formData = new FormData(form);

                fetch("{{ route('exportToPDF') }}", {
                    method: 'POST', // Sử dụng phương thức POST
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'ThongTinCanCuoc.pdf'; // Tên file tải xuống
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url); // Giải phóng tài nguyên
                    })
                    .catch(error => console.error('Lỗi:', error));
            });

            // Đặt lại
            document.getElementById('reset-btn').addEventListener('click', function (event) {
                location.reload();
            });
        });
    </script>
@endsection
