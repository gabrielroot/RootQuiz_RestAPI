<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Pergunta", mappedBy="usuario")
     */
    private $perguntas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tentativa", mappedBy="usuario", cascade={"remove"})
     */
    private $tentativas;

    public function __construct($nome, $privilegio, $senha)
    {
        $this->nome = $nome;
        $this->privilegio = $privilegio;
        $this->senha = $senha;
        $this->perguntas = new ArrayCollection();
        $this->tentativas = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getNome(): ?string { return $this->nome; }
    public function setNome(string $nome): self { $this->nome = $nome; return $this; }

    public function getSenha(): ?string { return $this->senha; }
    public function setSenha(string $senha): self { $this->senha = $senha; return $this; }

    public function getPrivilegio(): ?int { return $this->privilegio; }
    public function setPrivilegio(int $privilegio): self { $this->privilegio = $privilegio; return $this; }

    /**
     * @return ArrayCollection
     */
    public function getPerguntas(): PersistentCollection { return $this->perguntas; }
    /**
     * @param ArrayCollection $perguntas
     */
    public function setPerguntas(ArrayCollection $perguntas): void { $this->perguntas = $perguntas; }

    /**
     * @return ArrayCollection
     */
    public function getTentativas(): PersistentCollection { return $this->tentativas; }
    /**
     * @param ArrayCollection $tentativas
     */
    public function setTentativas(ArrayCollection $tentativas): void { $this->tentativas = $tentativas; }
}
