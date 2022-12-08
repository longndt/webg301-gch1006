<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $titles = ["Java", "NET", "Python", "PHP", "ReactJS", "Spring"];

        for ($i=1; $i<=20; $i++) {
            $key = array_rand($titles,1);
            $book = new Book;
            $book->setTitle($titles[$key])
                 ->setQuantity(rand(10,100)) 
                 ->setPrice((float)(rand(100,1000))) 
                 ->setImage("book.jpg")
                 ->setDate(\DateTime::createFromFormat('Y/m/d','2022/05/25'));
            $manager->persist($book);     
        }

        $manager->flush();
    }
}
