<?php
require_once ("./config/db.class.php");

class nhanvien{

    public $Ma_NV;
    public $Ten_NV;
    public $Phai;
    public $Noi_Sinh;
    public $Ma_Phong;
    public $Luong;
   


    public function __construct($manv,$tennv,$phai,$noisinh,$maphong,$luong){
        $this->Ma_NV = $manv;
        $this->Ten_NV = $tennv;
        $this->Phai = $phai;
        $this->Noi_Sinh = $noisinh;
        $this->Ma_Phong = $maphong;
        $this->Luong = $luong;
    }
    public function save(){
        $db=new Db();
        $sql = "INSERT INTO nhanvien(Ma_NV,Ten_NV,Phai,Noi_Sinh,Ma_Phong,Luong) VALUES
        ('$this->Ma_NV','$this->Ten_NV','$this->Phai','$this->Noi_Sinh','$this->Ma_Phong','$this->Luong')";
        $result = $db-> query_execute($sql);
        return $result;
    }
    public function update(){
        $db = new Db();
        $sql = "UPDATE nhanvien SET Ten_NV='$this->Ten_NV', Phai='$this->Phai', Noi_Sinh='$this->Noi_Sinh', Ma_Phong='$this->Ma_Phong', Luong='$this->Luong' WHERE Ma_NV='$this->Ma_NV'";
        $result = $db->query_execute($sql);
        return $result;          
    }
   
    public static function get(){
        $db = new Db();
        $sql = "SELECT * FROM nhanviwn";
        $result = $db->select_to_array($sql);
        return $result;
    }


    public function getbyID(){
        $db = new Db();
        $sql = "SELECT * FROM nhanvien WHERE Ma_NV='$this->Ma_NV'";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public function delete() {
        $db = new Db();
        $sql = "DELETE FROM nhanvien WHERE Ma_NV='$this->Ma_NV'";
        $result = $db->query_execute($sql);
        return $result;
    }
    
}
?>