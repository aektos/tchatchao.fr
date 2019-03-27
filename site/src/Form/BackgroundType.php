<?php

namespace App\Form;

use App\Entity\Background;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BackgroundType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('section', HiddenType::class, ['label' => 'Section'])
            ->add('largeFile',VichImageType::class, [
                'label' => 'Image',
                'required' => false,
                'allow_delete' => true,
                'image_uri' => true,
                'download_uri' => false
            ])
            ->add('mediumFile',VichImageType::class, [
                'label' => 'Image',
                'required' => false,
                'allow_delete' => true,
                'image_uri' => true,
                'download_uri' => false
            ])
            ->add('smallFile',VichImageType::class, [
                'label' => 'Image',
                'required' => false,
                'allow_delete' => true,
                'image_uri' => true,
                'download_uri' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Background::class,
        ]);
    }
}
