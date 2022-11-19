<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $authors = ["Minh", "Hung", "Tien", "Giang", "Phuong"];
        for ($i=0; $i<5;$i++) {
            $blog = new Blog;
            $blog->setTitle("Blog " . ($i+1));
            $blog->setAuthor($authors[$i]);
            $blog->setContent("Greenwich University (Vietnam)");
            $blog->setDate(\DateTime::createFromFormat('Y-m-d','2022-05-27'));
            $manager->persist($blog);
        }

        $manager->flush();
    }
}
