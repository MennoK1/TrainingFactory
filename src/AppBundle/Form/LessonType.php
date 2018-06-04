<?php

namespace AppBundle\Form;

use AppBundle\Entity\Person;
use AppBundle\Entity\Training;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('time', TimeType::class, ['label' => 'Duur'])
            ->add('date', DateType::class, ['label' => 'Datum'])
            ->add('location', TextType::class, ['label' => 'Locatie'])
            ->add('maxPersons', IntegerType::class, ['label' => 'Max. personen'])
            ->add('training', EntityType::class, [
                'label' => 'Training',
                'class' => Training::class,
                'choice_label' => 'description'
            ])
            ->add('instructor', EntityType::class, [
                'label' => 'Instructeur',
                'class' => Person::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.is_instructor = 1');
                },
                'choice_label' => function ($person) {
                    return $person->getFirstname() . " " . $person->getLastname();
                }
            ])
            ->add('submit', SubmitType::class, ['label' => 'Toevoegen']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Lesson'
        ));
    }
}
