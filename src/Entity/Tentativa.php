<?php

namespace App\Entity;

use App\Repository\TentativasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TentativasRepository::class)
 */
class Tentativa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $erroAcerto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="tentativas")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta", inversedBy="tentativas")
     */
    private $pergunta;

    public function getId(): ?int { return $this->id; }

    public function getErroAcerto(): ?bool { return $this->erroAcerto; }
    public function setErroAcerto(bool $erroAcerto): self { $this->erroAcerto = $erroAcerto; return $this; }

    /**
     * @return mixed
     */
    public function getUsuario() { return $this->usuario; }
    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void { $this->usuario = $usuario; }

    /**
     * @return mixed
     */
    public function getPergunta()
    {
        return $this->pergunta;
    }

    /**
     * @param mixed $pergunta
     */
    public function setPergunta($pergunta): void
    {
        $this->pergunta = $pergunta;
    }
}
