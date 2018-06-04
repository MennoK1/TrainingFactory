<?php
/**
 * Created by PhpStorm.
 * User: Tepelstreeltje
 * Date: 1-6-2018
 * Time: 12:09
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingsformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('description');
        $builder->add('duration');
        $builder->add('extraCosts');
        $builder->add('submit', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Training'
        ));
    }
}