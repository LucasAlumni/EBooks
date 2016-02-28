<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Produits;
use AppBundle\Form\CommandeType;
use AppBundle\Entity\Commande;

class EbookController extends Controller
{

    public function indexAction(Request $request)
    {
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('AppBundle:Produits')->findBy(array('disponible' => 1));

        if ($session->has('panier')) {
            $panier = $session->get('panier');
        } else {
            $panier = false;
        }


        return $this->render('ebook/index.html.twig', array('produits' => $produits,
                                                            'panier' => $panier));
    }

    public function produitAction(Request $request, $id)
    {
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('AppBundle:Produits')->find($id);

        if ($session->has('panier')) {
            $panier = $session->get('panier');
        } else {
            $panier = false;
        }

        return $this->render('ebook/produit/produit.html.twig', array('produit' => $produit,
                                                                        'panier' => $panier));
    }

    public function ajouterAction(Request $request, $id)
    {
        $session = $request->getSession();

        if(!$session->has('panier')) $session->set('panier', array());

        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');            
        } else {
            if ($request->query->get('qte') != null) {
                $panier[$id] = $request->query->get('qte'); 
            } else {
                $panier[$id] = 1;
            }
        }

        $session->set('panier', $panier);
        $this->get('session')->getFlashBag()->add('success', 'Votre article à été ajouter avec succès');

        return $this->redirectToRoute('ebook_panier');
    }

    public function supprimerAction(Request $request, $id)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) 
        {
            unset($panier[$id]);
            $session->set('panier', $panier);
            $this->get('session')->getFlashBag()->add('success', 'Votre article à été supprimer avec succès');
        }

        return $this->redirectToRoute('ebook_panier');
    }

    public function panierAction(Request $request)
    {
        $session = $request->getSession();
        // $session->remove('panier');
        // die();

        if (!$session->has('panier')) {
            $session->set('panier', array());
        }

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('AppBundle:Produits')->findArray(array_keys($session->get('panier')));

        return $this->render('ebook/produit/panier.html.twig', array('produits' => $produits,
                                                                    'panier' => $session->get('panier')));
    }

    public function menuAction(Request $request)
    {
        $session = $request->getSession();

        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('ebook/nav/panier.html.twig', array('articles' => $articles));
    }

    public function livraisonAction()
    {
        $form = $this->createForm(CommandeType::class);

        return $this->render('ebook/produit/livraison.html.twig', array('form' => $form->createView()));
    }

    public function postLivraisonAction(Request $request)
    {
        $session = $request->getSession();

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if($form->isValid()){
            $userManager = $this->get('fos_user.user_manager');

            $em = $this->getDoctrine()->getManager();
            $email = $form['email']->getData();
            $user = $userManager->findUserByEmail($email);

            if(!$user) {
                $user = $userManager->createUser();
                $user->setEmail($email);
                $user->setPlainPassword('password');
                $userManager->updateUser($user);
            }

            $produits =  $session->get('panier');
            $produits = $em->getRepository('AppBundle:Produits')->findById($produits);

            foreach ($produits as $key => $produit) {
                $commande->addProduit($produit);
            }

            $commande->setUser($user);
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('ebook_validation');
        }
        else {
            return $this->redirectToRoute('ebook_livraison');
        }
    }

    public function validationAction(Request $request)
    {
        $session = $request->getSession();

        if (!$session->has('panier')) {
            $session->set('panier', array());
        }

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('AppBundle:Produits')->findArray(array_keys($session->get('panier')));

        return $this->render('ebook/produit/validation.html.twig', array('produits' => $produits,
                                                                    'panier' => $session->get('panier')));
    }
}
