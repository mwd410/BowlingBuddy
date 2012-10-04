<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountController
 *
 * @author Matt
 */

namespace mwd\BowlingBuddyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use mwd\BowlingBuddyBundle\Entity\Account;
use Group;

class AccountController extends Controller {

    public function createAccountAction(Request $request) {
        //Get the POST parameters.
        $email = $request->request->get('email');
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $confirm = $request->request->get('confirm');
        $first = $request->request->get('first');
        $last = $request->request->get('last');
        
        $json = $request->request->get('json');


        //Verify the POST parameters.
        if (!$username || !$password || !$confirm) {
            return $this->forward("BBMainBundle:Default:register");
        }
        if ($password != $confirm) {
            return $this->forward("BBMainBundle:Default:register");
        }

        //Check if account exists.
        $account = $this->getDoctrine()
                ->getRepository("BBMainBundle:Account")
                ->findOneBy(array('username' => $username));
        if ($account) {
            //Account exists. Make them choose another name.
            return $this->forward("BBMainBundle:Default:register");
        }

        //All set. Create account.
        $account = new Account();
        //encode the password.
        $factory = $this->get("security.encoder_factory");
        $encoder = $factory->getEncoder($account);
        $password = $encoder->encodePassword($password, $account->getSalt());
        //Set parameters.

        $role = $this->getDoctrine()
                ->getRepository("BBMainBundle:Group")
                ->findOneBy(array('name' => "User"));

        $account->setUsername($username)
                ->setPassword($password)
                ->setEmail($email)
                ->setFirstName($first)
                ->setLastName($last)
                ->addGroup($role);

        //Persist account
        $em = $this->getDoctrine()->getManager();
        $em->persist($account);
        $em->flush();

        if ($json) {
            return new Response(json_encode(array(
                "success" => true,
                "username" => $username
                )));
        } else {
            return $this->forward("BBMainBundle:Default:register");
        }
    }

    public function editAction(Request $request) {
        $account = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $mainBowler = $request->request->get('mainBowler');

        var_dump($mainBowler);

        if ($mainBowler) {
            $account->setMainBowler($mainBowler);
        }

        $em->flush();

        return new Response(json_encode(array('success' => true)));
    }

}

?>
