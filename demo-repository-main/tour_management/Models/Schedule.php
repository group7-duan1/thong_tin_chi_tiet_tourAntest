<?php
class Schedule extends BaseModel
{

    // Lấy lộ trình theo tour_id
    public function get_schedule_by_tour($tour_id)
    {
        $sql = "SELECT * FROM schedules WHERE tour_id = ? ORDER BY day_number ASC";
        return $this->queryWithParams($sql, [$tour_id]);
    }

    // Tạo lộ trình mới
    public function create_schedule($tour_id, $day_number, $location, $activity)
    {
        $sql = "INSERT INTO schedules (tour_id, day_number, location, activity) 
                VALUES (?, ?, ?, ?)";
        return $this->queryWithParams($sql, [$tour_id, $day_number, $location, $activity]);
    }
}
?>