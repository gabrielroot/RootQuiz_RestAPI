<?php

namespace App\Controller;

use App\Entity\Pergunta;
use App\Entity\Tentativa;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TentativaControler extends AbstractController
{
    /**
     * @Route("/tentativa", name="indexTentativa", methods="GET")
     */
    public function index(): Response{
        $query = $this->getDoctrine()->
        getRepository(Tentativa::class)
            ->findAll();

        $tentativas = [];
        foreach ($query as $item){
            $tentativas[] = [
                'id'=> $item->getId(),
                'status'=> $item->getErroAcerto(),
                'usuario'=> [
                    'id'=>$item->getUsuario()->getId(),
                    'nome'=>$item->getUsuario()->getNome(),
                ],
                'pergunta'=>[
                    'id'=>$item->getPergunta()->getId(),
                    'questao'=>$item->getPergunta()->getQuestao(),
                    'respostaCorreta'=>$item->getPergunta()->getRespostaCorreta(),
                ]
            ];
        }

        return $this->json($tentativas);
    }

    /**
     * @Route("/tentativa", name="saveTentativa", methods="POST")
     */
    public function save(Request $request): Response{
        $entityManager = $this->getDoctrine()->getManager();
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);
        $perguntaRepository = $this->getDoctrine()->getRepository(Pergunta::class);

        $body =  $request->toArray();

        $tentativa = new Tentativa();
        $tentativa->setErroAcerto($body['status']);

        $usuarioEncontrado = $usuarioRepository->findOneBy(['username'=>$this->getUser()->getUserIdentifier()]);
        if(is_null($usuarioEncontrado)){
            return $this->json(["Erro"=>'Usuário não logado'],401);
        }

        $tentativa->setUsuario($usuarioEncontrado);

        $perguntaEncontrada = $perguntaRepository->find($body['pergunta_id']);
        if(is_null($perguntaEncontrada))
            return $this->json(['Erro'=>'Pergunta não encontrado'], 404);

        $tentativa->setPergunta($perguntaEncontrada);

        $entityManager->persist($tentativa);
        $entityManager->flush();

        return $this->json([],201);
    }
}