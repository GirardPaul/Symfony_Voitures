<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('global/accueil.html.twig');
    }

     /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(HttpFoundationRequest $request, EntityManagerInterface $objectManager, UserPasswordEncoderInterface $encoder)
    {
       $utilisateur = new Utilisateur();
       $form = $this->createForm(InscriptionType::class, $utilisateur);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $passwordCrypte = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $utilisateur->setRoles("ROLE_USER");
            $objectManager->persist($utilisateur);
            $objectManager->flush();
            return $this->redirectToRoute('accueil');
        }

       return $this->render('global/inscription.html.twig', [
           "form" => $form->createView()
       ]);

    }

     /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $util){
        
        return $this->render('global/login.html.twig', [
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
        
    }
}
