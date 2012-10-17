<?php

namespace Jobeet\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Jobeet\JobBundle\Entity\Job as Job;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Jobeet\JobBundle\Entity\Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
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
     * @return Category
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
     * __toString
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * getJobs
     * @return array
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    public function getActiveJobs()
    {
        $q = Doctrine_Query::create()
        ->from('JobeetJob j')
        ->where('j.category_id = :category')
        ->setParameter('category', $this->getId());

        return Doctrine::getTable('JobeetJob')->getActiveJobs($q);            
    }

}
