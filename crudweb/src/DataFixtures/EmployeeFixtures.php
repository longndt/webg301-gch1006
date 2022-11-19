<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //tạo array chứa danh sách các sample data (dữ liệu mẫu)
        $mobile_list = array("0912345678","098888888","0986868686","0919191919","0999999999");
        $image_list = array("https://www.glassdoor.com/employers/app/uploads/sites/2/2018/09/resources-benefits-employees-want-most-min-768x483-1-e1540508225245.jpg?x60772",
            "https://www.camc.org/sites/default/files/styles/800x600/public/2020-09/employee%20wellness%20center_hero.jpg?itok=9qCcPtUE",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX4naXrz54QB7OAkfopQstQ2gcedBNF38WOXm5whlQ5-OMZnVuBXnPWsnwr03tGFcAq1A&usqp=CAU",
            "https://images.startups.co.uk/wp-content/uploads/2017/06/Job-offer-new-employee-1.jpg?width=709&height=460&fit=crop",
            "https://www.hubspot.com/hubfs/employee-retention-rate.jpg");

        //dùng vòng lặp for để add dữ liệu với số lượng mong muốn
        for ($i = 1; $i <= 30; $i++) {
            //get random index từ array
            $mob = array_rand($mobile_list,1);
            $img = array_rand($image_list,1);


            //tạo object cho entity Employee
            $employee = new Employee;

            //set giá trị cho các attribute của object
            //(add dữ liệu cho từng cột trong bảng)
            $employee->setName("Employee $i");
            $employee->setBirthday(\DateTime::createFromFormat('Y-m-d', '1995-05-25'));
            $employee->setMobile($mobile_list[$mob]);
            $employee->setExperiencedyear(rand(0,20));
            $employee->setImage($image_list[$img]);
            $employee->setMarried(true);
            $employee->setSalary((float)(rand(500,5000)));

            //add dữ liệu vào DB thông qua ObjectManager
            $manager->persist($employee);
        }

        //confirm việc add dữ liệu
        $manager->flush();
    }
}
