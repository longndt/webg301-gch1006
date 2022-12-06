<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<15; $i++) {
            $author = new Author;
            $author->setName("Author $i")
                   ->setAddress("Viet Nam")
                   ->setImage("https://image.shutterstock.com/image-photo/confident-intelligence-grey-hair-senior-260nw-261010109.jpg")
                   ->setAge(rand(20,60));
            $manager->persist($author);
        }

        $manager->flush();
    }
}
