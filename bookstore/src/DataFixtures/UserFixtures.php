<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    //khởi tạo constructor để import thư viện UserPasswordHasherInterface (dùng để mã hóa mật khẩu)
    public function __construct(UserPasswordHasherInterface $hasherInterface)
    {
        $this->hasher = $hasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        //tạo tài khoản với ROLE_ADMIN
        $user = new User;
        $user->setUsername("admin");  //unique
        $user->setRoles(["ROLE_ADMIN"]); //security.yaml
        $user->setPassword($this->hasher->hashPassword($user,"123456"));  //__construct
        $manager->persist($user);

        //tạo tài khoản với ROLE_CUSTOMER
        $user = new User;
        $user->setUsername("customer");
        $user->setRoles(["ROLE_CUSTOMER"]);
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $manager->persist($user);

        $manager->flush();
    }
}
