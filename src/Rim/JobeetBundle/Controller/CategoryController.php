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
     * @Route("/category/{slug}", name="category_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        
        $category = $em->getRepository('RimJobeetBundle:Category')->findOneBySlug($slug);
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }
        
        $category->setActiveJobs($em->getRepository('RimJobeetBundle:Job')->getActiveJobs($category->getId()));
        
        return array('category' => $category);
    }
}
