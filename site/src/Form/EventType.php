<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('information',TextType::class, ['label' => 'Information', 'required' => false])
            ->add('date',DateType::class, ['label' => 'Date', 'required' => false])
            ->add('time',TimeType::class, ['label' => 'time', 'required' => false])
            ->add('place',TextType::class, ['label' => 'Place', 'required' => false])
            ->add('lat',NumberType::class, ['label' => 'lattitude', 'required' => false])
            ->add('lng',NumberType::class, ['label' => 'Longitude', 'required' => false])
            ->add('fb',TextType::class, ['label' => 'Facebook', 'required' => false])
            ->add('twttr',TextType::class, ['label' => 'Twitter', 'required' => false])
            ->add('website',TextType::class, ['label' => 'Website', 'required' => false])
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
