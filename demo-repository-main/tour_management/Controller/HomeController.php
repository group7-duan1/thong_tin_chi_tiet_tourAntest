<?php
class HomeController
{
    protected function render($view, $data = [])
    {
        extract($data);
        $view = 'auth/login';
        require_once PATH_VIEWS_MAIN;
    }

    protected function view_chucnang($folder, $page)
    {
        $view = $folder . '/dashboard';
        $into = 'chucnang/' . $page;
        require_once PATH_VIEWS_MAIN;
    }

    protected function print_infor($folder, $page, $data)
    {
        $view = $folder . '/dashboard';
        $into = 'chucnang/' . $page;
        require_once PATH_VIEWS_MAIN;
    }

    protected function redirect($url)
    {
        header("Location: " . BASE_URL . $url);
        exit();
    }



    public function bookingView()
    {
        $tourModel = new Tours();
        // SỬA: Gọi hàm lấy dữ liệu đầy đủ (bao gồm lịch trình, ảnh)
        $listTours = $tourModel->getAllToursWithDetails();

        $guideModel = new Guides();
        $listGuides = $guideModel->getAll_guides();

        $data = [
            'listTours' => $listTours,
            'listGuides' => $listGuides
        ];
        extract($data);

        $view = 'home/booking_form';
        require_once PATH_VIEWS_MAIN;
    }

    /**
     * Xử lý lưu đơn đặt tour vào Database khi khách nhấn nút
     */
    public function storeBooking()
    {
        if (isset($_POST['btn_book_tour'])) {
            $tour_id = $_POST['tour_id'];
            $guide_id = $_POST['guide_id'];         // Khách chọn HDV cụ thể
            $schedule_req = $_POST['schedule_req']; // Yêu cầu lộ trình riêng

            $booking_date = $_POST['start_date'];

            // Lấy số lượng người (Mặc định là 1 nếu không nhập)
            $people_count = $_POST['people_count'] ?? 1;

            // ID KHÁCH HÀNG
            // Giả định ID khách hàng là 1 (Nếu có session login thì dùng $_SESSION['user']['id'])
            $customer_id = 1;

            // --- GỌI MODEL LƯU VÀO DB ---
            $bookingModel = new Booking();

            // Gọi hàm create_booking với đúng thứ tự tham số đã sửa trong Model
            $bookingModel->create_booking(
                $customer_id,
                $tour_id,
                $guide_id,
                $schedule_req,
                $booking_date,
                $people_count
            );

            // Thông báo thành công và tải lại trang
            echo "<script>alert('Đặt tour và gửi yêu cầu thành công!'); window.location.href='index.php?controller=home&action=bookingView';</script>";
        }
    }
}
?>