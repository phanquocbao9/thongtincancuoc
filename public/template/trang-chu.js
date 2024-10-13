let frontData = null;
let backData = null;

document.getElementById('imageFrontInput').addEventListener('change', function(event) {
    handleImageUpload(event, 'front');
    document.getElementById('frontInputGroup').style.display = 'none'; // Ẩn input file sau khi chọn
});

document.getElementById('imageBackInput').addEventListener('change', function(event) {
    handleImageUpload(event, 'back');
    document.getElementById('backInputGroup').style.display = 'none'; // Ẩn input file sau khi chọn
});

function handleImageUpload(event, side) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (side === 'front') {
                document.getElementById('imageFrontDiv').style.backgroundImage = `url(${e.target.result})`;
            } else {
                document.getElementById('imageBackDiv').style.backgroundImage = `url(${e.target.result})`;
            }
        };
        reader.readAsDataURL(file);

        const formData = new FormData();
        formData.append('image', file);

        // Gọi API
        fetch('https://api.fpt.ai/vision/idr/vnm', {
            method: 'POST',
            headers: {
                'api-key': '2a1ZbyB8FsQssb3OKJ8dMoGHDJ51lGb7'
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.errorCode === 0 && data.data.length > 0) {
                    const result = data.data[0];

                    if (side === 'front') {
                        frontData = {
                            name: result.name || 'Không có dữ liệu',
                            id: result.id || 'Không có dữ liệu',
                            dob: result.dob || 'Không có dữ liệu',
                            sex: result.sex || 'Không có dữ liệu',
                            nationality: result.nationality || 'Không có dữ liệu',
                            home: result.home || 'Không có dữ liệu',
                            address: result.address || 'Không có dữ liệu',
                            doe: result.doe || 'Không có dữ liệu'
                        };
                    } else {
                        backData = {
                            features: result.features || 'Không có dữ liệu',
                            issue_date: result.issue_date || 'Không có dữ liệu'
                        };
                    }

                    // Kiểm tra xem cả hai mặt đã có dữ liệu chưa
                    if (frontData && backData) {
                        displayData();
                    }
                } else {
                    alert('Không tìm thấy dữ liệu cho hình ảnh đã chọn.');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra khi gọi API.');
            });
    }
}

function formatDate(dateString) {
    const parts = dateString.split('/');
    // Kiểm tra độ dài và định dạng hợp lệ
    if (parts.length === 3) {
        return `${parts[2]}-${parts[1]}-${parts[0]}`; // Trả về định dạng YYYY-MM-DD
    }
    return dateString; // Nếu không hợp lệ, trả về giá trị gốc
}

function capitalizeFirstLetter(address) {
    return address.split(',').map(part => {
        return part.trim().split(' ').map(word => {
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        }).join(' ');
    }).join(', ');
}

function formatDescription(description) {
    // Chuyển thành chữ thường và sau đó viết hoa chữ cái đầu tiên
    const lowerCased = description.toLowerCase();

    // Viết hoa chữ cái đầu tiên
    const capitalized = lowerCased.charAt(0).toUpperCase() + lowerCased.slice(1);

    // Thay thế "c:" với "C:"
    const formatted = capitalized.replace(/c:/g, 'C:');

    return formatted;
}

function displayData() {
    // Cập nhật thông tin mặt trước
    document.getElementById('name').value = frontData.name;
    document.getElementById('id').value = frontData.id;
    document.getElementById('dob').value = formatDate(frontData.dob);
    document.getElementById('sex').value = capitalizeFirstLetter(frontData.sex.trim());
    document.getElementById('nationality').value = capitalizeFirstLetter(frontData.nationality.trim());
    document.getElementById('home').value = capitalizeFirstLetter(frontData.home.trim());
    document.getElementById('address').value = capitalizeFirstLetter(frontData.address.trim());
    document.getElementById('doe').value = formatDate(frontData.doe);

    // Cập nhật thông tin mặt sau
    document.getElementById('features').value = formatDescription(backData.features);
    document.getElementById('issue_date').value = formatDate(backData.issue_date);
}


