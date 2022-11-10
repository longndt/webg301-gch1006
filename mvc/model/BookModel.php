<?php
require_once("Book.php");

class BookModel
{
   //SQL: SELECT * FROM Book
   public function viewAllBook()
   {
      //tạo các object của Book bằng constructor
      $book1 = new Book("Java", 50.68, 25, 2020, "https://m.media-amazon.com/images/I/51EWRgaqIKL.jpg");
      $book2 = new Book("Python", 68.99, 30, 2021, "https://images-na.ssl-images-amazon.com/images/I/9122eE339dL.jpg");
      $book3 = new Book("Symfony", 55.23, 45, 2022, "https://m.media-amazon.com/images/I/71g7kbPZetL.jpg");

      //tạo array giả lập là dữ liệu của bảng Book trong database
      //index mặc định là số, bắt đầu từ 0
      // $bookList = array($book1, $book2, $book3); 
      //set index là chữ theo tiêu đề (title) của book
      $bookList = array(
         "Java" => $book1, "Python" => $book2, "Symfony" => $book3
      );
      return $bookList;
   }

   //SQL: SELECT * FROM Book WHERE title = '$title'
   public function viewBookByTitle($title)
   {
      //$this => class name (BookModel)
      $books = $this->viewAllBook();
      return $books[$title];
   }
}