<?php

namespace App\Form;

use App\Entity\Dance;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class, ['label' => 'URL'])
            ->add('date',DateType::class, ['label' => 'Date'])
            ->add('imageFile',VichImageType::class, [
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
            'data_class' => Dance::class,
        ]);
    }
}
