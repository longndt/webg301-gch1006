<?php
class Book
{
   //attributes (thuộc tính)
   public $title;
   public $price;
   public $quantity;
   public $year;
   public $cover;
   public $author;

   //constructor - hàm tạo (tham số : parameters)
   //public function Book () {...}
   public function __construct($tieude, $giatien, $soluong, $namxuatban, $anhbia, $author)
   {
      $this->author = $author;
      $this->title = $tieude;
      $this->price = $giatien;
      $this->quantity = $soluong;
      $this->year = $namxuatban;
      $this->cover = $anhbia;
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