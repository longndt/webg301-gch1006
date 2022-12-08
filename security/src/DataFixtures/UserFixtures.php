<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->hasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        //tạo tài khoản demo cho role Admin
        $user1 = new User;
        $user1->setUsername('admin');
        //set role theo role name đã tạo trong file security.yaml
        $user1->setRoles(["ROLE_ADMIN"]);
        //sử dụng thư viện UserPasswordHasherInterface để mã hóa mật khẩu trước khi lưu vào DB
        $user1->setPassword($this->hasher->hashPassword($user1, "123456"));
        $manager->persist($user1);

        //tạo tài khoản demo cho role User  
        $user2 = new User;
        $user2->setUsername('user');
        $user2->setRoles(["ROLE_USER"]);
        $user2->setPassword($this->hasher->hashPassword($user2, "123456"));
        $manager->persist($user2);

        $manager->flush();
    }
}
