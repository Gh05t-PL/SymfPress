<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use App\Entity\Users;
use App\Entity\Images;

class GalleryController extends Controller
{

    /**
     * @Route("/gallery/avatar/{id}", name="gallery_get_avatar", requirements={"id"="\d+"})
     */
    public function getAvatar($id)
    {

        $result = $this->getDoctrine()
            ->getRepository(Users::class)
        ->find($id);

        $response = new Response();
        $response->headers->set('Content-type', 'image/png');
        $response->setContent(stream_get_contents($result->getAvatar()) );
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }



    /**
     * @Route("/gallery/image/{id}", name="gallery_get_image", requirements={"id"="\d+"})
     */
    public function getImage(int $id)
    {
        $result = $this->getDoctrine()
            ->getRepository(Images::class)
        ->findOneBy(['article' => $id]);

        $response = new Response();
        $response->headers->set('Content-type', 'image/png');
        if ( $result === NULL )
            $response->setContent(file_get_contents("noimage.jpg") );
        else
            $response->setContent(stream_get_contents($result->getContent()) );
        
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }



    /**
     * @Route("/galery/avatar/add", name="galery_add")
     */
    public function addAvatar(Request $request)
    {
        // var_dump($request->files->get('userfile')->getPathname());
        // echo file_get_contents($request->files->get('userfile')->getPathname());

        $image = new \App\Entity\Gallery();
        //var_dump( $request->files->all());
        $image->setImage(file_get_contents($request->files->get('userfile')->getPathname()));

        $em = $this->getDoctrine()->getManager();
        $em->persist($image);
        $em->flush();

        return $this->render('banishments/bans.html.twig', [
            'controller_name' => 'PlayersController',
            'bans' => @$result,
        ]);
    }



}
