<?php
require_once "model/BookModel.php";

class BookController
{
   private $model;

   public function __construct()
   {
      $this->model = new BookModel();
   }

   public function execute()
   {
      //Trường hợp 1 (homepage): load toàn bộ book list nếu người dùng không click vào tiêu đề của sách
      if (!isset($_GET['title'])) {
         //lấy dữ liệu từ hàm viewAllBook và lưu vào array
         $books = $this->model->viewAllBook();
         //render ra view BookList.php
         include_once "view/BookList.php";
         //Note: dữ liệu được gửi kèm khi render ra view
      }
      //Trường hợp 2: người dùng click vào tiêu đề của sách => hiển thị thông tin của quyển sách đấy
      else {
         //lấy title từ URL (dường dẫn của web)
         $title = $_GET['title'];
         //tạo object book để lưu dữ liệu từ hàm viewBookByTitle
         $book = $this->model->viewBookByTitle($title);
         //render ra view BookDetail.php
         include_once "view/BookDetail.php";
      }
   }
}