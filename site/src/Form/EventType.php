<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class , ['label' => 'Title'])
            ->add('information',TextType::class, ['label' => 'Information'])
            ->add('date',DateType::class, ['label' => 'Date'])
            ->add('time',TimeType::class, ['label' => 'time'])
            ->add('place',TextType::class, ['label' => 'Place'])
            ->add('lat',TextType::class, ['label' => 'lattitude'])
            ->add('lng',TextType::class, ['label' => 'Longitude'])
            ->add('fb',TextType::class, ['label' => 'Facebook'])
            ->add('twttr',TextType::class, ['label' => 'Twitter'])
            ->add('website',TextType::class, ['label' => 'Website'])
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
            'data_class' => Event::class,
        ]);
    }
}
