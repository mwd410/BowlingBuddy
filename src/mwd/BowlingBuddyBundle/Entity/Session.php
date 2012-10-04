<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\Session
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Session {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="Bowler", mappedBy="sessions")
     */
    private $bowlers;
    
    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="session")
     */
    private $games;
    
    /**
     * @ORM\ManyToOne(targetEntity="League", inversedBy="sessions")
     */
    private $league;
    
    /**
     * @ORM\Column(type="date") 
     */
    private $created;

    public function __construct()
    {
        $this->bowlers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created = new \DateTime();
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
     * Add bowlers
     *
     * @param mwd\BowlingBuddyBundle\Entity\Bowler $bowlers
     * @return Session
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

    /**
     * Add games
     *
     * @param mwd\BowlingBuddyBundle\Entity\Game $games
     * @return Session
     */
    public function addGame(\mwd\BowlingBuddyBundle\Entity\Game $games)
    {
        $this->games[] = $games;
        return $this;
    }

    /**
     * Remove games
     *
     * @param <variableType$games
     */
    public function removeGame(\mwd\BowlingBuddyBundle\Entity\Game $games)
    {
        $this->games->removeElement($games);
    }

    /**
     * Get games
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * Set league
     *
     * @param mwd\BowlingBuddyBundle\Entity\League $league
     * @return Session
     */
    public function setLeague(\mwd\BowlingBuddyBundle\Entity\League $league = null)
    {
        $this->league = $league;
        return $this;
    }

    /**
     * Get league
     *
     * @return mwd\BowlingBuddyBundle\Entity\League 
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Set created
     *
     * @param date $created
     * @return Session
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return date 
     */
    public function getCreated()
    {
        return $this->created;
    }
}