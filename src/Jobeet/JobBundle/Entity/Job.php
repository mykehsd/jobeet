<?php

namespace Jobeet\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Jobeet\JobBundle\Entity\Category;

/**
 * Jobeet\JobBundle\Entity\Job
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Job
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne (targetEntity="Category", inversedBy="jobs")
     * @ORM\JoinColumn (name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string $company
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=false)
     */
    private $company;

    /**
     * @var string $logo
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string $position
     *
     * @ORM\Column(name="position", type="string", length=255, nullable=false)
     */
    private $position;

    /**
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string $how_to_apply
     *
     * @ORM\Column(name="how_to_apply", type="text", nullable=false)
     */
    private $how_to_apply;

    /**
     * @var string $token
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false, unique=true)
     */
    private $token;

    /**
     * @var boolean $is_public
     *
     * @ORM\Column(name="is_public", type="boolean", nullable=false)
     */
    private $is_public = true;

    /**
     * @var boolean $is_activated
     *
     * @ORM\Column(name="is_activated", type="boolean", nullable=false)
     */
    private $is_activated = false;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var timestamp $expires_at
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=false)
     */
    private $expires_at;

    /**
     * @var timestamp $created_at
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @var timestamp $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updated_at;


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
     * Set type
     *
     * @param string $type
     * @return Job
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Job
     */
    public function setCompany($company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Job
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Job
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Job
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Job
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Job
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
     * Set how_to_apply
     *
     * @param string $howToApply
     * @return Job
     */
    public function setHowToApply($howToApply)
    {
        $this->how_to_apply = $howToApply;
    
        return $this;
    }

    /**
     * Get how_to_apply
     *
     * @return string 
     */
    public function getHowToApply()
    {
        return $this->how_to_apply;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Job
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set is_public
     *
     * @param boolean $isPublic
     * @return Job
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;
    
        return $this;
    }

    /**
     * Get is_public
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return Job
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;
    
        return $this;
    }

    /**
     * Get is_activated
     *
     * @return boolean 
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Job
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
     * Set expires_at
     *
     * @param DateTime $expiresAt
     * @return Job
     */
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expires_at = $expiresAt;
    
        return $this;
    }

    /**
     * Get expires_at
     *
     * @return timestamp 
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set category
     *
     * @return timestamp 
     */
    public function setCategory( Category $category )
    {
        return $this->category = $category;
    }    

    /**
     * Get category
     *
     * @return timestamp 
     */
    public function getCategory()
    {
        return $this->category;
    }        

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
          $this->created_at = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function setUpdateAtValue()
    {
        $this->updated_at = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function setExpiresAtValue()
    {
        if ($this->expires_at === null) {
            $expires = new \DateTime();
	    $expires->add(new \DateInterval('P30D'));
            $this->expires_at = $expires;
        }

	return $this;
    }
}
