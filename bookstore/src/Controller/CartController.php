<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'add_to_cart')]
    public function addToCart(Request $request) 
    {
        $session = $request->getSession();
        $id = $request->get('bookid');
        $session->set('bookid',$id);
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        $session->set('book', $book);
        $quantity = $request->get('quantity');
        $session->set('quantity', $quantity);
        $date = date('Y/m/d');  //get current date
        $session->set('date', $date);
        $datetime = date('Y/m/d H:i:s'); //get current date + time
        $session->set('date', $date);
        $session->set('datetime', $datetime);
        $book_price = $book->getPrice();
        $order_price = $book_price * $quantity;
        $session->set('price', $order_price);
        $user = $this->getUser(); //get current user
        $session->set('user', $user);
        return $this->render('cart/cart.html.twig');
    }

    #[Route('/order', name: 'make_order')]
    public function makeOrder(Request $request, ManagerRegistry $managerRegistry) 
    {
        //khởi tạo session
        $session = new Session();

        //giảm quantity của book sau khi order
        $book = $this->getDoctrine()->getRepository(Book::class)->find($session->get('bookid'));
        $book_quantity = $book->getQuantity();
        $order_quantity = $session->get('quantity');
        $new_quantity = $book_quantity - $order_quantity;
        $book->setQuantity($new_quantity);

        //tạo object Order để lưu thông tin đơn hàng

        //set từng thuộc tính cho bảng Order 
        //VD: $order->setPrice()

        //dùng Manager để lưu object vào DB
        $manager = $managerRegistry->getManager();
        $manager->persist($book);
        $manager->flush();

        //gửi thông báo về view bằng addFlash
        $this->addFlash('Info', 'Order book successfully !');
  
        //redirect về trang book store
        return $this->redirectToRoute('book_list',
    );
    }
}
