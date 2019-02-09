<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Human;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SampleDataFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $animal = new Animal();
            $animal->setType($faker->word)
                ->setName($faker->firstNameMale)
                ->setDescription($faker->text)
                ->setGender($faker->randomElement(['male', 'female']))
                ->setAge($faker->randomDigitNotNull)
                ->setBreed($faker->word)
                ->setWeight($faker->numerify('##'))
            ;
            $manager->persist($animal);

            $human = new Human();
            $human->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setAge($faker->numerify('##'))
                ->setHeight($faker->numerify('1##'))
                ->setWeight($faker->numberBetween(40, 120))
                ->setGender($faker->randomElement(['male', 'female']))
                ->setDob($faker->dateTimeBetween('-100 years', 'now'))
            ;
            $manager->persist($human);
        }
        $manager->flush();
    }
}
