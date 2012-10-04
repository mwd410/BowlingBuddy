<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\League
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class League {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Session", mappedBy="league")
     */
    private $sessions;
    
    /**
     * @ORM\ManyToMany(targetEntity="Bowler", mappedBy="leagues")
     */
    private $bowlers;
    public function __construct()
    {
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bowlers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return League
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add sessions
     *
     * @param mwd\BowlingBuddyBundle\Entity\Session $sessions
     * @return League
     */
    public function addSession(\mwd\BowlingBuddyBundle\Entity\Session $sessions)
    {
        $this->sessions[] = $sessions;
        return $this;
    }

    /**
     * Remove sessions
     *
     * @param <variableType$sessions
     */
    public function removeSession(\mwd\BowlingBuddyBundle\Entity\Session $sessions)
    {
        $this->sessions->removeElement($sessions);
    }

    /**
     * Get sessions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Add bowlers
     *
     * @param mwd\BowlingBuddyBundle\Entity\Bowler $bowlers
     * @return League
     */
    public function addBowler(\mwd\BowlingBuddyBundle\Entity\Bowler $bowlers)
    {
        $this->bowlers[] = $bowlers;
        return $this;
    }

    /**
     * Remove bowlers
     *
     * @param <variableType$bowlers
     */
    public function removeBowler(\mwd\BowlingBuddyBundle\Entity\Bowler $bowlers)
    {
        $this->bowlers->removeElement($bowlers);
    }

    /**
     * Get bowlers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBowlers()
    {
        return $this->bowlers;
    }
}