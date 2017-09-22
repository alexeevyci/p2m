<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use AppBundle\Entity\Categories;
use AppBundle\Entity\Subcategories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ContactType extends AbstractType
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $machineTypeAsArray = $this->getMachineTypeAsArray();

        $builder->add('name', TextType::class,array(
            'mapped'=> false,
            'label' => 'Name',
            'required'=>true
        ));
        $builder->add('company', TextType::class,array(
            'mapped'=> false,
            'label' => 'Company',
            'required'=>true
        ));
        $builder->add('city', TextType::class,array(
            'mapped'=> false,
            'label' => 'City',
            'required'=>true
        ));
        $builder->add('contactNumber', TextType::class,array(
            'mapped'=> false,
            'label' => 'Contact Number',
            'required'=>true
        ));
         $builder->add('email', EmailType::class,array(
             'mapped'=> false,
             'label' => 'Email Address',
             'required'=>true
         ));
         $builder->add('country', CountryType::class,array(
            'mapped'=> false,
            'label' => 'Country',
            'required'=>true,
            'placeholder' => 'Choose an option'
        ));
        $builder->add('comment', TextareaType::class,array(
            'mapped'=> false,
            'label' => 'Comments',
            'required'=>true
        ));
        $builder->add('productCategory', EntityType::class, array(
            'mapped'=> false,
            'label' => 'Product Category',
            'class' => 'AppBundle:Categories',
            'required' => false
        ));
        $builder->add('machineType', ChoiceType::class, array(
            'mapped'=> false,
            'label' => 'Machine Type',
            'choices' => $machineTypeAsArray,
            'required' => false
        ));
        $builder->add('modelPurpose', TextType::class,array(
            'mapped'=> false,
            'label' => 'Model',
            'required'=>true,
            'required' => false
        ));
        $builder->add('machinePurpose', TextType::class,array(
            'mapped'=> false,
            'label' => 'Machine Purpose',
            'required'=>true,
            'required' => false
        ));
        $builder->add('send', SubmitType::class, array(
        	'label' => 'Send',
		    'attr' => array('class' => 'btn btn-lime'),
		));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Newsletter'
        ));
    }

    private function getMachineTypeAsArray() {
        $firstCategory = $this->em->getRepository('AppBundle:Categories')->findOneBy(array());
        $machineTypeAsArray = array();
        if($firstCategory) {
            foreach ($firstCategory->getSubcategories() as $machineType) {
                /**
                 * @var Subcategories $machineType
                 */
                $machineTypeAsArray[$machineType->getName()] = $machineType->getId();
            }
        }
        return $machineTypeAsArray;
    }

}