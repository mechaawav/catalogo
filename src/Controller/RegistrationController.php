<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        // Agrega aquí la lógica para procesar y validar los datos del formulario de registro.

        if ($request->isMethod('POST')) {
            $user->setUsername($request->request->get('username'));
            // Establece otros campos del usuario según los datos del formulario.
            
            // Hashea la contraseña antes de almacenarla en la base de datos.
            $hashedPassword = $passwordEncoder->encodePassword($user, $request->request->get('password'));
            $user->setPassword($hashedPassword);

            // Guarda el nuevo usuario en la base de datos.
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirige al usuario después de registrar con éxito.
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig');
    }
}
