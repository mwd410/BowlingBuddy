<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\Frame
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Frame {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="smallint") 
     */
    private $frameNumber;
    
    /**
     * @ORM\OneToMany(targetEntity="BThrow", mappedBy="frame") 
     */
    private $throws;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bowler", inversedBy="frames") 
     */
    private $bowler;
    
    /**
     * @ORM\ManyToOne(targetEntity="String", inversedBy="frames") 
     */
    private $string;
    
    /**
     * @ORM\Column(type="boolean") 
     */
    private $split;
    
    public function __construct()
    {
        $this->throws = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set frameNumber
     *
     * @param smallint $frameNumber
     * @return Frame
     */
    public function setFrameNumber($frameNumber)
    {
        $this->frameNumber = $frameNumber;
        return $this;
    }

    /**
     * Get frameNumber
     *
     * @return smallint 
     */
    public function getFrameNumber()
    {
        return $this->frameNumber;
    }

    /**
     * Set split
     *
     * @param boolean $split
     * @return Frame
     */
    public function setSplit($split)
    {
        $this->split = $split;
        return $this;
    }

    /**
     * Get split
     *
     * @return boolean 
     */
    public function getSplit()
    {
        return $this->split;
    }

    /**
     * Add throws
     *
     * @param mwd\BowlingBuddyBundle\Entity\BThrow $throws
     * @return Frame
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
     * Set bowler
     *
     * @param mwd\BowlingBuddyBundle\Entity\Bowler $bowler
     * @return Frame
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
     * Set string
     *
     * @param mwd\BowlingBuddyBundle\Entity\String $string
     * @return Frame
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
}