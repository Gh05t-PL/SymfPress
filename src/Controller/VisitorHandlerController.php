<?php

namespace App\Controller;

use Piwik\Validators\DateTime;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

use App\Entity\Visits;

use App\Utils\RouteAnalyzer;

class VisitorHandlerController extends Controller
{
    /**
     * @Route("/visitor/handler", name="visitor_handler")
     */
    public function index(Request $request)
    {

        /**
         * JSON
         * {
         *   "href": "https://www.xxx.pl/yyy/24736254e?wersja=360p&ad=25",
         *   "ancestorOrigins": {},
         *   "origin": "https://www.xxx.pl",
         *   "protocol": "https:",
         *   "host": "www.xxx.pl",
         *   "hostname": "www.xxx.pl",
         *   "port": "",
         *   "pathname": "/yyy/24736254e",
         *   "search": "?wersja=360p&ad=25",
         *   "hash": ""
         *  }
         */


//        echo "<pre>";
//        $routes = $this->get('router')->getRouteCollection();
//
//        var_dump($routes);
//        echo "</pre>";

        $response = new Response();

        $cookieVId = null;
        //echo $request->request->get("jsonData");
        if ( $request->request->get("jsonData") !== NULL )
        {
            if ( $request->cookies->get("vId") === NULL )
            {
                $cookieVId = sha1(random_bytes(24));
                $response->headers->setCookie(new Cookie('vId', $cookieVId, new \DateTime("now + 40 years")));
            }

            $json = $request->request->get("jsonData");

            $json = json_decode($json);
            $routeAnalyzer = new RouteAnalyzer($this->get('router')->getRouteCollection());
            if ( !$routeAnalyzer->isValid(\urldecode($json->pathname)) )
            {
                return new Response("Not Valid",404);
            }
            $visit = new Visits();

            $visit->setIp(preg_replace("/(\d+).(\d+)$/","X.X", $_SERVER['REMOTE_ADDR']));
            $visit->setDatetime(new \DateTime());
            $visit->setPath($json->pathname);
            $visit->setIdentifier($request->cookies->get("vId") ? $request->cookies->get("vId") : $cookieVId);

            $em = $this->getDoctrine()->getManager();
            $em->persist($visit);
            $em->flush();

            $response->setContent("");
            $response->setStatusCode(200);
            return $response;
        }







        return new Response("No request",404);
    }
}
