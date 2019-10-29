<?php

namespace TestwebreatheBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('datedebut')
            ->add('datefin')
            ->add('sujet')
            ->add('description')
            ->add('piecesaffectees')
            ->add('image',FileType::class, array('label' => 'Image','data_class' => null))
            ->add('Vehicule',EntityType::class,array('class'=>'TestwebreatheBundle\Entity\Vehicule','multiple'=>false,'choice_label'=>'type'))
            ->add('Ajouter',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TestwebreatheBundle\Entity\Operations'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'testwebreathebundle_operations';
    }


}
