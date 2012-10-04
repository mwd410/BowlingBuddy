<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event {

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
    private $description;
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $color;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bowler", inversedBy="events") 
     */
    private $bowler;


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
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set color
     *
     * @param smallint $color
     * @return Event
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get color
     *
     * @return smallint 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set bowler
     *
     * @param mwd\BowlingBuddyBundle\Entity\Bowler $bowler
     * @return Event
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