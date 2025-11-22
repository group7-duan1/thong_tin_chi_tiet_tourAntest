<div class="container mt-4">
    <h3>Tạo Lộ Trình (Schedule)</h3>
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success')
        echo '<p style="color:green">Thêm thành công!</p>'; ?>

    <form action="index.php?controller=admin&action=storeSchedule" method="POST">
        <div class="mb-3">
            <label>Chọn Tour:</label>
            <select name="tour_id" class="form-control" required>
                <?php foreach ($listTours as $tour): ?>
                    <option value="<?= $tour['tour_id'] ?? $tour['id'] ?>">
                        <?= $tour['name'] ?? $tour['tour_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Ngày thứ:</label>
            <input type="number" name="day_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Địa điểm:</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Hoạt động (Logic):</label>
            <textarea name="activity" class="form-control"></textarea>
        </div>
        <button type="submit" name="btn_add_schedule" class="btn btn-primary">Lưu Lộ Trình</button>
    </form>
</div>