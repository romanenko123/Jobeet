<?php
namespace Rim\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Rim\JobeetBundle\Entity\Category;
use Rim\JobeetBundle\Entity\Job;

class CategoryController extends Controller
{

    /**
     * @Route("/category/{slug}/{page}", name="category_show", defaults={"page" = 1})
     * @Template()
     */
    public function showAction($slug, $page)
    {
        $em = $this->getDoctrine()->getManager();
        
        $category = $em->getRepository('RimJobeetBundle:Category')->findOneBySlug($slug);
        if (! $category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }
        
        $jobsQuery = $em->getRepository('RimJobeetBundle:Job')->getActiveJobsQuery($category->getId());
        
        $jobsPaginator = $this->get('knp_paginator');
        
        $pagination = $jobsPaginator->paginate($jobsQuery, $this->getRequest()->query->get('page', $page), $this->getParameter('max_jobs_on_category'));
        
        return array(
            'category' => $category,
            'pagination' => $pagination
        );
    }
}
