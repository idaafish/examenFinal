<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\Categoria;
use App\Entity\ArticuloCategoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticuloCategoriaController extends AbstractController
{
    private $em;

    //Constructor
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function creaCategoria($categoriaID,$UsuarioId): string
    {
       //TODO si sale mal el insert devolver KO
        $oKKo = "ok";

        $articuloCategoria = new ArticuloCategoria();
       
        //rellenamos valores
        $categoria = new Categoria;
        $categoria = $this->em->getRepository(Categoria::class)->find(rand(1,10));
        $articuloCategoria->setCategoria($categoria);

        $usuario = new Usuario();
        $usuario = $this->em->getRepository(Usuario::class)->find(rand(1,10));  
        $articuloCategoria->setUsuario($usuario);
          
        //persistimos
        $this->em->persist($articuloCategoria);

        // ejecutamos la query, por ejemplo, el insertar. 
        $this->em->flush();

       
        return $this->$this->oKKo;
    }
}

