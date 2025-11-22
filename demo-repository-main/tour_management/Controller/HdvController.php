<?php

class HdvController extends HomeController{
    public $Schedule;
    public $guides;
    public function __construct(){
        $this->Schedule = new Schedule;
        $this->guides = new Guides;
    }
    function dashboard(){
        $data = $this->guides->getAll_guides();
        print_r($data);
        
        $this->view_chucnang('guides','work');
    }
    function work_detail(){
        if(isset($_GET['id'])){
            $data=$this->guides($_GET['id']);
            print_r($data);
            
            $this->view_chucnang('guides','work_detail');
        }
    }
}
?>