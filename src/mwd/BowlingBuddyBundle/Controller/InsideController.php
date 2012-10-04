<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mwd\BowlingBuddyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use mwd\BowlingBuddyBundle\Entity\Account;

class InsideController extends Controller {

    public function historyAction($id = "") {
        $bowler = null;
        if ($id == "") {
            $id = $this->getUser()->getMainBowler();
        }
        if ($id != "") {
            $bowler = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository("BBMainBundle:Bowler")
                    ->find($id);
        } 
        $bowlers = array_reverse($this->getUser()->getBowlers()->toArray());

        return $this->render("BBMainBundle:Inside:history.html.twig", array("bowler" => $bowler, "bowlers" => $bowlers));
    }

    public function accountAction() {
        $bowlers = array_reverse($this->getUser()->getBowlers()->toArray());
        $mainBowler = $this->getuser()->getMainBowler();
        return $this->render("BBMainBundle:Inside:account.html.twig", array('bowlers' => $bowlers, 'mainBowler' => $mainBowler));
    }

}

?>
