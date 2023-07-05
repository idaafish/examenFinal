<?php

namespace App\Entity;

use App\Repository\ArticuloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticuloRepository::class)]
class Articulo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenido = null;

    #[ORM\OneToMany(mappedBy: 'articulo', targetEntity: Categoria::class)]
    private Collection $categoria;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    public function __construct()
    {
        $this->categoria = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): static
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * @return Collection<int, Categoria>
     */
    public function getCategoria(): Collection
    {
        return $this->categoria;
    }

    public function addCategoria(Categoria $categoria): static
    {
        if (!$this->categoria->contains($categoria)) {
            $this->categoria->add($categoria);
        }

        return $this;
    }

    
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }
}
