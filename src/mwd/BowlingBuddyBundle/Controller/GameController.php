<?php

namespace mwd\BowlingBuddyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use mwd\BowlingBuddyBundle\Entity\Account;
use mwd\BowlingBuddyBundle\Entity\Bowler;
use mwd\BowlingBuddyBundle\Entity\Game;

class GameController extends Controller {

    public function createAction(Request $request) {
        $sessionId = $request->request->get("sessionId");

        $em = $this
                ->getDoctrine()
                ->getManager();
        $session = $em
                ->getRepository("BBMainBundle:Session")
                ->find($sessionId);

        $game = new Game();
        $game->setSession($session);
        $session->addGame($game);

        $em->persist($game);
        $em->flush();
        
        return $this->render("BBMainBundle:Game:game.html.twig", array("game" => $game, "bowlers" => $this->getUser()->getBowlers()));
    }

}

