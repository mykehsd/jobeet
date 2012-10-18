<?php
namespace Jobeet\JobBundle\Model;

use Jobeet\JobBundle\Entity\Category;

class JobManager
{
	// Our entity manager
	private $em;

	// The default length of time jobs will remain active
	private $active_days;

	private $paginator;
	/** 
	 * __construct
	 * @param (object) entityManager 
	 * @return null
	 */
	public function __construct( $entityManager, $active_days, $paginator )
	{
		$this->em = $entityManager;
		$this->active_days = (int) $active_days;
		$this->paginator = $paginator;
	}

	/**
	 * find
	 * @param (int) PK of Job Entity
	 * @return Entity\Job
	 */
	public function find( $id )
	{        
    	return $this->em->getRepository('JobeetJobBundle:Job')->find($id);
    }

	/**
	 * findActiveJob
	 * @param (int) PK of Job Entity
	 * @return Entity\Job
	 */
	public function findActiveJob( $id )
	{        
		$qb = $this->em->getRepository('JobeetJobBundle:Job')->createQueryBuilder('j');
		$qb->where('j.expires_at > :expires')
			->andWhere('j.id = :id')
			->setParameters( array( 'id' => $id, 'expires' => new \DateTime()));

    	try {
    		return $qb->getQuery()->getSingleResult();
    	} catch (\Doctrine\Orm\NoResultException $e) {
    		return false;
    	}
    }
    
	/** 
	 * getActiveJobs
	 * @param Category
	 * @param int $limit Limit the list of jobs
	 * @return (array) Enttiy\Job
	 */
	public function getActiveJobs( Category $category = null, $page = null, $limit = null )
	{
		$repository = $this->em->getRepository('JobeetJobBundle:Job');
    	$qb =$repository->createQueryBuilder('j');
    	$qb->where('j.expires_at > :expires')
            	->setParameter('expires', new \DateTime() );

        if (null !== $category) {
        	$qb->andWhere('j.category = :id')
        		->setParameter('id', $category->getId() );
        }

        $jobs = $this->paginator->paginate($qb, $page, $limit); 

        return $jobs;
		
	}

	/**
	 * getDefaultActiveDays
	 * @return (int) active_days
	 */
	public function getDefaultActiveDays()
	{
		return $this->active_days;
	}

	/**
	 * createJob
	 * Returns our entity object
	 */
	public function createJob()
	{
		return new Jobeet\JobBundle\Entity\Job;
	}

	/**
	 * Persist entity change
	 */
	public function persist($entity)
	{
		return $this->em->persist($entity);
	}

	/**
	 * Remove Job
	 */
	public function remove ($entity)
	{
		return $this->em->remove($entity);
	}

	/**
	 * Flush entity changes
	 */
	public function flush()
	{
		return $this->em->flush();
	}
}
