<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\ArticuloCategoriaController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Usuario;
use App\Entity\Articulo;
use App\Entity\Categoria;
use App\Entity\ArticuloCategoria;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;

class ArticuloController extends AbstractController
{

    private $em;
    public $oKKo = true;
    //Constructor
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    // TODAS las articulo
    #[Route('/todasArticulo', name: 'all_articulo')]
    public function indexAll(): Response
    {
        $articulo = $this->em->getRepository(Articulo::class)->findAll();
        
        return $this->render('articulo/index.html.twig', [
            'articulo' => $articulo,
        ]);
    }

     // TODO ??
    #[Route('/articulo', name: 'app_articulo')]
    public function index(): Response
    {
        $articulo = new Articulo();
        $usuario = new Usuario();
        $categoria = new Categoria();
        $articulo->setUsuario($usuario);
        // TODO ver categoria
     

        return $this->render('articulo/index.html.twig', [
            'controller_name' => 'ArticuloController',
            'articulo' => $articulo,
            'mensage' => $this->oKKo
        ]);
    }

    // Crea Cita
    #[Route('/crearArticulo', name: 'crearArticulo')]
    public function new(): Response
    {
        // creamos obj Articulo
        $articulo = new Articulo();

        //rellenamos valores
        $variableRandom =rand(1,5000000);
        $articulo->setTitulo(" el titulo es ".$variableRandom);
        $articulo->setContenido(" BLA BLA BLA ".$variableRandom." BLA BLA BLA");
     
        $usuario = new Usuario();
        $usuario = $this->em->getRepository(Usuario::class)->find(rand(1,10));    
        $articulo->setUsuario($usuario);

         //persistimos
         $this->em->persist($articulo);

         // ejecutamos la query, por ejemplo, el insertar. 
         $this->em->flush();
        
        $categoria = new Categoria();

        //TODO llamar a la funcion que crea el articuloCAtegoria de su controller
        $articuloCategoria = new ArticuloCategoria();
       
        //rellenamos valores
        $categoria = new Categoria;
        $categoria = $this->em->getRepository(Categoria::class)->find(rand(1,10));
        $articuloCategoria->setCategoria($categoria);

        //$articulo = new Articulo();
        //$articulo = $this->em->getRepository(Articulo::class)->find(rand(1,10));  
        $articuloCategoria->setArticulo($articulo);
		          
        //persistimos
        $this->em->persist($articuloCategoria);

        // ejecutamos la query, por ejemplo, el insertar. 
        $this->em->flush();
                           
       

       
        return $this->render('articulo/index.html.twig', [
            'controller_name' => "la articulo es ".$articulo->getId(),
            'articulo' => $articulo,
            'categoria' => $categoria,
            'mensage' => $this->oKKo
       ]);
    }

    // cambia articulo
    #[Route('/cambiarArticulo/{request,id}', name: 'cambiarArticulo')]
    public function update(Request $request): Response
    {

        $idRequest = $request->request->get('id');
        // creamos obj Articulo
        $articulo = new Articulo();
        $articulo = $this->em->getRepository(Articulo::class)->find($idRequest);

        if (!$articulo) {
            throw $this->createNotFoundException('No se encontró la articulo con el ID: '.$idRequest);
        } else {
   
            $usuario = new Usuario();
            $usuario = $this->em->getRepository(Usuario::class)->find(rand(11,13));    
            $articulo->setUsuario($usuario);
    
            //persistimos
            $this->em->persist($articulo);
    
              // ejecutamos la query, por ejemplo, el insertar. 
            $this->em->flush();
        }  

   
        return $this->render('articulo/index.html.twig', [
            'controller_name' => "se ha modificado el usuario ".$usuario->getNombre()." a la articulo ".$articulo->getId(),
            'articulo' => $articulo,
            'mensage' => $this->oKKo
       ]);
    }

    // eliminar articulo
    #[Route('/eliminarArticulo/{request,id}', name: 'eliminarArticulo')]
    public function eliminarCita(Request $request): Response
    {
        $idRequest = $request->request->get('id');
        $articulo = $this->em->getRepository(Articulo::class)->find($idRequest);

        if (!$articulo) {
            throw $this->createNotFoundException('No se encontró el articulo con el ID: '.$idRequest);
        }

        $articulo = new Articulo();
        $usuario = new Usuario();
        $categoria = new Categoria();
        $articulo->setUsuario($usuario);

        //eliminamos la articulo seleccionada
        $this->em->remove($articulo);
        $this->em->flush();

        //TODO Eliminar relacion tabla intermedia

        return $this->render('articulo/index.html.twig', [
            'controller_name' => "se ha eliminado el articulo ",
            'articulo' => $articulo,
            'mensage' => $this->oKKo
       ]);
    }

    #[Route('/mostrarArticulo/{request,id}', name: 'mostrarArticulo')]
    public function mostrar(Request $request): Response
    {
        $idRequest=$request->request->get('id');
         // creamos obj Articulo
         $articulo = new Articulo();
         $articulo = $this->em->getRepository(Articulo::class)->find($idRequest);
 
         if (!$articulo) {
             throw $this->createNotFoundException('No se encontró el Articulo con el ID: '.$idRequest);
         } 

        return $this->render('articulo/index.html.twig', [
            'controller_name' => "esta es tu articulo ".$articulo->getId(),
            'articulo' => $articulo,
            'mensage' => $this->oKKo
       ]);
    }


}
