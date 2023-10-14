<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="user_profile")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig');
    }
}
