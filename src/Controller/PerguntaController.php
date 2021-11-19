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
     * @Route("/pergunta", name="indexPergunta", methods="GET")
     */
    public function index(): Response{
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);
        $usuarioEncontrado = $usuarioRepository->findOneBy(['username'=>$this->getUser()->getUserIdentifier()]);

        $query = $this->getDoctrine()
            ->getRepository(Pergunta::class)
            ->getPerguntasRespostas($usuarioEncontrado->getId());

        $perguntas = array();
        foreach ($query as $item){
            $respostas = array();
            $i = 0;
            foreach ($item->getRespostas() as $valor){
                $respostas[] = [
                    'id'=> $valor->getId(),
                    'alternativa'=> $valor->getAlternativa()
                ];
                $i++;
            }
            $perguntas[] = array(
              'id'=>$item->getId(),
              'respostaCorreta'=>$item->getRespostaCorreta(),
              'questao'=>$item->getQuestao(),
                'criadaPor'=>$item->getUsuario()?$item->getUsuario()->getId():null,
                'respostas'=>$respostas
            );
        }

        return $this->json($perguntas, 200);
    }

    /**
     * @Route("/pergunta/aleatoria", name="perguntaAleatoria", methods="GET")
     */
    public function perguntaAleatoria(): Response{
        $query = $this->getDoctrine()
            ->getRepository(Pergunta::class)
            ->getPerguntasRespostas();

        $perguntaSelecionada = $query[rand(0,sizeof($query)-1)];

        $respostas = array();
        $i = 0;
        foreach ($perguntaSelecionada->getRespostas() as $valor){
            $respostas[] = [
                'id'=> $valor->getId(),
                'alternativa'=> $valor->getAlternativa()
            ];
            $i++;
        }
        $pergunta = array(
            'id'=>$perguntaSelecionada->getId(),
            'respostaCorreta'=>$perguntaSelecionada->getRespostaCorreta(),
            'questao'=>$perguntaSelecionada->getQuestao(),
            'criadaPor'=>$perguntaSelecionada->getUsuario()?$perguntaSelecionada->getUsuario()->getId():null,
            'respostas'=>$respostas
        );

        return $this->json($pergunta, 200);
    }

    /**
     * @Route("/pergunta/{id}", name="findPergunta", methods="GET")
     */
    public function find($id): Response{
        $pergunta = $this->getDoctrine()
                ->getRepository(Pergunta::class)
                ->find($id);

        if(is_null($pergunta)){
            return $this->json(["Erro"=>'Pergunta não encontrada'], 404);
        }

        $respostas = array();
        $i = 0;
        foreach ($pergunta->getRespostas() as $valor){
            $respostas[] = [
                'id'=> $valor->getId(),
                'alternativa'=> $valor->getAlternativa()
            ];
            $i++;
        }
        $pergunta = array(
            'id'=>$pergunta->getId(),
            'respostaCorreta'=>$pergunta->getRespostaCorreta(),
            'questao'=>$pergunta->getQuestao(),
            'Respostas'=>$respostas
        );

        return $this->json($pergunta,200);
    }

    /**
     * @Route("/pergunta", name="savePergunta", methods="POST")
     */
    public function save(Request $request): Response{
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);

        $body =  $request->toArray();
        $entityManager = $this->getDoctrine()->getManager();

        $usuarioEncontrado = $usuarioRepository->findOneBy(['username'=>$this->getUser()->getUserIdentifier()]);
        if(is_null($usuarioEncontrado)){
            return $this->json(["Erro"=>'Usuário não logado'],401);
        }

        $pergunta = new Pergunta();
        $pergunta->setQuestao($body['questao']);
        $pergunta->setRespostaCorreta($body['respostaCorreta']);
        $pergunta->setUsuario($usuarioEncontrado);

        $respostas = new ArrayCollection();
        foreach ($body['respostas'] as $item){
            $resposta = new Resposta();
            $resposta->setPergunta($pergunta);
            $resposta->setAlternativa($item['alternativa']);
            $respostas->add($resposta);
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
        $respostaRepository = $this->getDoctrine()->getRepository(Resposta::class);
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);
        $perguntaRepository = $this->getDoctrine()->getRepository(Pergunta::class);

        $body =  $request->toArray();
        $entityManager = $this->getDoctrine()->getManager();

        $perguntaEncontrada = $perguntaRepository->find($id);
        if(is_null($perguntaEncontrada)){
            return $this->json(["Erro"=>'Pergunta não encontrada'], 404);
        }

        if(key_exists('usuario', $body)) {
            $usuarioEncontrado = $usuarioRepository->find($body['usuario']);
            if (is_null($usuarioEncontrado)) {
                return $this->json(["Erro" => 'Usuário não encontrado'], 404);
            }

            $perguntaEncontrada->setUsuario($usuarioEncontrado);
        }

        if(key_exists('questao',$body))
            $perguntaEncontrada->setQuestao($body['questao']);

        if(key_exists('respostaCorreta',$body))
            $perguntaEncontrada->setRespostaCorreta($body['respostaCorreta']);

        if(key_exists('respostas', $body))
            foreach ($body['respostas'] as $item){
                $resposta = $respostaRepository->find($item['id']);
                if(is_null($resposta)){
                    $resposta = new Resposta();
                    $resposta->setPergunta($perguntaEncontrada);
                }

                $resposta->setAlternativa($item['alternativa']);

                $entityManager->persist($resposta);
                $entityManager->flush();
            }


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
            return $this->json(["Erro"=>'Pergunta não encontrada'], 404);
        }

        foreach ($perguntaEncontrada->getTentativas() as $tentativa){
            $tentativa->setPergunta(null);
        }

        $entityManager->remove($perguntaEncontrada);
        $entityManager->flush();

        return $this->json([],200);
    }
}
