<?php

namespace App\Controller\Api;

use App\Entity\Articles;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostsController extends Controller
{
    /**
     * @Route("api/test", name="TESTer")
     */
    public function tester(Request $request){
        $a = $request->query->get("test");
        return new Response("aaaaaaaaa {$a}");
    }

    /**
     * @Route("/api/posts", name="api_add_post", methods="POST")
     */
    public function addPost(Request $request, Session $session)
    {
        //TODO Dependent on session
        if ( $request->getMethod() == "POST" && $request->request->get("json") !== NULL )
        {
            $json = json_decode($request->request->get("json"));

            $article = new Articles();
            $em = $this->getDoctrine()->getManager();

            $article->setAuthor($em->getRepository(\App\Entity\Users::class)->find(6));
            $article->setTitle($json->title);
            $article->setText($json->text);
            $article->setCreatedDate((new \DateTime())->getTimestamp());
            $article->setCategory($em->getRepository(\App\Entity\Categories::class)->find(1));

            $em->persist($article);
            $em->flush();

            return new JsonResponse([
                'error' => false,
                'message' => "ARTICLE_ADDED"
            ]);

        }
    }



    /**
     * @Route("/api/posts", name="api_edit_post", methods="PUT")
     */
    public function editPost(Request $request, Session $session)
    {
        //TODO Dependent on session
        if ( $request->getMethod() == "PUT" && $request->request->get("json") !== NULL )
        {
            $json = json_decode($request->request->get("json"));

            $em = $this->getDoctrine()->getManager();
            $article = $em->getRepository(\App\Entity\Articles::class)->find($json->id);

            if ( $json->author !== NULL )
                $article->setAuthor($em->getRepository(\App\Entity\Users::class)->find(6));
            if ( $json->title !== NULL )
                $article->setTitle($json->title);
            if ( $json->text !== NULL )
                $article->setText($json->text);
            if ( $json->date !== NULL )
                $article->setCreatedDate((new \DateTime())->getTimestamp());
            if ( $json->category !== NULL )
                $article->setCategory($em->getRepository(\App\Entity\Categories::class)->find(1));

            $em->persist($article);
            $em->flush();

            return new JsonResponse([
                'error' => false,
                'message' => "ARTICLE_EDITED"
            ]);

        }
    }



    /**
     * @Route("/api/posts", name="api_delete_post", methods="DELETE")
     */
    public function deletePost(Request $request, Session $session)
    {
        //TODO Dependent on session
        if ( $request->getMethod() == "DELETE" && $request->request->get("json") !== NULL )
        {
            $json = json_decode($request->request->get("json"));

            if ( !is_iterable($json->id) )
            {
                $em = $this->getDoctrine()->getManager();
                $article = $em->getRepository(\App\Entity\Articles::class)->find($json->id);

                if ( $article !== NULL )
                {
                    $em->remove($article);
                    $em->flush();
                }
            }
            else
            {
                foreach ($json->id as $key => $value)
                {
                    $em = $this->getDoctrine()->getManager();
                    $article = $em->getRepository(\App\Entity\Articles::class)->find($value);

                    if ( $article !== NULL ) {
                        $em->remove($article);
                        $em->flush();
                    }
                }
            }


            return new JsonResponse([
                'error' => false,
                'message' => "ARTICLE_DELETED",
            ]);

        }
        else
        {
            return new JsonResponse([
                'error' => true,
                'message' => "JSON_OBJECT_ERROR"
            ]);
        }
    }
}