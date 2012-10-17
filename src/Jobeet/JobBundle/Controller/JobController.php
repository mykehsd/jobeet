<?php

namespace Jobeet\JobBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jobeet\JobBundle\Entity\Job;
use Jobeet\JobBundle\Form\JobType;

/**
 * Job controller.
 *
 */
class JobController extends Controller
{
    /**
     * Lists all Job entities.
     *
     */
    public function indexAction()
    {
        $categories = array();
        foreach ($this->get('jobeet_job.job_manager')->getCategoriesWithJobs() as $category)
        {
            $categories[] = array (
                'name' => $category->getName(),
                'active_jobs' => $this->get('jobeet_job.job_manager')->getActiveJobs ( $category, $this->container->getParameter('jobeet_job.max_jobs_on_homepage') )
            );
        }

        return $this->render('JobeetJobBundle:Job:index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * Finds and displays a Job entity.
     *
     */
    public function showAction($company, $location, $id, $position)
    {
        $entity = $this->get('jobeet_job.job_manager')->findActiveJob($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JobeetJobBundle:Job:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Job entity.
     *
     */
    public function newAction()
    {
        $entity = $this->get('jobeet_job.job_manager')->createJob();
        $form   = $this->createForm(new JobType(), $entity);

        return $this->render('JobeetJobBundle:Job:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Job entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = $this->get('jobeet_job.job_manager')->createJob();
        $form = $this->createForm(new JobType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $this->get('jobeet_job.job_manager')->persist($entity);
            $this->get('jobeet_job.job_manager')->flush();

            return $this->redirect($this->generateUrl('job_show', array('id' => $entity->getId())));
        }

        return $this->render('JobeetJobBundle:Job:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Job entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->get('jobeet_job.job_manager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $editForm = $this->createForm(new JobType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JobeetJobBundle:Job:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Job entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->get('jobeet_job.job_manager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new JobType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->get('jobeet_job.job_manager')->persist($entity);
            $this->get('jobeet_job.job_manager')->flush();

            return $this->redirect($this->generateUrl('job_edit', array('id' => $id)));
        }

        return $this->render('JobeetJobBundle:Job:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Job entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $entity = $this->get('jobeet_job.job_manager')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Job entity.');
            }

            $this->get('jobeet_job.job_manager')>remove($entity);
            $this->get('jobeet_job.job_manager')->flush();
        }

        return $this->redirect($this->generateUrl('job'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
