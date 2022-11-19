<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //tạo object cho entity Employee
        $employee = new Employee;

        //set giá trị cho các attribute của object
        //(add dữ liệu cho từng cột trong bảng)
        $employee->setName("Minh");
        $employee->setBirthday(\DateTime::createFromFormat('Y-m-d','1995-05-25'));
        $employee->setMobile("0912345678");
        $employee->setExperiencedyear(5);
        $employee->setImage("https://www.glassdoor.com/employers/app/uploads/sites/2/2018/09/resources-benefits-employees-want-most-min-768x483-1-e1540508225245.jpg?x60772");
        $employee->setMarried(true);
        $employee->setSalary(999.99);

        //add dữ liệu vào DB thông qua ObjectManager
        $manager->persist($employee);

        //confirm việc add dữ liệu
        $manager->flush();
    }
}
