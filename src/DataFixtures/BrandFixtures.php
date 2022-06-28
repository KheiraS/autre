<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Brand for Food
        $franklin = new Brand();
        $franklin -> setName('Franklin');
        $franklin -> setLogo('franklin_logo.png');
        $this->addReference('Franklin',$franklin);
        $manager->persist($franklin);

        $lilysKitchen = new Brand();
        $lilysKitchen -> setName('Lily\'s Kitchen');
        $lilysKitchen -> setLogo('lilys_Kitchen_logo.png');
        $this->addReference('Lily\'s Kitchen',$lilysKitchen);
        $manager->persist($lilysKitchen);

        $wolfood = new Brand();
        $wolfood -> setName('Wolfood');
        $wolfood -> setLogo('wolfood_logo.png');
        $this->addReference('Wolfood',$wolfood);
        $manager->persist($wolfood);


        //Brand for Accesories & clothes
        $labbvenn = new Brand();
        $labbvenn -> setName('Labbvenn');
        $labbvenn -> setLogo('labbvenn_logo.png');
        $this->addReference('Labbvenn',$labbvenn);
        $manager->persist($labbvenn);

        $miacara = new Brand();
        $miacara -> setName('Miacara');
        $miacara -> setLogo('miacara_logo.png');
        $this->addReference('Miacara',$miacara);
        $manager->persist($miacara);

        $milkPepper = new Brand();
        $milkPepper -> setName('Milk & Pepper');
        $milkPepper -> setLogo('milk_pepper_logo.jpg');
        $this->addReference('Milk & Pepper',$milkPepper);
        $manager->persist($milkPepper);

        $purrsToys = new Brand();
        $purrsToys -> setName('Purrs Toys');
        $purrsToys -> setLogo('purrs_toys_logo.png');
        $this->addReference('Purrs Toys',$purrsToys);
        $manager->persist($purrsToys);


        //Brand for Health & Care

        $biogance = new Brand();
        $biogance -> setName('Biogance');
        $biogance -> setLogo('biogance_logo.png');
        $this->addReference('Biogance',$biogance);
        $manager->persist($biogance);

        $biovetol = new Brand();
        $biovetol -> setName('Biovetol');
        $biovetol -> setLogo('biovetol_logo.png');
        $this->addReference('Biovetol',$biovetol);
        $manager->persist($biovetol);

        $nellumbo = new Brand();
        $nellumbo -> setName('Nellumbo');
        $nellumbo -> setLogo('nellumbo_logo.png');
        $this->addReference('Nellumbo',$nellumbo);
        $manager->persist($nellumbo);
        $manager->flush();

        $manager->flush();
    }
}
