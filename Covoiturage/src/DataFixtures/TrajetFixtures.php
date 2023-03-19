<?php

namespace App\DataFixtures;

use App\Entity\Trajet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\UserFixtures;
use Faker\Factory;

class TrajetFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create("fr_FR");
        for ($i = 1; $i < 5; $i++) {
            $trajet1 = new Trajet();
            $trajet1->setVilleDepart($faker->city)
                ->setDateArrive(new \DateTime('+3 days'))
                ->setPlaceDispo($faker->numberBetween(1, 7))
                ->setVilleArrive($faker->city)
                ->setDateDepart(new \DateTime('+2 days'))
                ->setConducteur($manager->merge($this->getReference("user1")));
            $manager->persist($trajet1);

            $manager->flush();
        }
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ReservationFixtures::class,
            CommentaireFixtures::class,
        ];
    }
}
