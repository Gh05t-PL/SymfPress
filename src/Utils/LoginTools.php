<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
//Symfony\Component\HttpFoundation\Session\SessionInterface
use Doctrine\ORM\EntityManagerInterface;

class LoginTools {

    private $em, $session;

    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    function isLoggedIn()
    {
        if ( $this->session->get("user") !== NULL )
        {
            return true;
        }
        return false;
    }

    function getAccess(Session $session)
    {
        $user = $this->em->getRepository(Users::class)->find($session->get("user")->id);

        $access = $user->getAccess();

        return $access;
    }

}