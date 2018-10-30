<?php

namespace App\Controller;

use App\Utils\RouteAnalyzer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Articles;
use App\Entity\Images;

use Symfony\Component\Routing\RouteCollection;

class NewsController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home($page = 1)
    {
        return $this->redirectToRoute('articles');
    }



    /**
     * @Route("/articles/{page}", name="articles", requirements={"page"="\d+"})
     */
    public function articles($page = 1)
    {
        $resultsLimit = 7;

        $articles = $this->getDoctrine()
            ->getRepository(Articles::class)
        ->findBy([], [
            "createdDate" => "DESC"
        ],$resultsLimit,$resultsLimit*($page-1));

        foreach ($articles as $key => $value) {

            $value->setText(strip_tags(substr($value->getText(),0,300)));

        }

        return $this->render('news/index.html.twig', [
            'articles' => $articles,
        ]);
    }



    /**
     * @Route("/article/{id}/{slug}", name="article", requirements={"id"="\d+"})
     */
    public function article($id, $slug = "")
    {

        //echo "<pre>";
        // $routes = $this->get('router')->getRouteCollection();
        // $path = "/articles/123";

        // var_dump( $routes = (new RouteAnalyzer($routes))->isValid($path));


        //var_dump(preg_match($pattern ,$path));
        //echo "</pre>";

        $article = $this->getDoctrine()
            ->getRepository(Articles::class)
        ->find($id);

        if ( $slug == "" )
        {
            return $this->redirectToRoute('article', ["id" => $id, "slug" => str_replace(" ", "-", $article->getTitle())]);
        }

        $image = $this->getDoctrine()
            ->getRepository(Images::class)
        ->findBy(["article" => $article->getId()]);

        return $this->render('news/article.html.twig', [
            'article' => $article,
            'image' => $image,
        ]);
    }
}

