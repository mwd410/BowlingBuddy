<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\BThrow
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BThrow {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    const NEW_THROW = 0;
    
    const FIRST = 1;
    
    const STRIKE = 2;
    
    const SPARE = 3;
    
    const OPEN = 4;
    
    const TENTH = 5;
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $state;
    
    /**
     * @ORM\ManyToOne(targetEntity="Frame", inversedBy="throws")
     */
    private $frame;
    
    /**
     * @ORM\ManyToOne(targetEntity="String", inversedBy="throws") 
     */
    private $string;
    
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $pins;
    
    /**
     * @ORM\Column(type="smallint") 
     */
    private $score;
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $runningTotal;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ball", inversedBy="throws")
     */
    private $ball;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bowler", inversedBy="throws") 
     */
    private $bowler;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $foul;
    

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
     * Set state
     *
     * @param smallint $state
     * @return BThrow
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return smallint 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set pins
     *
     * @param string $pins
     * @return BThrow
     */
    public function setPins($pins)
    {
        $this->pins = $pins;
        return $this;
    }

    /**
     * Get pins
     *
     * @return string 
     */
    public function getPins()
    {
        return $this->pins;
    }

    /**
     * Set score
     *
     * @param smallint $score
     * @return BThrow
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * Get score
     *
     * @return smallint 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set runningTotal
     *
     * @param smalling $runningTotal
     * @return BThrow
     */
    public function setRunningTotal($runningTotal)
    {
        $this->runningTotal = $runningTotal;
        return $this;
    }

    /**
     * Get runningTotal
     *
     * @return smalling 
     */
    public function getRunningTotal()
    {
        return $this->runningTotal;
    }

    /**
     * Set foul
     *
     * @param boolean $foul
     * @return BThrow
     */
    public function setFoul($foul)
    {
        $this->foul = $foul;
        return $this;
    }

    /**
     * Get foul
     *
     * @return boolean 
     */
    public function getFoul()
    {
        return $this->foul;
    }

    /**
     * Set frame
     *
     * @param mwd\BowlingBuddyBundle\Entity\Frame $frame
     * @return BThrow
     */
    public function setFrame(\mwd\BowlingBuddyBundle\Entity\Frame $frame = null)
    {
        $this->frame = $frame;
        return $this;
    }

    /**
     * Get frame
     *
     * @return mwd\BowlingBuddyBundle\Entity\Frame 
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * Set string
     *
     * @param mwd\BowlingBuddyBundle\Entity\String $string
     * @return BThrow
     */
    public function setString(\mwd\BowlingBuddyBundle\Entity\String $string = null)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * Get string
     *
     * @return mwd\BowlingBuddyBundle\Entity\String 
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * Set ball
     *
     * @param mwd\BowlingBuddyBundle\Entity\Ball $ball
     * @return BThrow
     */
    public function setBall(\mwd\BowlingBuddyBundle\Entity\Ball $ball = null)
    {
        $this->ball = $ball;
        return $this;
    }

    /**
     * Get ball
     *
     * @return mwd\BowlingBuddyBundle\Entity\Ball 
     */
    public function getBall()
    {
        return $this->ball;
    }

    /**
     * Set bowler
     *
     * @param mwd\BowlingBuddyBundle\Entity\Bowler $bowler
     * @return BThrow
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
}