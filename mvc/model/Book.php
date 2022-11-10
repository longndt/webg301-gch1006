<?php
class Book
{
   //attributes (thuộc tính)
   public $title;
   public $price;
   public $quantity;
   public $year;
   public $cover;

   //constructor - hàm tạo (tham số : parameters)
   //public function Book () {...}
   public function __construct($tieude, $giatien, $soluong, $namxuatban, $anhbia)
   {
      $title = $tieude;
      $price = $giatien;
      $quantity = $soluong;
      $year = $namxuatban;
      $cover = $anhbia;
   }

   //getter 
   public function getTitle()
   {
      return $this->title;
   }
   //setter
   public function setPrice($price)
   {
      $this->price = $price;
   }
}