<?php
namespace Jobeet\JobBundle\Model;

class CategoryManager
{
	// Our entity manager
	private $em;

	/** 
	 * __construct
	 * @param (object) entityManager 
	 * @return null
	 */
	public function __construct( $entityManager )
	{
		$this->em = $entityManager;
	}

	/** 
	 * findBySlug
	 * @param (string) Slug value
	 */
	public function findBySlug ($slug)
	{
		$repository = $this->em->getRepository('JobeetJobBundle:Category');
		$query = $repository->createQueryBuilder('c')
			->where('c.name = :name')
			->setParameter('name', $slug )
			->getQuery();
		try {			
			return $query->getSingleResult();
    	} catch (\Doctrine\Orm\NoResultException $e) {
    		return false;
    	}			

	}

	/**
	 * getCategoriesWithJobs
	 * Returns all categories with at least 1 active job
	 * @return (array) JobeetJobbundle:Category
	 */
	public function getCategoriesWithJobs()
	{
		$repository = $this->em->getRepository('JobeetJobBundle:Category');
		$query = $repository->createQueryBuilder('c')
			->select (array('c', 'j'))
			->leftJoin('c.jobs', 'j')
			->where('j.expires_at > :expires')
			->setParameter('expires', new \DateTime() )
			->getQuery();
		return $query->getResult();
	}	
}