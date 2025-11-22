<?php

class AdminController extends HomeController
{
    public $tours;
    public $guides;
    public function __construct()
    {
        $this->tours = new Tours;
        $this->guides = new Guides;
    }

    function dashboard()
    {

        $this->View_chucnang($folder = 'admin', $page = 'list_tour');
    }
    //danh sách huong dan viên
    function guides_manager()
    {
        $data = $this->guides->getAll_guides();
        $this->print_infor($folder = 'admin', $page = 'guides_manager', $data);
    }
    //chi tiết hướng dẫn viên
    function guides_detail()
    {
        if (isset($_GET['id'])) {
            $data = $this->guides->get_guides_byid($_GET['id']);
            // die;
            $this->print_infor($folder = 'admin', $page = 'guides_detail', $data);
        }
    }

    // 1. Hiển thị form thêm tour
    public function createTourView()
    {
        include 'Views/admin/chucnang/create_tour.php';
    }

    // 2. Xử lý lưu tour (bao gồm upload ảnh)
    public function storeTour()
    {
        if (isset($_POST['btn_add_tour'])) {

            // --- Xử lý Upload Ảnh ---
            $image_url = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "tour_management/assets/uploads/img/";
                // Tạo tên file duy nhất để tránh trùng
                $file_name = time() . "_" . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $file_name;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = $file_name; // Chỉ lưu tên file vào DB
                }
            }

            // --- Gọi Model lưu dữ liệu ---
            $tourModel = new Tours();
            $tourModel->add_tour(
                $_POST['name'],
                $_POST['category'],
                $_POST['price'],
                $_POST['description'],
                $_POST['itinerary'], // Lịch trình
                $_POST['policy'],    // Chính sách
                $_POST['provider'],  // Nhà cung cấp
                $image_url,          // Tên ảnh
                $_POST['start_date']
            );

            echo "<script>alert('Thêm tour thành công!'); window.location.href='index.php?controller=admin&action=dashboard';</script>";
        }
    }
}
?>