<?php 

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Produits;

class ProduitsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $produit1 = new Produits();
        $produit1->setNom('Harry Potter - Tome 1');
        $produit1->setDescription("Depuis la mort de ses parents, Harry vit chez son oncle et sa tante, les horribles Dursmley. Le jour de ses onze ans, il reçoit une lettre, deux lettres, des milliers de lettres qu ils lui interdisent de lire. Le géant Hagrid se déplace donc en personne pour lui apprendre qu'il est attendu à l'école des sorciers... Un phénomène de librairie qui apporte un peu de magie au quotidien. Mais attention, ce livre exerce bien un maléfice sur ses lecteurs : quand on le commence, on ne le lâche plus !");
        $produit1->setPrix('3.99');
        $produit1->setDisponible('1');
        $produit1->setTva($this->getReference('tva2'));
        $produit1->setImage('null');
		$manager->persist($produit1);

		$produit2 = new Produits();
        $produit2->setNom('Harry Potter - Tome 2');
        $produit2->setDescription("Une rentrée fracassante en voiture volante, une étrange malédiction qui s’abat sur les élèves, cette deuxième année à l’école des sorciers ne s’annonce pas de tout repos !");
        $produit2->setPrix('4.99');
        $produit2->setDisponible('1');
        $produit2->setTva($this->getReference('tva2'));
        $produit2->setImage('null');
		$manager->persist($produit2);

		$produit3 = new Produits();
        $produit3->setNom('Harry Potter - Tome 3');
        $produit3->setDescription("Sirius Black, le dangereux criminel qui s’est échappé de la forteresse d’Azkaban, recherche Harry Potter. C’est donc sous bonne garde que l’apprenti sorcier fait sa troisième rentrée à Poudlard...");
        $produit3->setPrix('4.99');
        $produit3->setDisponible('1');
        $produit3->setTva($this->getReference('tva2'));
        $produit3->setImage('null');
		$manager->persist($produit3);

		$produit4 = new Produits();
        $produit4->setNom('Les Misérables');
        $produit4->setDescription("Je m'appelle jean Valjean. je suis un galérien. J'ai passé dix-neuf ans au bagne. je suis libéré depuis quatre jours et en route pour Pontarlier qui est ma destination. Quatre jours que je marche depuis Toulon. Aujourd'hui j'ai fait douze lieues à pied. Ce soir en arrivant dans ce pays, j'ai été dans une auberge, on m'a renvoyé à cause de mon passeport jaune que j'avais montré à la mairie. J'ai été à une autre auberge. On m'a dit: - Va-t'en! Chez l'un, chez l'autre. Personne n'a voulu de moi. J'ai été à la prison, le guichetier ne m'a pas ouvert. J'ai été dans la niche d'un chien. Ce chien m'a mordu et m'a chassé, comme s'il avait été un homme. On aurait dit qu'il savait qui j'étais. je m'en suis allé dans les champs pour coucher à la belle étoile. Il n'y avait pas d'étoile.");
        $produit4->setPrix('2.99');
        $produit4->setDisponible('1');
        $produit4->setTva($this->getReference('tva2'));
        $produit4->setImage('null');
		$manager->persist($produit4);

		$produit5 = new Produits();
        $produit5->setNom('L\'Odyssée');
        $produit5->setDescription("Dans la petite île d'Ithaque, Pénélope et son fils Télémaque attendent Ulysse, leur époux et père. Voilà vingt ans qu'il est parti pour Troie et qu'ils sont sans nouvelles de lui. De l'autre côté des mers, Ulysse a pris le chemin du retour depuis longtemps déjà. Mais les tempêtes, les monstres, les géants, les dieux parfois, l'arrêtent ou le détournent de sa route. Premier grand voyageur, Ulysse découvre l'Inconnu où naissent les rêves et les peurs des hommes depuis la nuit des temps; L'Odyssée nous dit cette aventure au terme de laquelle le héros retrouve enfin, aux côtés de Pénélope,");
        $produit5->setPrix('2.99');
        $produit5->setDisponible('1');
        $produit5->setTva($this->getReference('tva2'));
        $produit5->setImage('null');
		$manager->persist($produit5);


        $manager->flush();


    }

    public function getOrder()
    {
    	return 2;
    }
}