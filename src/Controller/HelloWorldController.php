<?php

namespace App\Controller;

use App\Entity\Perguntas;
use App\Entity\Respostas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HelloWorldController extends AbstractController
{
    /**
     * @Route("/ola/{pagina}", name="helloPage")
     */
    public function olaMundo(Request $request, string $pagina = '0'): Response{

        $entityManager = $this->getDoctrine()->getManager();
        $perguntas = new Perguntas();
        $perguntas->setQuestao('Mouse é um periferico de:');
        $perguntas->setRespostaCorretaId(0);
        $perguntas->setResposta(
            $this->getDoctrine()
            ->getRepository(Respostas::class)
            ->find(0)
        );

        $entityManager->persist($perguntas);
        $entityManager->flush();

        $array = [
            ['nome'=>'Gabriel', 'idade'=>21],
            ['nome'=>'André','idade'=>random_int(0, 100)]
        ];
        if((int) $pagina >= 0 && (int) $pagina <= 1){
            $array = $array[(int) $pagina];
        }else{
            return $this->json(['acesso'=>'negado']);
        }

        echo $request->attributes->get('_route');
        echo array_values($request->attributes->get('_route_params'))[0];
        return $this->json($array);
    }
}