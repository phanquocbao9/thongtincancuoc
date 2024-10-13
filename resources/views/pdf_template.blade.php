<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Căn Cước</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Thông Tin Căn Cước</h1>
<p><strong>Số:</strong> {{ $id }}</p>
<p><strong>Họ và tên:</strong> {{ $name }}</p>
<p><strong>Ngày sinh:</strong> {{ $dob }}</p>
<p><strong>Giới tính:</strong> {{ $sex }}</p>
<p><strong>Quốc tịch:</strong> {{ $nationality }}</p>
<p><strong>Quê quán:</strong> {{ $home }}</p>
<p><strong>Nơi thường trú:</strong> {{ $address }}</p>
<p><strong>Đặc điểm nhận dạng:</strong> {{ $features }}</p>
<p><strong>Ngày cấp:</strong> {{ $issue_date }}</p>
<p><strong>Ngày hết hạn:</strong> {{ $doe }}</p>
</body>
</html>

