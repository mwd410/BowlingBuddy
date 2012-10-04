<?php

namespace mwd\BowlingBuddyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use mwd\BowlingBuddyBundle\Entity\Account;
use mwd\BowlingBuddyBundle\Entity\Bowler;

class BowlerController extends Controller {

    public function createBowlerAction(Request $request) {
        $name = $request->request->get('name');
        $account = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $bowler = new Bowler();
        $bowler->setName($name);

        $account->addBowler($bowler);
        $bowler->setAccount($account);
        $em->persist($bowler);
        $em->flush();

        return $this->render("BBMainBundle:Bowler:bowler.html.twig", array('bowler' => $bowler, 'mainBowler' => null));
    }

    public function editAction(Request $request) {
        $bowlerId = $request->request->get('bowlerId');
        $bowlerName = $request->request->get('bowlerName');

        //Get bowler by id
        $em = $this
                ->getDoctrine()
                ->getManager();
        $bowler = $em
                ->getRepository("BBMainBundle:Bowler")
                ->find($bowlerId);

        //Change bowler name
        $bowler->setName($bowlerName);
        $em->flush();
        return new Response(json_encode(array('success' => true)));
    }

    public function deleteAction(Request $request) {
        //Get the bowler by id
        $bowlerId = $request->request->get('bowlerId');
        var_dump($bowlerId);
        $em = $this
                ->getDoctrine()
                ->getManager();
        $bowler = $em
                ->getRepository("BBMainBundle:Bowler")
                ->find($bowlerId);

        //Remove bowler
        $account = $this->getUser();
        $account->removeBowler($bowler);
        $em->remove($bowler);
        $em->flush();
        return new Response(json_encode(array('success' => true)));
    }

}

