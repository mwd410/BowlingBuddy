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

    public function getInfoAction($id) {

        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository("BBMainBundle:Game")->find($id);

//        $accountId = $game->getAcount()->getId();

        if (is_null($game)) {
            $ret = json_encode(array(
                "success" => false,
                "message" => "The game with id ".$id." could not be found."
            ));
        } else {
            $ret = json_encode(array(
                "success" => true,
                "content" => "",
                "game" => $game->encode(3)
            ));
        }
        return new Response($ret);
    }


}

