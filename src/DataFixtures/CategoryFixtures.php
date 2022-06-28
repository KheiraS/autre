<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Category_Parent for Pets
        $categoryDog = new Category();
        $categoryDog->setName("Chien");
        $this->addReference('Chien', $categoryDog);

        $categoryCat = new Category();
        $categoryCat->setName("Chat");
        $this->addReference('Chat', $categoryCat);

        //Category_Enfant

        /*
         * CATEGORY FOOD
         * */
        $categoryDogFood = new Category();
        $categoryDogFood->setName("Alimentation_chien");
        $categoryDogFood->setParent($categoryDog);
        $this->addReference('Alimentation_chien', $categoryDogFood);


        $categoryCatFood = new Category();
        $categoryCatFood->setName("Alimentation");
        $categoryCatFood->setParent($categoryCat);
        $this->addReference('Alimentation_chat', $categoryCatFood);

        /*
         * CATEGORY ACCESSORIES
         * */
        $categoryDogAccessories = new Category();
        $categoryDogAccessories->setName("Accessoires_chien");
        $categoryDogAccessories->setParent($categoryDog);
        $this->addReference('Accessoires_chien', $categoryDogAccessories);

        $categoryCatAccessories = new Category();
        $categoryCatAccessories->setName( "Accessoires");
        $categoryCatAccessories->setParent($categoryCat);
        $this->addReference('Accessoires_chat', $categoryCatAccessories);

        /*
         * CATEGORY HEALTHCARE
         * */

        $categoryDogHealthcare = new Category();
        $categoryDogHealthcare->setName("Soins&Hygiène_chien");
        $categoryDogHealthcare->setParent($categoryDog);
        $this->addReference('Soins&Hygiène_chien', $categoryDogHealthcare);

        $categoryCatHealthcare = new Category();
        $categoryCatHealthcare->setName("Soins&Hygiène");
        $categoryCatHealthcare->setParent($categoryCat);
        $this->addReference('Soins&Hygiène_chat', $categoryCatHealthcare);

        /*
         * CATEGORY CLOTHES
         * */

        $categoryDogClothes = new Category();
        $categoryDogClothes->setName("Vêtements_chien");
        $categoryDogClothes->setParent($categoryDog);
        $this->addReference('Vêtements_chien', $categoryDogClothes);

        $categoryCatClothes = new Category();
        $categoryCatClothes->setName("Vêtements_chat");
        $categoryCatClothes->setParent($categoryCat);
        $this->addReference('Vêtements_chat', $categoryCatClothes);



        $manager->persist($categoryDog);
        $manager->persist($categoryCat);
        $manager->persist($categoryDogFood);
        $manager->persist($categoryCatFood);
        $manager->persist($categoryDogAccessories);
        $manager->persist($categoryCatAccessories);
        $manager->persist($categoryDogHealthcare);
        $manager->persist($categoryCatHealthcare);
        $manager->persist($categoryDogClothes);
        $manager->persist($categoryCatClothes);
        $manager->flush();
    }
}
