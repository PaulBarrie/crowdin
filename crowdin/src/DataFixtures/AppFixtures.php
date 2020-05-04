<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Source;
use App\Entity\Translation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider($faker->imageUrl(200,200));
        $usr = new User();
        $usr->setFirstName('user')
            ->setLastName('user')
            ->setEmail('user@etna.com')
            ->setLangs(['fr', 'en', 'is', 'ar', 'es', 'fi', 'fo']);
        $manager->persist($usr);
        for ($i = 0; $i < 50 ; $i++) {
            $usr = new User();
            $langs = array();
            for($l = 0; $l < rand(1,3); $l++) {
                array_push($langs, $faker->languageCode);
            }
            $usr->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setPhone($faker->phoneNumber)
                ->setPassword($faker->bothify('##?##???#?##'))
                ->setLangs($langs)
                ->setPicture($faker->imageUrl(200, 200, true));
            $manager->persist($usr);
            for ($j=0; $j < rand(1, 5); $j++) {
                $project = new Project();
                $langs = array();
                for($l = 0; $l < rand(1,5); $l++) {
                    array_push($langs, $faker->languageCode);
                }
                $project->setName($faker->sentence(4))
                        ->setLang($faker->languageCode)
                        ->setDescription($faker->text(950))
                        ->setTargetLangs($langs)
                        ->setUser($usr)
                        ->setCreatedAt(new \DateTime());
                $manager->persist($project);
                for($k = 0; $k < rand(4,15); $k++){
                    $src = new Source();
                    $src->setProject($project)
                        ->setContent($faker->text(300))
                        ->setLockedTranslate(false);
                    $manager->persist($src);
                    for ($l = 0; $l < rand(1, 20); $l++) {
                        $trans = new Translation();
                        $trans
                            ->setLang($project->getLang()[0])
                            ->setSource($src)
                            ->setTranslateContent($faker->text)
                            ->setTranslatorId(rand(0, 50)); //inconsistency
                        $manager->persist($trans);
                    }

                }
            }
        }
        $manager->flush();
    }
}
