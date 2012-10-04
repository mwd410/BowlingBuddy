<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\String
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class String {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bowler", inversedBy="strings")
     */
    private $bowler;
    
    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="strings")
     */
    private $game;
    
    /**
     * @ORM\OneToMany(targetEntity="BThrow", mappedBy="string")
     */
    private $throws;
    
    /**
     * @ORM\OneToMany(targetEntity="Frame", mappedBy="string") 
     */
    private $frames;
    
    /**
     * @ORM\Column(type="string", length=255) 
     */
    private $comments;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $practice;
    public function __construct()
    {
        $this->throws = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frames = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set comments
     *
     * @param string $comments
     * @return String
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set practice
     *
     * @param boolean $practice
     * @return String
     */
    public function setPractice($practice)
    {
        $this->practice = $practice;
        return $this;
    }

    /**
     * Get practice
     *
     * @return boolean 
     */
    public function getPractice()
    {
        return $this->practice;
    }

    /**
     * Set bowler
     *
     * @param mwd\BowlingBuddyBundle\Entity\Bowler $bowler
     * @return String
     */
    public function setBowler(\mwd\BowlingBuddyBundle\Entity\Bowler $bowler = null)
    {
        $this->bowler = $bowler;
        return $this;
    }

    /**
     * Get bowler
     *
     * @return mwd\BowlingBuddyBundle\Entity\Bowler 
     */
    public function getBowler()
    {
        return $this->bowler;
    }

    /**
     * Set game
     *
     * @param mwd\BowlingBuddyBundle\Entity\Game $game
     * @return String
     */
    public function setGame(\mwd\BowlingBuddyBundle\Entity\Game $game = null)
    {
        $this->game = $game;
        return $this;
    }

    /**
     * Get game
     *
     * @return mwd\BowlingBuddyBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Add throws
     *
     * @param mwd\BowlingBuddyBundle\Entity\BThrow $throws
     * @return String
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
     * Add frames
     *
     * @param mwd\BowlingBuddyBundle\Entity\Frame $frames
     * @return String
     */
    public function addFrame(\mwd\BowlingBuddyBundle\Entity\Frame $frames)
    {
        $this->frames[] = $frames;
        return $this;
    }

    /**
     * Remove frames
     *
     * @param <variableType$frames
     */
    public function removeFrame(\mwd\BowlingBuddyBundle\Entity\Frame $frames)
    {
        $this->frames->removeElement($frames);
    }

    /**
     * Get frames
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFrames()
    {
        return $this->frames;
    }
}