<?php

namespace App\DataFixtures;

use App\Entity\Actuality\Actuality;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= 9; $i++) {
            $actuality = new Actuality();
            $actuality->setTitle($faker->sentence(mt_rand(6, 12)))
                ->setContent($faker->realText(mt_rand(400, 800)))
                ->setImage("https://picsum.photos/id/$i/1920/1024");

            $manager->persist($actuality);
        }

        $manager->flush();
    }
}
