<?php

namespace mwd\BowlingBuddyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * mwd\BowlingBuddyBundle\Entity\Ball
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ball {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bowler", inversedBy="balls") 
     */
    private $bowler;
    
    /**
     * @ORM\Column(type="string", length=20) 
     */
    private $name;
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $pounds;
    
    /**
     * @ORM\OneToMany(targetEntity="BThrow", mappedBy="ball") 
     */
    private $throws;
    
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
     * Set name
     *
     * @param string $name
     * @return Ball
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
     * Set pounds
     *
     * @param smallint $pounds
     * @return Ball
     */
    public function setPounds($pounds)
    {
        $this->pounds = $pounds;
        return $this;
    }

    /**
     * Get pounds
     *
     * @return smallint 
     */
    public function getPounds()
    {
        return $this->pounds;
    }

    /**
     * Set bowler
     *
     * @param mwd\BowlingBuddyBundle\Entity\Bowler $bowler
     * @return Ball
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
     * Add throws
     *
     * @param mwd\BowlingBuddyBundle\Entity\BThrow $throws
     * @return Ball
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
}