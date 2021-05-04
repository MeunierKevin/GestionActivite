<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Projet;
use App\Entity\TypeProjet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('analyseExistant', TextareaType::class)
            ->add('objectifsDuSite', TextareaType::class)
            ->add('cibles', TextareaType::class)
            ->add('fonctionnalites', TextareaType::class)
            ->add('charteGraphique', TextareaType::class)
            ->add('contenuDuSite', TextareaType::class)
            ->add('maquettage', TextareaType::class)
            ->add('contraintesTechniques', TextareaType::class)
            ->add('prestationsDevis', TextareaType::class)
            ->add('dateMaquette', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('dateDeveloppement', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('dateTests', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('dateMiseEnLigne', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('client',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'nomEntreprise'
            ])
            ->add('typeProjet', EntityType::class,[
                'class'=>TypeProjet::class,
                'choice_label'=>'libelle'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
