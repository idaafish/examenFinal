<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Usuario;

class UsuarioController extends AbstractController
{
    
    private $em;
    public $oKKo = true;
    //Constructor
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
   
    #[Route('/usuario', name: 'app_usuario')]
    public function index(): Response
    {
        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'Usuario Controller',
        ]);
    }

    #[Route('/crearUsuario', name: 'crearUsuario')]
    public function new(): Response
    {
        // creamos obj Usuario
        $usuario = new Usuario();

        //rellenamos valores
        $variableRandom =rand(1,5000000);
        $usuario->setNombre("Usuario".$variableRandom);
     

        //persistimos
        $this->em->persist($usuario);


        // ejecutamos la query, por ejemplo, el insertar. 
        $this->em->flush();

       
        return $this->render('usuario/index.html.twig', [
            'controller_name' => "Guarda el Usuario  ".$usuario->getNombre(),
            'usuario' => $usuario,
            'mensage' => $this->oKKo
       ]);
    }
}
