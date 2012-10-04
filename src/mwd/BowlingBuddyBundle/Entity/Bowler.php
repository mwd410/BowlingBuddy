<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\Account
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Bowler {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=20)
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="bowlers")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    private $account;

    /**
     * @ORM\ManyToMany(targetEntity="Session", inversedBy="bowlers")
     */
    private $sessions;
    
    /**
     * @ORM\ManyToMany(targetEntity="League", inversedBy="bowlers")
     */
    private $leagues;
    
    /**
     * @var string $created
     *
     * @ORM\Column(name="created", type="date")
     */
    private $created;
    
    /**
     * @ORM\OneToMany(targetEntity="String", mappedBy="bowler")
     */
    private $strings;
    
    /**
     * @ORM\OneToMany(targetEntity="BThrow", mappedBy="bowler") 
     */
    private $throws;
    
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="bowler")
     */
    private $events;
    
    /**
     * @ORM\OneToMany(targetEntity="Ball", mappedBy="bowler") 
     */
    private $balls;
    
    public function __construct() {
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
     * Set name
     *
     * @param string $name
     * @return Bowler
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
     * Set account
     *
     * @param mwd\BowlingBuddyBundle\Entity\Account $account
     * @return Bowler
     */
    public function setAccount(\mwd\BowlingBuddyBundle\Entity\Account $account = null)
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Get account
     *
     * @return mwd\BowlingBuddyBundle\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set created
     *
     * @param date $created
     * @return Bowler
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

    /**
     * Add sessions
     *
     * @param mwd\BowlingBuddyBundle\Entity\Session $sessions
     * @return Bowler
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
     * Add leagues
     *
     * @param mwd\BowlingBuddyBundle\Entity\League $leagues
     * @return Bowler
     */
    public function addLeague(\mwd\BowlingBuddyBundle\Entity\League $leagues)
    {
        $this->leagues[] = $leagues;
        return $this;
    }

    /**
     * Remove leagues
     *
     * @param <variableType$leagues
     */
    public function removeLeague(\mwd\BowlingBuddyBundle\Entity\League $leagues)
    {
        $this->leagues->removeElement($leagues);
    }

    /**
     * Get leagues
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLeagues()
    {
        return $this->leagues;
    }

    /**
     * Add strings
     *
     * @param mwd\BowlingBuddyBundle\Entity\String $strings
     * @return Bowler
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

    /**
     * Add throws
     *
     * @param mwd\BowlingBuddyBundle\Entity\BThrow $throws
     * @return Bowler
     */
    public function addThrow(\mwd\BowlingBuddyBundle\Entity\BThrow $throws)
    {
        $this->throws[] = $throws;
        return $this;
    }

    /**
     * Remove throws
     *
     * @param <variableType$throws
     */
    public function removeThrow(\mwd\BowlingBuddyBundle\Entity\BThrow $throws)
    {
        $this->throws->removeElement($throws);
    }

    /**
     * Get throws
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getThrows()
    {
        return $this->throws;
    }

    /**
     * Add events
     *
     * @param mwd\BowlingBuddyBundle\Entity\Event $events
     * @return Bowler
     */
    public function addEvent(\mwd\BowlingBuddyBundle\Entity\Event $events)
    {
        $this->events[] = $events;
        return $this;
    }

    /**
     * Remove events
     *
     * @param <variableType$events
     */
    public function removeEvent(\mwd\BowlingBuddyBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add balls
     *
     * @param mwd\BowlingBuddyBundle\Entity\Ball $balls
     * @return Bowler
     */
    public function addBall(\mwd\BowlingBuddyBundle\Entity\Ball $balls)
    {
        $this->balls[] = $balls;
        return $this;
    }

    /**
     * Remove balls
     *
     * @param <variableType$balls
     */
    public function removeBall(\mwd\BowlingBuddyBundle\Entity\Ball $balls)
    {
        $this->balls->removeElement($balls);
    }

    /**
     * Get balls
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBalls()
    {
        return $this->balls;
    }
}