<?php

namespace App\DataFixtures;

use App\Entity\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TodoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //create pre-defined list (array)
        $descriptions = ['Do homework', 'Go to market', 'Play football', 'Watch movie', 'Do housework'];
        $dates = ['2022/12/02', '2022/12/14', '2022/12/26', '2023/01/11', '2023/02/25'];
        $categories = ['Personal', 'Family', 'Study', 'Work'];
        
        for ($i=1; $i<=10; $i++) {
            //create random list index
            $des = array_rand($descriptions, 1);
            $dat = array_rand($dates, 1);
            $cat = array_rand($categories, 1);

            $todo = new Todo;
            $todo->setName("Todo $i")
                 ->setDescription($descriptions[$des])
                 ->setPriority(rand(1,5))
                 ->setCategory($categories[$cat])
                 ->setDuedate(\DateTime::createFromFormat('Y/m/d', $dates[$dat]));

            $manager->persist($todo);
        }

        $manager->flush();
    }
}
