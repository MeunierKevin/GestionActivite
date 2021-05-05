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
            ->add('analyseExistant', TextareaType::class,[
                'label'=>"Contexte",'attr'=>['placeholder'=>"Décrivez le contexte actuel de votre solution web si elle existe"]])
            ->add('objectifsDuSite', TextareaType::class,[
                'label'=>"Objectifs",'attr'=>['placeholder'=>"Décrivez les objectifs de site internet"]])
            ->add('cibles', TextareaType::class,[
                'attr'=>['placeholder'=>"Décrivez qui seront les personnes visées par le site"]])
            ->add('fonctionnalites', TextareaType::class,[
                'label'=>"Fonctionnalités",'attr'=>['placeholder'=>"Décrivez les fonctionnalités dont vous avez besoin. Ex: formulaire de contact, page boutique,etc..."]])
            ->add('charteGraphique', TextareaType::class,[
                'label'=>"Charte Graphique",'attr'=>['placeholder'=>"Décrivez les éléments graphiques se rapportant à votre entreprise, typographies, couleurs, logo..."]])
            ->add('contenuDuSite', TextareaType::class,[
                'label'=>"Contenus",'attr'=>['placeholder'=>"Décrivez ce dont vous disposez en terme de contenus(images,textes,ect...) et que vous allez fournir au développeur, et d'autre part ce que le développeur doit créer, toujours en terme de contenu"]])
            ->add('maquettage', TextareaType::class)
            ->add('contraintesTechniques', TextareaType::class,[
                'label'=>"Contraintes Techniques",'attr'=>['placeholder'=>"Décrivez si la solution doit par exemple etre adaptée à un type d'appareil en particulier, ou encore si un langage est à privilégier pour le développement,etc..."]])
            ->add('prestationsDevis', TextareaType::class,[
                'label'=>"Devis",'attr'=>['placeholder'=>"Décrivez tout ce que vous souhaitez voir apparaitre sur le devis"]])
            ->add('dateMaquette', DateType::class, [
                'widget'=>'single_text',
                'label'=>"Maquette"
            ])
            ->add('dateDeveloppement', DateType::class, [
                'widget'=>'single_text',
                'label'=>"Développement"
            ])
            ->add('dateTests', DateType::class, [
                'widget'=>'single_text',
                'label'=>"Tests"
            ])
            ->add('dateMiseEnLigne', DateType::class, [
                'widget'=>'single_text',
                'label'=>"Mise En Ligne"
            ])
            ->add('client',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'nomEntreprise'
            ])
            ->add('typeProjet', EntityType::class,[
                'class'=>TypeProjet::class,
                'choice_label'=>'libelle',
                'label'=>"Type"
            ])
            ->add('images', FileType::class,[
                'label'=>false,
                'multiple'=>true,
                'mapped'=>false,
                'required'=>false
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
