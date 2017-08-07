<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;


class CreateFiltersService
{
    /** @var  EntityManagerInterface $em */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
    	$response = array();
    	$categories = $this->em->getRepository('AppBundle:Categories')->findAll();
    	foreach ($categories as $category) {
    		$response[$category->getName()] = array('id'=>$category->getId(), 'nr'=>0, 'subcategory'=>array());
    		$nrProductsPerCategory = 0;
	        foreach ($category->getSubcategories() as $subcategory) {
	        	$nrProductsPerCategory += count($subcategory->getProducts());
                $response[$category->getName()]['subcategory'][$subcategory->getName()] = array(
                    'id' => $subcategory->getId(),
                    'nr' => count($subcategory->getProducts())
                );
	        }
	        $response[$category->getName()]['nr'] = $nrProductsPerCategory;
        };
        return $response;
    }
}