<?php

namespace App\Controller;

use App\Entity\Perguntas;
use App\Entity\Respostas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PerguntasController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response{
        $query = $this->getDoctrine()
            ->getRepository(Perguntas::class)
            ->findAll();

        $res = array();
        foreach ($query as $item){
            $res[] = array(
              'id'=>$item->getId(),
              'respostaCorreta_id'=>$item->getRespostaCorretaId(),
              'questao'=>$item->getQuestao(),
            );
        }

        return $this->json($res);
    }

    public function save(Request $request): Response{
        return $this->json(['Vazio'=>0]);

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