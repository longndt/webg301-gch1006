<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=5; $i++) {
            $genre = new Genre;
            $genre->setName("Genre $i")
                ->setImage("https://img.freepik.com/premium-vector/retro-science-education-background_23-2148476365.jpg?w=2000");
            $manager->persist($genre);
        }

        $manager->flush();
    }
}
