<?php

namespace App\Controller;

use App\Entity\Pergunta;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    /**
     * @Route("/usuarios", name="indexUsuario", methods="GET")
     */
    public function index(): Response{
        $query = $this->getDoctrine()->
            getRepository(Usuario::class)
            ->findAll();

        $usuarios = [];
        foreach ($query as $item){
            $usuarios[] = [
              'nome'=> $item->getNome(),
              'privilegio'=> $item->getPrivilegio(),
            ];
        }

        return $this->json($usuarios);
    }

    /**
     * @Route("/usuario", name="saveUsuario", methods="POST")
     */
    public function save(Request $request): Response{
        $body =  $request->toArray();
        $entityManager = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $usuario->setNome($body['nome']);
        $usuario->setPrivilegio($body['privilegio']);
        $usuario->setSenha($body['senha']);

        $entityManager->persist($usuario);
        $entityManager->flush();

        return $this->json([],201);
    }

    /**
     * @Route("/usuario/{id}", name="updateUsuario", methods="PUT")
     */
    public function update(Request $request, int $id): Response
    {
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);

        $body = $request->toArray();
        $entityManager = $this->getDoctrine()->getManager();

        $usuarioEncontrado = $usuarioRepository->find($id);
        if(is_null($usuarioEncontrado))
            return $this->json([]);

        if(key_exists('nome', $body))
            $usuarioEncontrado->setNome($body['nome']);

        if(key_exists('privilegio', $body))
            $usuarioEncontrado->setPrivilegio($body['privilegio']);

        if(key_exists('senha', $body))
            $usuarioEncontrado->setSenha($body['senha']);

        $entityManager->persist($usuarioEncontrado);
        $entityManager->flush();

        return $this->json([],200);
    }

    /**
     * @Route("/usuario/{id}", name="deleteUsuario", methods="DELETE")
     */
    public function delete(int $id): Response{
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);

        $entityManager = $this->getDoctrine()->getManager();

        $usuarioEncontrado = $usuarioRepository->find($id);
        if(is_null($usuarioEncontrado)){
            return $this->json(["Erro"=>'Usuario não encontrado']);
        }

        $entityManager->remove($usuarioEncontrado);
        $entityManager->flush();

        return $this->json([],200);
    }
}