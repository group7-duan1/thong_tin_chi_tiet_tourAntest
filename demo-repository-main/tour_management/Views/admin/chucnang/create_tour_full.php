<div class="container mt-4 pb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-plus-circle"></i> Thêm Tour Mới (Full Chức Năng)</h4>
        </div>
        <div class="card-body">
            <form action="index.php?controller=admin&action=storeTourFull" method="POST" enctype="multipart/form-data">
                
                <h5 class="text-primary border-bottom pb-2">1. Thông tin chung</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Tên Tour:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Danh mục:</label>
                        <select name="category" class="form-control">
                            <option value="trong_nuoc">Trong nước</option>
                            <option value="quoc_te">Quốc tế</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Ngày khởi hành:</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                </div>

                <h5 class="text-primary border-bottom pb-2 mt-4">2. Giá & Chính sách</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Giá người lớn (VNĐ):</label>
                        <input type="number" name="price_adult" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Giá trẻ em (VNĐ):</label>
                        <input type="number" name="price_child" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Nhà cung cấp:</label>
                        <input type="text" name="provider_info" class="form-control" placeholder="Vietnam Airlines, Sun Group...">
                    </div>
                </div>
                <div class="mb-3">
                    <label>Chính sách hủy/hoàn:</label>
                    <textarea name="policy_cancel" class="form-control" rows="2"></textarea>
                </div>

                <h5 class="text-primary border-bottom pb-2 mt-4">3. Hình ảnh</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Ảnh đại diện (1 ảnh):</label>
                        <input type="file" name="main_image" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Bộ sưu tập ảnh (Nhiều ảnh):</label>
                        <input type="file" name="gallery[]" class="form-control" multiple>
                    </div>
                </div>

                <h5 class="text-primary border-bottom pb-2 mt-4">
                    4. Lịch trình chi tiết 
                    <button type="button" class="btn btn-sm btn-success float-end" onclick="addScheduleRow()">+ Thêm ngày</button>
                </h5>
                <div id="schedule_container">
                    <div class="row mb-2 schedule-row">
                        <div class="col-md-1">
                            <input type="number" name="sch_day[]" class="form-control" placeholder="Ngày" value="1">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="sch_time[]" class="form-control" placeholder="Giờ (08:00)">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="sch_loc[]" class="form-control" placeholder="Địa điểm">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="sch_act[]" class="form-control" placeholder="Hoạt động chi tiết...">
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" name="btn_save_full" class="btn btn-primary btn-lg w-100">LƯU TOUR</button>
            </form>
        </div>
    </div>
</div>

<script>
function addScheduleRow() {
    const div = document.createElement('div');
    div.className = 'row mb-2 schedule-row';
    div.innerHTML = `
        <div class="col-md-1"><input type="number" name="sch_day[]" class="form-control" placeholder="Ngày"></div>
        <div class="col-md-2"><input type="text" name="sch_time[]" class="form-control" placeholder="Giờ"></div>
        <div class="col-md-3"><input type="text" name="sch_loc[]" class="form-control" placeholder="Địa điểm"></div>
        <div class="col-md-6"><input type="text" name="sch_act[]" class="form-control" placeholder="Hoạt động..."></div>
    `;
    document.getElementById('schedule_container').appendChild(div);
}
</script>