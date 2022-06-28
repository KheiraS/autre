<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName('Croquettes pour chien - CANARD, POMME, CAROTTE');
        $product1->setImage('croquette_chien_franklin_1.png');
        $product1->setCategory($this->getReference('Alimentation_chien'));
        $product1->setBrand($this->getReference('Franklin'));
        $product1->setPrice(21.95);
        $product1->setDescription('Avis aux grands sensibles et autres intolérants à moustaches ! 
                    Voilà la recette idéale pour éviter les allergies alimentaires. 
                    Au menu : du canard, une viande digeste et riche en protéines pour prendre soin de leurs muscles,
                    des fruits et des légumes pour faire le plein de fibres et faciliter la digestion, 
                    des vitamines et des minéraux pour préserver leur santé. À table !');
        $product1->setRate(5);
        $product1->setAvailable(true);
        $product1->setOffer(true);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Croquettes pour chien - AGNEAU, PATATE DOUCE, MENTHE');
        $product2->setImage('croquette_chien_franklin_2.png');
        $product2->setCategory($this->getReference('Alimentation_chien'));
        $product2->setBrand($this->getReference('Franklin'));
        $product2->setPrice(21.50);
        $product2->setDescription('Avis aux estomacs sensibles ! Voilà la recette idéale pour dire stop aux crottes molles et aux ballonnements. Au menu : de l\’agneau, une viande ultra digeste et riche en protéines pour soutenir le système immunitaire, des légumes pour faciliter la digestion, des minéraux et des prébiotiques pour renforcer la santé intestinale. Merci Franklin ! ');
        $product2->setRate(5);
        $product2->setAvailable(true);
        $product2->setOffer(false);
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Croquettes pour chien - POULET & RIZ');
        $product3->setImage('croquette_chien_wolfood_1.png');
        $product3->setCategory($this->getReference('Alimentation_chien'));
        $product3->setBrand($this->getReference('Wolfood'));
        $product3->setPrice(22.45);
        $product3->setDescription('Les croquettes pour chien Chicken Rice ALS de Wolfood sont probablement l’une des recettes les plus savoureuses de la célèbre marque française. 
        Elles sont composées à 38% de protéines (dont 90% d’origines animales) et font la part belle au poulet, à la dinde et au canard. Un peu de riz complet a également été ajouté (5%) pour apporter des fibres et assurer une meilleure digestion.');
        $product3->setRate(3);
        $product3->setAvailable(false);
        $product3->setOffer(true);
        $manager->persist($product3);

        $product4 = new Product();
        $product4->setName('Croquettes pour chaton - POULET, POISSON BLANC');
        $product4->setImage('croquette_chaton_lily_1.png');
        $product4->setCategory($this->getReference('Alimentation_chat'));
        $product4->setBrand($this->getReference('Lily\'s Kitchen'));
        $product4->setPrice(12.50);
        $product4->setDescription('Cette recette de croquettes pour chatons contient tous les nutriments dont il a besoin pour s\'épanouir et jouir d\'une santé de fer.
        Créée avec l\'aide de vétérinaires, de nutritionnistes et de spécialistes du goût, cette recette est naturellement savoureuse et saura ravir votre nouvelle boule de poils (convient aux chatons âgés de moins de 12 mois). Et tout cela dans une croquette plus petite pour les petites bouches. Avec 74% de viande provenant de poulet et d\'abats fraîchement préparés, il contient beaucoup de protéines et de calcium pour aider votre chaton à grandir et à devenir fort. Il s\'agit d\'une recette complète et équilibrée sur le plan nutritionnel, sans céréales, sans farine de viande ni additif, ce qui la rend naturellement saine pour votre chaton.
        Cette recette complète et équilibrée est parfaite pour les petits creux a tout moment de la journée !');
        $product4->setRate(4);
        $product4->setAvailable(true);
        $product4->setOffer(false);
        $manager->persist($product4);

        $product5 = new Product();
        $product5->setName('Croquettes pour chat & chaton - sans céréales');
        $product5->setImage('croquette_chat_wolfood_1.png');
        $product5->setCategory($this->getReference('Alimentation_chat'));
        $product5->setBrand($this->getReference('Wolfood'));
        $product5->setPrice(24.90);
        $product5->setDescription('Les croquettes sans céréales Wolfood Original Cat & Kitten sont très polyvalentes. Que votre chat soit jeune ou âgé, hyperactif ou super détendu, qu’il s’agisse d’un chaton qui grandit ou d’une chatte qui attend des petits, les croquettes de la célèbre marque française s’adressent à tous les chats.');
        $product5->setRate(4);
        $product5->setAvailable(true);
        $product5->setOffer(true);
        $manager->persist($product5);

        $product6 = new Product();
        $product6->setName('Croquettes pour chat - SAUMON, POISSON BLANC, PERSIL');
        $product6->setImage('croquette_chat_lily_1.png');
        $product6->setCategory($this->getReference('Alimentation_chat'));
        $product6->setBrand($this->getReference('Lily\'s Kitchen'));
        $product6->setPrice(12.50);
        $product6->setDescription('Aliment complet. Composée à 70% de poisson fraîchement préparé et issu de sources durables, votre chat adorera son agréable odeur et son goût délicieux. Nos recettes pour chats ne contiennent absolument pas de céréales, de farine de viande ou d\'additifs artificiels, mais seulement de merveilleux morceaux de viande. En effet, nous n\'utilisons que des ingrédients naturels de premier choix, ce qui signifie qu\'ils sont naturellement sains pour votre chat.
        Avec des croquettes en forme de triangle et des algues pour aider à réduire le tartre et le persil, cette recette aide également votre chat à avoir des dents en meilleure santé et haleine plus fraiche.');
        $product6->setRate(4);
        $product6->setAvailable(true);
        $product6->setOffer(true);
        $manager->persist($product6);


        $product7 = new Product();
        $product7->setName('Imperméable pour chien avec sa capuche amovible ');
        $product7->setImage('raincoat_chien.jpg');
        $product7->setCategory($this->getReference('Vêtements_chien'));
        $product7->setBrand($this->getReference('Milk & Pepper'));
        $product7->setPrice(56.50);
        $product7->setDescription('Imperméable spécialement conçu et dédié aux petits chiens et aux chiens moyens. Sa couleur jaune en maille enduite douce et souple
        Entièrement doublé, doublure rayée blanc cassé et marine. Sans manches');
        $product7->setRate(4);
        $product7->setAvailable(true);
        $product7->setOffer(true);
        $manager->persist($product7);

        $product8 = new Product();
        $product8->setName('Teepee pour chien en laine feutrée ');
        $product8->setImage('tipi_chien.png');
        $product8->setCategory($this->getReference('Accessoires_chien'));
        $product8->setBrand($this->getReference('Miacara'));
        $product8->setPrice(129.00);
        $product8->setDescription('Tente pour chien ou chat faite main en feutre gris avec un coussin moelleux rempli de silicone.
        La forme du tipi procure à votre animal de compagnie une sensation de confort et de sécurité. Selon les besoins de votre animal, il peut se cacher ou garder un œil sur le monde extérieur.
        Son design est simple et épuré, il convient à tout type d\'intérieur.');
        $product8->setRate(4);
        $product8->setAvailable(true);
        $product8->setOffer(true);
        $manager->persist($product8);

        $product9 = new Product();
        $product9->setName('Gamelle LOFT Chêne et Inox - gamelle design pour chat  ');
        $product9->setImage('gamelle_chat.jpg');
        $product9->setCategory($this->getReference('Accessoires_chat'));
        $product9->setBrand($this->getReference('Labbvenn'));
        $product9->setPrice(89.00);
        $product9->setDescription('La gamelle design LOFT est fabriquée en acier et bois de qualité supérieur : le chêne.
        Les récipients sont réalisés en inox, matériaux autant esthétique que durable et facile à nettoyer.');
        $product9->setRate(5);
        $product9->setAvailable(true);
        $product9->setOffer(true);
        $manager->persist($product9);

        $product10 = new Product();
        $product10->setName('Catissa - Maison design pour chat  ');
        $product10->setImage('arbre_chat.jpg');
        $product10->setCategory($this->getReference('Accessoires_chat'));
        $product10->setBrand($this->getReference('Miacara'));
        $product10->setPrice(135.00);
        $product10->setDescription('Pensée et dessinée par Miacara, cette maison design spécialement conçue pour chat motivera vos félins à aller d\'aventures en aventures.
        Itinérance, jeu, escalade, ou repos... le chat ne s\'en passera plus. ');
        $product10->setRate(3);
        $product10->setAvailable(true);
        $product10->setOffer(false);
        $manager->persist($product10);

        $manager->flush();

    }
}
