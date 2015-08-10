<?php
namespace Rim\JobeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Rim\JobeetBundle\Utils\Jobeet;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Rim\JobeetBundle\Entity\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{

    private $active_jobs;

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;

    /**
     * @ORM\ManyToMany(targetEntity="Affiliate", mappedBy="categories")
     */
    private $affiliates;

    private $more_jobs;

    public function setMoreJobs($jobs)
    {
        $this->more_jobs = $jobs >= 0 ? $jobs : 0;
    }

    public function getMoreJobs()
    {
        return $this->more_jobs;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setSlugValue()
    {
        $this->slug = Jobeet::slugify($this->getName());
    }
    
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->affiliates = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }

    public function setActiveJobs($jobs)
    {
        $this->active_jobs = $jobs;
    }

    public function getActiveJobs()
    {
        return $this->active_jobs;
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
     * Set jobs
     *
     * @param string $jobs            
     * @return Category
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
        
        return $this;
    }

    /**
     * Get jobs
     *
     * @return string
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * Set affiliates
     *
     * @param string $affiliates            
     * @return Category
     */
    public function setAffiliates($affiliates)
    {
        $this->affiliates = $affiliates;
        
        return $this;
    }

    /**
     * Get affiliates
     *
     * @return string
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }

    /**
     * Add jobs
     *
     * @param \Rim\JobeetBundle\Entity\Job $jobs            
     * @return Category
     */
    public function addJob(\Rim\JobeetBundle\Entity\Job $jobs)
    {
        $this->jobs[] = $jobs;
        
        return $this;
    }

    /**
     * Remove jobs
     *
     * @param \Rim\JobeetBundle\Entity\Job $jobs            
     */
    public function removeJob(\Rim\JobeetBundle\Entity\Job $jobs)
    {
        $this->jobs->removeElement($jobs);
    }

    /**
     * Add affiliates
     *
     * @param \Rim\JobeetBundle\Entity\Affiliate $affiliates            
     * @return Category
     */
    public function addAffiliate(\Rim\JobeetBundle\Entity\Affiliate $affiliates)
    {
        $this->affiliates[] = $affiliates;
        
        return $this;
    }

    /**
     * Remove affiliates
     *
     * @param \Rim\JobeetBundle\Entity\Affiliate $affiliates            
     */
    public function removeAffiliate(\Rim\JobeetBundle\Entity\Affiliate $affiliates)
    {
        $this->affiliates->removeElement($affiliates);
    }
}
