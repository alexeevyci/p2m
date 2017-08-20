<?php

namespace AppBundle\Form;

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

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('company', TextType::class,array(
            'mapped'=> false,
            'label' => 'Company namne',
            'required'=>true
        ));
        // $builder->add('name', TextType::class,array(
        //     'mapped'=> false,
        //     'label' => 'Name',
        //     'required'=>true
        // ));
        $builder->add('telephone', TextType::class,array(
            'mapped'=> false,
            'label' => 'Telephone',
            'required'=>true
        ));
        // $builder->add('email', EmailType::class,array(
        //     'mapped'=> false,
        //     'label' => 'E-mail',
        //     'required'=>true
        // ));
         $builder->add('country', CountryType::class,array(
            'mapped'=> false,
            'label' => 'Country',
            'required'=>true,
            'placeholder' => 'Choose an option'
        ));
        $builder->add('message', TextareaType::class,array(
            'mapped'=> false,
            'label' => 'Message',
            'required'=>true
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