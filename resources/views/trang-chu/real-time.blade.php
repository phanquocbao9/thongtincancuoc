@extends('trang-chu.trang-chu')

@section('content')
    <!-- Form Card -->
    <div class="card card-info">
        <div class="id-card-info" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
            <button id="start-camera" style="height: 67px; background: none; border: 0px; margin: 0px 20px;">
                <img src="\image\video-camera.png">
            </button>
            <video id="camera-stream" style="height: 300px;display: block;" autoplay playsinline poster="/image/warning.jpg"></video>

            <button id="stop-camera" style="height: 67px; background: none; border: 0px; margin: 0px 20px;">
                <img src="\image\video-close.png">
            </button>
        </div>
        <div class="id-card-info">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="cccd-form-qr">
                @csrf
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
    <script src="https://unpkg.com/jsqr/dist/jsQR.js"></script> <!-- Add this line -->

    <script>
        let videoStream = null;
        const videoElement = document.getElementById('camera-stream');
        const startButton = document.getElementById('start-camera');
        const stopButton = document.getElementById('stop-camera');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        // Function to start the camera
        function startCamera() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                    video: {
                        width: { ideal: 1920 },  // Độ phân giải chiều rộng
                        height: { ideal: 1080 }   // Độ phân giải chiều cao
                    }
                })
                    .then(function(stream) {
                        videoStream = stream;
                        videoElement.srcObject = stream;
                        videoElement.play();
                        setTimeout(() => requestAnimationFrame(scanQRCode), 1000);  // Quét mỗi 0.5 giây
                    })
                    .catch(function(err) {
                        alert("Không thể truy cập camera: " + err.message);
                    });
            } else {
                alert("Trình duyệt của bạn không hỗ trợ getUserMedia!");
            }
        }

        // Function to stop the camera
        function stopCamera() {
            if (videoStream) {
                let tracks = videoStream.getTracks();
                tracks.forEach(track => track.stop());
                videoElement.srcObject = null;
                videoStream = null;
            } else {
                alert("Camera chưa được bật.");
            }
        }

        // Function to scan QR code
        function scanQRCode() {
            if (videoStream && videoElement.videoWidth > 0 && videoElement.videoHeight > 0) {
                canvas.width = videoElement.videoWidth;
                canvas.height = videoElement.videoHeight;
                context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, canvas.width, canvas.height);

                if (code) {
                    console.log("Thông tin QR Code:", code.data)
                    stopCamera();
                } else {
                    console.log("Không tìm thấy mã QR.");
                }

                setTimeout(() => requestAnimationFrame(scanQRCode), 1000);  // Quét mỗi 1 giây


            } else {
                setTimeout(() => requestAnimationFrame(scanQRCode), 1000);  // Quét mỗi 1 giây


            }
        }

        startButton.addEventListener('click', startCamera);
        stopButton.addEventListener('click', stopCamera);
    </script>
@endsection



