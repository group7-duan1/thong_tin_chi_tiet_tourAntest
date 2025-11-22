<?php

class Guides extends BaseModel
{

    // Lấy toàn bộ danh sách HDV 
    function getAll_guides()
    {
        $sql = "
            SELECT u.*, g.phone, g.avatar_url, g.language_skill, g.experience_years, g.status
            FROM users u
            LEFT JOIN guides g ON u.user_id = g.user_id
            WHERE u.role = 'hdv'
        ";
        $guides = $this->queryWithParams($sql);
        return $guides;
    }

    // Lấy 1 HDV theo id
    function get_guides_byid($id)
    {
        $sql = "
            SELECT u.*, g.phone, g.avatar_url, g.language_skill, g.experience_years, g.status
            FROM users u
            LEFT JOIN guides g ON u.user_id = g.user_id
            WHERE u.role = 'hdv' AND u.user_id =?
        ";
        $guides = $this->queryOneWithParams($sql, [$id]);
        return $guides;


    }
}
