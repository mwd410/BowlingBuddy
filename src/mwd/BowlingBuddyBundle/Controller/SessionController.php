<?php

namespace mwd\BowlingBuddyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use mwd\BowlingBuddyBundle\Entity\Account;
use mwd\BowlingBuddyBundle\Entity\Bowler;
use mwd\BowlingBuddyBundle\Entity\Session;


class SessionController extends Controller {

    public function createAction(Request $request) {
        $bowlerId = $request->request->get("bowlerId");
        var_dump($bowlerId);
        //Get bowler by id
        $em = $this
                ->getDoctrine()
                ->getManager();
        $bowler = $em
                ->getRepository("BBMainBundle:Bowler")
                ->find($bowlerId);
        
        if ($bowler->getAccount()->getId() != $this->getUser()->getId()) {
            return new Response();
        }
        
        $session = new Session();
        $bowler->addSession($session);
        $session->addBowler($bowler);
        $em->persist($session);
        
        $em->flush();
        
        return $this->render("BBMainBundle:Session:session.html.twig", array("session" => $session));
    }
    
}

