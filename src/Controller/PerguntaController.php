<?php

namespace App\Controller;

use App\Entity\Pergunta;
use App\Entity\Resposta;
use App\Entity\Usuario;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PerguntaController extends AbstractController
{
    /**
     * @Route("/perguntas", name="indexPergunta", methods="GET")
     */
    public function index(): Response{
        $query = $this->getDoctrine()
            ->getRepository(Pergunta::class)
            ->getPerguntasRespostas();

        $perguntas = array();
        foreach ($query as $item){
            $alternativas = array('A','B','C','D');
            $respostas = array();
            $i = 0;
            foreach ($item->getRespostas() as $valor){
                $respostas[] = [
                    'id'=> $valor->getId(),
                    'alternativa'.$alternativas[$i]=> $valor->getAlternativa()
                ];
                $i++;
            }
            $perguntas[] = array(
              'id'=>$item->getId(),
              'respostaCorreta'=>$item->getRespostaCorreta(),
              'questao'=>$item->getQuestao(),
                'Respostas'=>$respostas
            );
        }

        return $this->json($perguntas);
    }

    /**
     * @Route("/pergunta", name="savePergunta", methods="POST")
     */
    public function save(Request $request): Response{
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);

        $body =  $request->toArray();
        $entityManager = $this->getDoctrine()->getManager();

        $usuarioEncontrado = $usuarioRepository->find($body['usuario']);
        if(is_null($usuarioEncontrado)){
            return $this->json(["Erro"=>'Usuário não encontrado']);
        }

        $pergunta = new Pergunta();
        $pergunta->setQuestao($body['questao']);
        $pergunta->setRespostaCorreta($body['respostaCorreta']);
        $pergunta->setUsuario($usuarioEncontrado);

        $respostas = new ArrayCollection();
        for($i=0; $i < sizeof($body['respostas']); $i++){
            $resposta = new Resposta();
            $resposta->setAlternativa($body['respostas'][$i]);
            $resposta->setPergunta($pergunta);
            $respostas[] = $resposta;
        }
        $pergunta->setRespostas($respostas);

        $entityManager->persist($pergunta);
        $entityManager->flush();

        return $this->json([],201);
    }

    /**
     * @Route("/pergunta/{id}", name="updatePergunta", methods="PUT")
     */
    public function update(Request $request, int $id): Response{
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);
        $perguntaRepository = $this->getDoctrine()->getRepository(Pergunta::class);

        $body =  $request->toArray();
        $entityManager = $this->getDoctrine()->getManager();

        $perguntaEncontrada = $perguntaRepository->find($id);
        if(is_null($perguntaEncontrada)){
            return $this->json(["Erro"=>'Pergunta não encontrada']);
        }

        if(key_exists('usuario', $body)) {
            $usuarioEncontrado = $usuarioRepository->find($body['usuario']);
            if (is_null($usuarioEncontrado)) {
                return $this->json(["Erro" => 'Usuário não encontrado']);
            }

            $perguntaEncontrada->setUsuario($usuarioEncontrado);
        }

        if(key_exists('questao',$body))
            $perguntaEncontrada->setQuestao($body['questao']);

        if(key_exists('respostaCorreta',$body))
            $perguntaEncontrada->setRespostaCorreta($body['respostaCorreta']);


        $entityManager->persist($perguntaEncontrada);
        $entityManager->flush();

        return $this->json([], 200);
    }

    /**
     * @Route("/pergunta/{id}", name="deletePergunta", methods="DELETE")
     */
    public function delete(int $id): Response{
        $perguntaRepository = $this->getDoctrine()->getRepository(Pergunta::class);

        $entityManager = $this->getDoctrine()->getManager();

        $perguntaEncontrada = $perguntaRepository->find($id);
        if(is_null($perguntaEncontrada)){
            return $this->json(["Erro"=>'Pergunta não encontrada']);
        }

        $entityManager->remove($perguntaEncontrada);
        $entityManager->flush();

        return $this->json([],200);
    }
}