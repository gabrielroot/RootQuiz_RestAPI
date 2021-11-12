<?php

namespace App\Controller;

use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UsuarioController extends AbstractController
{
    /**
     * @Route("/usuario", name="indexUsuario", methods="GET")
     */
    public function index(): Response{
        $query = $this->getDoctrine()->
            getRepository(Usuario::class)
            ->findAll();

        $usuarios = [];
        foreach ($query as $item){
            $usuarios[] = [
              'id'=> $item->getId(),
              'nome'=> $item->getNome(),
              'username'=> $item->getUsername(),
              'papeis'=> $item->getRoles(),
            ];
        }

        return $this->json($usuarios);
    }

    /**
     * @Route("/usuario/login", name="api_login", methods="POST")
     */
    public function login(#[CurrentUser] ?Usuario $user): Response{
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user'  => $user->getUserIdentifier()
        ]);
    }
    /**
     * @Route("/usuario/logout", name="app_logout", methods="GET")
     */
    public function logout(): void{
    }

    /**
     * @Route("/usuario/{id}", name="findUsuario", methods="GET")
     */
    public function find($id): Response{
        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($id);

        if(is_null($usuario)){
            return $this->json(["Erro"=>'Usuario não encontrado']);
        }

        $tentativas = array();
        foreach ($usuario->getTentativas() as $valor){
            $tentativas[] = [
                'id'=> $valor->getId(),
                'status'=> $valor->getErroAcerto(),
                'pergunta'=>$valor->getPergunta()?[
                    'id'=> $valor->getPergunta()->getId(),
                    'questao'=> $valor->getPergunta()->getQuestao()
                ]:null
            ];
        }

        $perguntas = array();
        foreach ($usuario->getPerguntas() as $valor){
            $perguntas[] = [
                'id'=> $valor->getId(),
                'questao'=> $valor->getQuestao()
            ];
        }
        $usuario = array(
            'id'=>$usuario->getId(),
            'nome'=>$usuario->getNome(),
            'username'=>$usuario->getUserName(),
            'perguntas'=>$perguntas,
            'tentativas'=>$tentativas
        );
        return $this->json($usuario,200);
    }

    /**
     * @Route("/usuario", name="saveUsuario", methods="POST")
     */
    public function save(Request $request, UserPasswordHasherInterface $passwordHasher): Response{
        $body =  $request->toArray();
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Usuario();
        $user->setUsername($body['username']);
        $user->setPassword($body['password']);
        $user->setNome($body['nome']);
        $user->setRoles($body['roles']);

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );
        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([],201);
    }

    /**
     * @Route("/usuario/{id}", name="updateUsuario", methods="PUT")
     */
    public function update(Request $request, int $id, UserPasswordHasherInterface $passwordHasher): Response
    {
        $usuarioRepository = $this->getDoctrine()->getRepository(Usuario::class);

        $body = $request->toArray();
        $entityManager = $this->getDoctrine()->getManager();

        $usuarioEncontrado = $usuarioRepository->find($id);
        if(is_null($usuarioEncontrado))
            return $this->json(["Erro"=>'Usuario não encontrado'],404);

        if(key_exists('nome', $body))
            $usuarioEncontrado->setNome($body['nome']);

        if(key_exists('username', $body))
            $usuarioEncontrado->setUsername($body['username']);

        if(key_exists('password', $body)){
            $usuarioEncontrado->setPassword($body['password']);
            $hashedPassword = $passwordHasher->hashPassword(
                $usuarioEncontrado,
                $usuarioEncontrado->getPassword()
            );
            $usuarioEncontrado->setPassword($hashedPassword);
        }


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
            return $this->json(["Erro"=>'Usuario não encontrado'],404);
        }

        foreach ($usuarioEncontrado->getPerguntas() as $pergunta){
            $pergunta->setUsuario(null);
        }

        $entityManager->remove($usuarioEncontrado);
        $entityManager->flush();

        return $this->json([],200);
    }
}
