<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('company', TextType::class,array(
            'mapped'=> false,
            'label' => 'Company',
            'required'=>true
        ));
        $builder->add('name', TextType::class,array(
            'mapped'=> false,
            'label' => 'Name',
            'required'=>true
        ));
        $builder->add('telephone', TextType::class,array(
            'mapped'=> false,
            'label' => 'Telephone',
            'required'=>true
        ));
        $builder->add('email', EmailType::class,array(
            'mapped'=> false,
            'label' => 'E-mail',
            'required'=>true
        ));
        $builder->add('interest', ChoiceType::class,array(
            'mapped'=> false,
            'label' => 'Area of interest',
            'required'=>true,
            'choices'  => array(
                'Buying' => 'buying',
                'Selling' => 'selling',
                'General' => 'general'
            ),
            'placeholder' => 'Choose an option'
        ));
        $builder->add('details', TextareaType::class,array(
            'mapped'=> false,
            'label' => 'Details',
            'required'=>true
        ));
        $builder->add('contactMethod', ChoiceType::class,array(
            'mapped'=> false,
            'label' => 'Prefered Method Of Contact',
            'required'=>true,
            'choices'  => array(
                'Telephone' => 'telephone',
                'Email' => 'email'
            ),
            'placeholder' => 'Choose an option'
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

}