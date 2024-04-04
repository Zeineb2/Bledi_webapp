<?php
// src/Controller/LoginController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    
    
    #[Route('/login', name: 'app_login')]
  
    
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // Récupérer le CIN saisi par l'utilisateur
        $cin = $request->request->get('cin');
    
        // Récupérer l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // Vérifier si une erreur s'est produite lors de la tentative de connexion
        if ($error instanceof BadCredentialsException) {
            // Afficher un message d'erreur approprié
            $this->addFlash('error', 'CIN ou mot de passe incorrect.');
        }
    
        // Vérifier si le CIN est valide (non vide)
        if (!empty($cin)) {
            // Créer un jeton d'authentification avec le CIN
            $token = new UsernamePasswordToken($cin, null, 'main');
    
            // Stocker le jeton dans le security.token_storage
            $this->get('security.token_storage')->setToken($token);
            
            // Rediriger l'utilisateur vers une page appropriée après la connexion réussie
            return $this->redirectToRoute('home');
        }
    
        // Rendre le formulaire de connexion avec les éventuels messages d'erreur
        return $this->render('utilisateur\login.html.twig', ['error' => $error]);
    }
    


    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode peut rester vide - elle sera interceptée par le firewall
    }
}
