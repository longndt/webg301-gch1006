<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $covers = ['book1.jpg','book2.jpeg','book3.jpg'];
        for ($i=1; $i<=10; $i++) {
            $cover_random = array_rand($covers,1);
            $book = new Book;
            $book->setTitle("Book $i");
            $book->setAuthor("Greenwich");
            $book->setPrice((float)(rand(100,1000)));
            $book->setPublishDate(DateTime::createFromFormat('Y/m/d','2012/04/25'));
            $book->setCover($covers[$cover_random]);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
