<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create("fr_FR");
        for($i = 1; $i < 5; $i++) {
            $user1 = new User();
            $user1->setEmail($faker->email)
                ->setNom($faker->firstName)
                ->setPrenom($faker->lastName)
                ->setTelephone($faker->phoneNumber)
                ->setMotDePasse($faker->password(6, 10));
            $manager->persist($user1);

            $manager->flush();

            $this->setReference("user1",$user1);

        }
    }
}
