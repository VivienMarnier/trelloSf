<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 16:48
 */

namespace AppBundle\Form;


use AppBundle\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('description');
        $builder->add('status',ChoiceType::class,['choices' =>['Open' => Task::STATUS_OPEN,'Closed' => Task::STATUS_CLOSED]]);
        $builder->add('category',EntityType::class,['class' => 'AppBundle\Entity\Category','choice_label' => 'name']);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_task';
    }
}