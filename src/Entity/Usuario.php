<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario
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
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $senha;

    /**
     * @ORM\Column(type="integer")
     */
    private $privilegio;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Perguntas", mappedBy="usuario")
     */
    private $perguntas;

    public function __construct()
    {
        $this->perguntas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getPrivilegio(): ?int
    {
        return $this->privilegio;
    }

    public function setPrivilegio(int $privilegio): self
    {
        $this->privilegio = $privilegio;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPerguntas(): ArrayCollection
    {
        return $this->perguntas;
    }

    /**
     * @param ArrayCollection $perguntas
     */
    public function setPerguntas(ArrayCollection $perguntas): void
    {
        $this->perguntas = $perguntas;
    }
}
