<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\Game
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Game {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $number;
    
    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="games")
     */
    private $session;
    
    /**
     * @ORM\OneToMany(targetEntity="String", mappedBy="game")
     */
    private $strings;
    
    public function __construct()
    {
        $this->strings = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set session
     *
     * @param mwd\BowlingBuddyBundle\Entity\Session $session
     * @return Game
     */
    public function setSession(\mwd\BowlingBuddyBundle\Entity\Session $session = null)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Get session
     *
     * @return mwd\BowlingBuddyBundle\Entity\Session 
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Add strings
     *
     * @param mwd\BowlingBuddyBundle\Entity\String $strings
     * @return Game
     */
    public function addString(\mwd\BowlingBuddyBundle\Entity\String $strings)
    {
        $this->strings[] = $strings;
        return $this;
    }

    /**
     * Remove strings
     *
     * @param <variableType$strings
     */
    public function removeString(\mwd\BowlingBuddyBundle\Entity\String $strings)
    {
        $this->strings->removeElement($strings);
    }

    /**
     * Get strings
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getStrings()
    {
        return $this->strings;
    }
    
    public function getNumber() {
        return $this->number;
    }
    
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }
    
    public function encode($recurseDepth = 0) {
        $ret = array();
        
        $ret["id"] = $this->getId();
        $ret["number"] = 0; // TODO fix this.
        if (is_int($recurseDepth) && $recurseDepth > 0) {
            $strings = array();
            $recurseDepth--;
            foreach ($this->getStrings() as $string) {
                $strings[] = $string->encode($recurseDepth);
            }
            $ret["strings"] = $strings;
        }
        
        return $ret;
    }
    
    public function decode($json) {
        if (!is_string($json)) {
            $json = json_decode($json);
        }
        $this->setNumber($json["number"]);
    }
}