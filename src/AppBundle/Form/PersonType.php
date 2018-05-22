<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('loginname')
            ->add('firstname')
            ->add('preprovision')
            ->add('lastname')
            ->add('dateofbirth', DateType::class)
            ->add('gender', ChoiceType::class, ["choices" => [
                "Man" => "man",
                "Vrouw" => "vrouw"
            ]])
            ->add('emailaddress', EmailType::class)
            ->add('submit', SubmitType::class);
//            ->add('is_instructor')
//            ->add('hiring_date')
//            ->add('salary')
//            ->add('is_member')
//            ->add('street')
//            ->add('postal_code')
//            ->add('place');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Person'
        ));
    }
}
