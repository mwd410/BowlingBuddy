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
class Account implements UserInterface {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=20)
     */
    private $firstName;
    
    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=20)
     */
    private $lastName;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=20, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="accounts")
     */
    private $groups;
    
    /**
     * @ORM\OneToMany(targetEntity="Bowler", mappedBy="account")
     */
    private $bowlers;
    
    /**
     * @ORM\Column(name="mainbowler", type="integer", nullable=true)
     */
    private $mainBowler;
    
    /**
     * @ORM\ManyToMany(targetEntity="Account", mappedBy="myFriends")
     */
    private $friendsWithMe;
    
    /**
     * @ORM\ManyToMany(targetEntity="Account", inversedBy="friendsWithMe")
     * @ORM\JoinTable(name="friends",
     *          joinColumns={@ORM\JoinColumn(name="account_id", referencedColumnName="id")},
     *          inverseJoinColumns={@ORM\JoinColumn(name="friend_account_id", referencedColumnName="id")}
     *          )
     */
    private $myFriends;
    
    /**
     * @var string $created
     *
     * @ORM\Column(name="created", type="date")
     */
    private $created;
    
    public function __construct() {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->groups = new ArrayCollection();
        $this->created = new \DateTime();
        $this->mainBolwer = null;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Account
     */
    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles() {
        return array("ROLE_USER");
//        return $this->getGroups()->toArray();
    }
    
    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        
    }


    /**
     * Set email
     *
     * @param string $email
     * @return Account
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Account
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    /**
     * Get groups
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Add groups
     *
     * @param mwd\BowlingBuddyBundle\Entity\Group $groups
     * @return Account
     */
    public function addGroup(\mwd\BowlingBuddyBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;
        return $this;
    }

    /**
     * Remove groups
     *
     * @param <variableType$groups
     */
    public function removeGroup(\mwd\BowlingBuddyBundle\Entity\Group $groups)
    {
        $this->groups->removeElement($groups);
    }



    /**
     * Add bowlers
     *
     * @param mwd\BowlingBuddyBundle\Entity\Bowler $bowlers
     * @return Account
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
     * Set firstName
     *
     * @param string $firstName
     * @return Account
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Account
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set mainBowler
     *
     * @param integer $mainBowler
     * @return Account
     */
    public function setMainBowler($mainBowler)
    {
        $this->mainBowler = $mainBowler;
        return $this;
    }

    /**
     * Get mainBowler
     *
     * @return integer 
     */
    public function getMainBowler()
    {
        return $this->mainBowler;
    }

    /**
     * Set created
     *
     * @param date $created
     * @return Account
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
     * Add friendsWithMe
     *
     * @param mwd\BowlingBuddyBundle\Entity\Account $friendsWithMe
     * @return Account
     */
    public function addFriendsWithMe(\mwd\BowlingBuddyBundle\Entity\Account $friendsWithMe)
    {
        $this->friendsWithMe[] = $friendsWithMe;
        return $this;
    }

    /**
     * Remove friendsWithMe
     *
     * @param <variableType$friendsWithMe
     */
    public function removeFriendsWithMe(\mwd\BowlingBuddyBundle\Entity\Account $friendsWithMe)
    {
        $this->friendsWithMe->removeElement($friendsWithMe);
    }

    /**
     * Get friendsWithMe
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * Add myFriends
     *
     * @param mwd\BowlingBuddyBundle\Entity\Account $myFriends
     * @return Account
     */
    public function addMyFriend(\mwd\BowlingBuddyBundle\Entity\Account $myFriends)
    {
        $this->myFriends[] = $myFriends;
        return $this;
    }

    /**
     * Remove myFriends
     *
     * @param <variableType$myFriends
     */
    public function removeMyFriend(\mwd\BowlingBuddyBundle\Entity\Account $myFriends)
    {
        $this->myFriends->removeElement($myFriends);
    }

    /**
     * Get myFriends
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMyFriends()
    {
        return $this->myFriends;
    }
}