<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Tour & Chi Tiết Lịch Trình</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { background-color: #f4f7f6; }
        .card-header { background: #003b95; color: white; font-weight: bold; text-transform: uppercase; }
        
        /* KHUNG HIỂN THỊ CHI TIẾT (Mặc định ẩn) */
        #detail_container {
            display: none; 
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        /* Phần Ảnh Gallery */
        .main-img-box {
            width: 100%; height: 300px; overflow: hidden; border-radius: 5px; margin-bottom: 10px; border: 1px solid #ddd;
        }
        .main-img-box img { width: 100%; height: 100%; object-fit: cover; }
        
        .thumb-box { display: flex; gap: 5px; overflow-x: auto; padding-bottom: 5px; }
        .thumb-img {
            width: 80px; height: 60px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 2px solid transparent;
        }
        .thumb-img:hover, .thumb-img.active { border-color: #003b95; opacity: 0.8; }

        /* Phần Lịch Trình (Timeline) */
        .schedule-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 20px;
            border-left: 2px solid #e9ecef;
        }
        .schedule-item::before {
            content: "\f017"; /* Icon đồng hồ */
            font-family: "Font Awesome 6 Free"; font-weight: 900;
            position: absolute; left: -9px; top: 0;
            background: #fff; color: #28a745; font-size: 14px;
        }
        .day-badge {
            background: #003b95; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px; display: inline-block;
        }
        .sch-time { color: #dc3545; font-weight: bold; margin-right: 5px; }
        .sch-loc { color: #003b95; font-weight: bold; }

        /* Tabs */
        .nav-tabs .nav-link { color: #555; font-weight: 600; }
        .nav-tabs .nav-link.active { color: #003b95; border-bottom: 3px solid #003b95; }
        
        /* Giá tiền */
        .price-tag { font-size: 1.2rem; font-weight: bold; color: #d63031; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header py-3">
                    <i class="fas fa-suitcase"></i> Form Đặt Tour & Xem Chi Tiết
                </div>
                <div class="card-body p-4">
                    
                    <form action="index.php?controller=home&action=storeBooking" method="POST">
                        
                        <h5 class="text-primary mb-3"><i class="fas fa-search"></i> 1. Chọn Tour</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Loại hình Tour:</label>
                                <select id="category_select" class="form-select" onchange="filterTours()">
                                    <option value="">-- Tất cả loại hình --</option>
                                    <option value="trong_nuoc">Tour Trong Nước</option>
                                    <option value="quoc_te">Tour Quốc Tế</option>
                                    <option value="theo_yeu_cau">Tour Theo Yêu Cầu</option>
                                </select>
                            </div>
                            <div class="col-md-6" id="tour_select_div">
                                <label class="form-label fw-bold">Chọn Tour cụ thể:</label>
                                <select name="tour_id" id="tour_select" class="form-select" onchange="renderTourDetails()" required>
                                    <option value="">-- Vui lòng chọn loại hình trước --</option>
                                </select>
                            </div>
                        </div>

                        <div id="detail_container">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="main-img-box">
                                        <img id="view_main_img" src="" alt="Ảnh Tour">
                                    </div>
                                    <div id="view_gallery" class="thumb-box">
                                        </div>
                                </div>

                                <div class="col-md-7">
                                    <h3 id="view_name" class="text-primary fw-bold mb-2"></h3>
                                    
                                    <div class="mb-3 p-2 bg-light rounded">
                                        <div class="row">
                                            <div class="col-6">
                                                <small>Giá Người lớn:</small><br>
                                                <span id="view_price_adult" class="price-tag">0</span> <small>đ</small>
                                            </div>
                                            <div class="col-6">
                                                <small>Giá Trẻ em:</small><br>
                                                <span id="view_price_child" class="price-tag">0</span> <small>đ</small>
                                            </div>
                                        </div>
                                        <div class="mt-2 small text-muted">
                                            <i class="fas fa-check-circle text-success"></i> <strong>Bao gồm:</strong> <span id="view_provider"></span>
                                        </div>
                                    </div>

                                    <ul class="nav nav-tabs" id="infoTabs" role="tablist">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab_schedule" type="button">
                                                <i class="fas fa-list-alt"></i> Lịch trình chi tiết
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab_policy" type="button">
                                                <i class="fas fa-shield-alt"></i> Chính sách
                                            </button>
                                        </li>
                                    </ul>

                                    <div class="tab-content p-3 border border-top-0" style="height: 250px; overflow-y: auto;">
                                        <div class="tab-pane fade show active" id="tab_schedule">
                                            <div id="view_schedule_list">
                                                </div>
                                        </div>
                                        
                                        <div class="tab-pane fade" id="tab_policy">
                                            <p id="view_policy" style="white-space: pre-line;"></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>

                        <h5 class="text-primary mb-3 mt-4"><i class="fas fa-pen-square"></i> 2. Thông tin đặt chỗ</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Ngày khởi hành dự kiến:</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Số lượng khách:</label>
                                <input type="number" name="people_count" class="form-control" value="1" min="1" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Chọn HDV (Nếu cần):</label>
                                <select name="guide_id" class="form-select">
                                    <option value="0">-- Ngẫu nhiên --</option>
                                    <?php foreach($listGuides as $guide): ?>
                                        <option value="<?= $guide['user_id'] ?>">
                                            <?= $guide['full_name'] ?> (<?= $guide['experience_years'] ?? '1' ?> năm KN)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Ghi chú / Yêu cầu đặc biệt:</label>
                            <textarea name="schedule_req" id="schedule_req" class="form-control" rows="3" 
                                placeholder="Ví dụ: Tôi ăn chay, cần đón tại sân bay lúc 8h... (Nếu chọn tour thiết kế riêng, vui lòng ghi rõ yêu cầu tại đây)"></textarea>
                        </div>

                        <button type="submit" name="btn_book_tour" class="btn btn-success w-100 py-3 text-uppercase fw-bold fs-5 shadow">
                            <i class="fas fa-check-circle"></i> Xác Nhận Đặt Tour
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Lấy dữ liệu JSON từ PHP
        const toursData = <?php echo json_encode($listTours); ?>;
        
        // Đường dẫn ảnh (Sửa lại nếu folder của bạn khác)
        const imgBaseUrl = "tour_management/assets/uploads/img/"; 
        const defaultImg = "https://via.placeholder.com/400x300?text=No+Image";

        // 1. Lọc Tour theo danh mục
        function filterTours() {
            const cat = document.getElementById('category_select').value;
            const select = document.getElementById('tour_select');
            const container = document.getElementById('tour_select_div');
            const detailBox = document.getElementById('detail_container');
            const note = document.getElementById('schedule_req');

            // Reset
            select.innerHTML = '<option value="">-- Chọn Tour --</option>';
            detailBox.style.display = 'none';

            if (cat === 'theo_yeu_cau') {
                // Ẩn chọn tour, bắt buộc nhập ghi chú
                container.style.display = 'none';
                select.removeAttribute('required');
                note.setAttribute('required', 'required');
                note.placeholder = "Vui lòng mô tả chi tiết: Điểm đến? Thời gian? Ngân sách? Để chúng tôi thiết kế riêng cho bạn.";
            } else {
                // Hiện chọn tour
                container.style.display = 'block';
                select.setAttribute('required', 'required');
                note.removeAttribute('required');
                note.placeholder = "Ghi chú thêm (nếu có)...";

                // Đổ dữ liệu vào dropdown
                toursData.forEach(t => {
                    if (!cat || t.category === cat) {
                        let opt = document.createElement('option');
                        opt.value = t.tour_id || t.id;
                        opt.text = t.name || t.tour_name;
                        // Lưu data vào option để dùng sau
                        opt.dataset.info = JSON.stringify(t);
                        select.appendChild(opt);
                    }
                });
            }
        }

        // 2. Hiển thị chi tiết khi chọn Tour
        function renderTourDetails() {
            const select = document.getElementById('tour_select');
            const detailBox = document.getElementById('detail_container');
            const opt = select.options[select.selectedIndex];

            // Nếu chưa chọn hoặc không có dữ liệu
            if (!opt.value || !opt.dataset.info) {
                detailBox.style.display = 'none';
                return;
            }

            // Parse dữ liệu từ JSON
            const t = JSON.parse(opt.dataset.info);

            // --- A. ĐIỀN THÔNG TIN CƠ BẢN ---
            document.getElementById('view_name').innerText = t.name || t.tour_name;
            document.getElementById('view_price_adult').innerText = new Intl.NumberFormat('vi-VN').format(t.price_adult || 0);
            document.getElementById('view_price_child').innerText = new Intl.NumberFormat('vi-VN').format(t.price_child || 0);
            document.getElementById('view_provider').innerText = t.provider_info || 'Công ty tổ chức';
            document.getElementById('view_policy').innerText = t.policy_cancel || 'Chưa có thông tin chính sách.';

            // --- B. XỬ LÝ ẢNH (GALLERY) ---
            // Ảnh chính
            document.getElementById('view_main_img').src = t.image_url ? (imgBaseUrl + t.image_url) : defaultImg;
            
            // Ảnh nhỏ (Gallery)
            const galDiv = document.getElementById('view_gallery');
            galDiv.innerHTML = ''; // Xóa ảnh cũ
            
            // Nếu có gallery, hiện ra
            if (t.gallery && t.gallery.length > 0) {
                // Thêm ảnh chính vào list luôn
                if(t.image_url) t.gallery.unshift(t.image_url); 
                
                // Loại bỏ trùng lặp
                let uniqueImages = [...new Set(t.gallery)];

                uniqueImages.forEach(src => {
                    let img = document.createElement('img');
                    img.src = imgBaseUrl + src;
                    img.className = 'thumb-img';
                    img.onclick = function() {
                        document.getElementById('view_main_img').src = this.src;
                    };
                    galDiv.appendChild(img);
                });
            }

            // --- C. XỬ LÝ LỊCH TRÌNH (SCHEDULE) ---
            const schDiv = document.getElementById('view_schedule_list');
            schDiv.innerHTML = ''; // Xóa cũ

            if (t.schedules && t.schedules.length > 0) {
                t.schedules.forEach(s => {
                    let html = `
                        <div class="schedule-item">
                            <span class="day-badge">Ngày ${s.day_num}</span>
                            <div>
                                <i class="far fa-clock"></i> <span class="sch-time">${s.time_start || '--:--'}</span> 
                                tại <span class="sch-loc">${s.location}</span>
                            </div>
                            <p class="mt-1 mb-0 text-secondary">${s.activity}</p>
                        </div>
                    `;
                    schDiv.innerHTML += html;
                });
            } else {
                schDiv.innerHTML = '<div class="alert alert-info">Lịch trình chi tiết đang được cập nhật. Vui lòng liên hệ để biết thêm.</div>';
            }

            // Hiện khung chi tiết lên
            detailBox.style.display = 'block';
        }
    </script>

</body>
</html>