<?php

namespace App\Entity;

use App\Repository\PerguntasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerguntasRepository::class)
 */
class Perguntas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $respostaCorretaId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $questao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Respostas", mappedBy="pergunta")
     */
    private $respostas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="usuarios")
     */
    private $usuario;

    public function __construct()
    {
        $this->respostas = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getQuestao(): ?string { return $this->questao; }
    public function setQuestao(string $questao): self { $this->questao = $questao; return $this; }

    /**
     * @return mixed
     */
    public function getrespostaCorretaId() {  return $this->respostaCorretaId; }
    /**
     * @param mixed $respostaCorretaId
     */
    public function setrespostaCorretaId($respostaCorretaId): void { $this->respostaCorretaId = $respostaCorretaId; }

    /**
     * @return ArrayCollection
     */
    public function getRespostas(): ArrayCollection { return $this->respostas; }
    /**
     * @param ArrayCollection $respostas
     */
    public function setRespostas(ArrayCollection $respostas): void { $this->respostas = $respostas; }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }

}
