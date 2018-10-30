<?php

namespace App\Controller\Cockpit;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Utils\LoginTools;
use App\Entity\Articles;
class PostsController extends Controller
{
    /**
     * @Route("/cockpit/posts/{page}", name="cockpit_posts", requirements={"page"="\d+"})
     */
    public function posts(LoginTools $a, int $page = 1)
    {
        //var_dump($a->isLoggedIn());
        $resultsLimit = 7;

        $articles = $this->getDoctrine()
            ->getRepository(Articles::class)
            // [TODO] All post of current user or all if admin
        ->findBy(["author" => 6], [
            "createdDate" => "DESC"
        ],$resultsLimit,$resultsLimit*($page-1));

        return $this->render('cockpit/post/posts.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/cockpit/posts/add", name="cockpit_posts_add")
     */
    public function postsAdd(Request $request)
    {
        $article = new Articles();
        $article->setTitle("");
        $article->setText("");

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class)
            ->add('text', TextareaType::class, ['attr' => ["class" => "ckeditor"]])
            ->add('save', SubmitType::class, ['label' => 'Publikuj'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $article = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $article->setCreatedDate((new \DateTime())->getTimestamp());
            $article->setCategory($em->getRepository(\App\Entity\Categories::class)->find(1));
            $article->setAuthor($em->getRepository(\App\Entity\Users::class)->find(6));
            
            $em->persist($article);
            $em->flush();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('cockpit_posts');
        }



        return $this->render('cockpit/post/add_post.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/test", name="aa")
     */
    public function aa(Request $request)
    {
        $content = file_get_contents("a.txt");

        $array = explode("\n", $content);
        foreach ($array as $key => $value) {
            $temp = explode("_|||_", $value);
            
            if (count($temp) == 4)
            {
                $temp = [
                    'city' => $temp[0],
                    'voivodeship' => $temp[1],
                    'latitude' => (float)$temp[2] + (mt_rand(-140,100) / 100000),
                    'longitude' => (float)$temp[3] + (mt_rand(-140,100) / 100000)
                ];
                echo "<a href='https://www.google.pl/maps/@{$temp['latitude']},{$temp['longitude']},18.06z'>{$temp['city']}</a>";
            }
            var_dump($temp); echo "<br>";
        }
        return new Response("");
    }
}
