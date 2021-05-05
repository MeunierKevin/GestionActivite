<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\TypeClient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder    
            ->add('nomEntreprise', TextType::class,[
                'label'=>"Raison Sociale",'attr'=>['placeholder'=>"Nom de l'entreprise"]])
            ->add('presentationEntreprise', TextareaType::class,[
                'label'=>"Présentation",'attr'=>['placeholder'=>"Description de l'entreprise"]])
            ->add('prenomContact', TextType::class,[
                'label'=>"Prénom Du Contact",'attr'=>['placeholder'=>"Prénom"]])
            ->add('nomContact', TextType::class,[
                'label'=>"Nom Du Contact",'attr'=>['placeholder'=>"Nom"]])
            ->add('adresse', TextType::class,[
                'label'=>"Adresse",'attr'=>['placeholder'=>"Adresse de l'entreprise"]])
            ->add('telephone', TextType::class,[
                'label'=>"Téléphone",'attr'=>['placeholder'=>"Téléphone Contact"]])
            ->add('email', EmailType::class,[
                'label'=>"Email",'attr'=>['placeholder'=>"Email Contact"]])  
            ->add('typeClient',EntityType::class,[
                'class'=>TypeClient::class,
                'choice_label'=>'libelle'
            ])        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
