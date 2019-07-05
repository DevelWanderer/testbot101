<?php
defined('testbot101/tree/master/controllers')  OR exit('No direct script access allowed');
 ;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

class Img extends CI_Controller {

    public function __construct()
    {
            parent::__construct();

    }
    public function index()
    {
        // สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
        $manager = new ImageManager();

        // ทดสอบสร้างรูปขนาด 200x200 พื้นหลังสีแดง
        $img = $manager->canvas(200, 200, '#ff0000');

        // ส่ง HTTP header และข้อมูลของรูปเพื่อนำไปแสดง
        echo $img->response();

    }

}
