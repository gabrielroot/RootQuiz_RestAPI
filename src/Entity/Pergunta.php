<?php

namespace App\Entity;

use App\Repository\PerguntasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass=PerguntasRepository::class)
 */
class Pergunta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, options={"default":"Nenhuma"})
     */
    private $respostaCorreta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $questao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resposta", mappedBy="pergunta", cascade={"remove", "persist"})
     */
    private $respostas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="usuarios")
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tentativa", mappedBy="pergunta")
     */
    private $tentativas;

    public function __construct()
    {
        $this->respostas = new ArrayCollection();
        $this->tentativas = new ArrayCollection();
    }



    public function getId(): ?int { return $this->id; }

    public function getQuestao(): ?string { return $this->questao; }
    public function setQuestao(string $questao): self { $this->questao = $questao; return $this; }

    /**
     * @return mixed
     */
    public function getRespostaCorreta() {  return $this->respostaCorreta; }
    /**
     * @param mixed $respostaCorreta
     */
    public function setRespostaCorreta($respostaCorreta): void { $this->respostaCorreta = $respostaCorreta; }

    /**
     * @return ArrayCollection
     */
    public function getRespostas(): PersistentCollection { return $this->respostas; }
    /**
     * @param ArrayCollection $respostas
     */
    public function setRespostas(ArrayCollection $respostas): void { $this->respostas = $respostas; }

    /**
     * @return mixed
     */
    public function getUsuario() { return $this->usuario; }
    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void { $this->usuario = $usuario; }

    /**
     * @return ArrayCollection
     */
    public function getTentativas(): ArrayCollection { return $this->tentativas; }
    /**
     * @param ArrayCollection $tentativas
     */
    public function setTentativas(ArrayCollection $tentativas): void { $this->tentativas = $tentativas; }

}
