<?php

namespace App\Entity;

use App\Repository\RespostasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RespostasRepository::class)
 */
class Resposta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alternativa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta", inversedBy="respostas")
     */
    private $pergunta;

    public function getId(): ?int { return $this->id; }

    public function getAlternativa(): ?string { return $this->alternativa; }
    public function setAlternativa(string $alternativa): self { $this->alternativa = $alternativa; return $this; }

    /**
     * @return mixed
     */
    public function getPergunta(){ return $this->pergunta;}
    /**
     * @param mixed $pergunta
     */
    public function setPergunta($pergunta): void{ $this->pergunta = $pergunta; }
}
