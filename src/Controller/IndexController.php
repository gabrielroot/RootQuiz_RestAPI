<?php

namespace App\Controller;

use App\Entity\Resposta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="appIndex", methods="GET")
     */
    public function index(): Response{
        return $this->json(["QUIZROOT_API"=>"Tudo OK!"],200);
    }
}