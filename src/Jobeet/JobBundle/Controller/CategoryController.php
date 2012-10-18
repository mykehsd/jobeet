<?php
namespace Jobeet\JobBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function showAction($slug, $page)
    {
    	$category = $this->container->get('jobeet_job.category_manager')->findBySlug($slug);
        
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category.');
        }

        $jobs = $this->container->get('jobeet_job.job_manager')->getActiveJobs( $category, $page, 2 );

        return $this->render('JobeetJobBundle:Category:show.html.twig', array(
			'category' 	=> $category,
			'jobs' 		=> $jobs
		));    	
	}
}