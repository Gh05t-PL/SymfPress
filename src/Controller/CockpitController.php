<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CockpitController extends Controller
{
    /**
     * @Route("/cockpit", name="cockpit")
     */
    public function index()
    {
        return $this->render('cockpit/post/add_post.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
}
