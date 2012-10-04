<?php
/**
 * Written by Matt Deady 2012-09-23
 * mwd410@comcast.net 
 * 
 * Updated 2012-09-25
 */
namespace mwd\BowlingBuddyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use mwd\BowlingBuddyBundle\Entity\Account;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('BBMainBundle:Default:index.html.twig');
    }

    public function registerAction() {
        return $this->render("BBMainBundle:Default:register.html.twig");
    }

    

}