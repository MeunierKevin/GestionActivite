<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\TypeImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('urlImage', UrlType::class,[
                'attr' => [
                    'placeholder' => "URL de l'image"
                ]
            ])
            ->add('typeImage', TypeImage::class,[
                'choice_label'=>'libelle'
            ])
            ->add('imageFile',FileType::class,['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
