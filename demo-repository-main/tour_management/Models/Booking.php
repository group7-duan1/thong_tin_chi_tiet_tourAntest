<?php
class Booking extends BaseModel
{

    // Hàm tạo đơn đặt tour mới
    public function create_booking($customer_id, $tour_id, $guide_id, $schedule_request, $booking_date, $people_count)
    {


        $sql = "INSERT INTO bookings (customer_id, tour_id, guide_id, custom_schedule, booking_date, people_count, status) 
                VALUES (?, ?, ?, ?, ?, ?, 'Chờ xác nhận')";

        return $this->queryWithParams($sql, [
            $customer_id,
            $tour_id,
            $guide_id,
            $schedule_request,
            $booking_date,
            $people_count
        ]);
    }
}
?>