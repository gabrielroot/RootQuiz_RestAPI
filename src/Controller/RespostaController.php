<?php

namespace App\Controller;

use App\Entity\Resposta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RespostaController extends AbstractController
{
    /**
     * @Route("/resposta/{id}", name="deleteResposya", methods="DELETE")
     */
    public function delete(int $id): Response{
        $respostaRepository = $this->getDoctrine()->getRepository(Resposta::class);

        $entityManager = $this->getDoctrine()->getManager();

        $respostaEncontrada = $respostaRepository->find($id);
        if(is_null($respostaEncontrada)){
            return $this->json(["Erro"=>'Resposta não encontrada'], 404);
        }

        $entityManager->remove($respostaEncontrada);
        $entityManager->flush();

        return $this->json([],200);
    }
}