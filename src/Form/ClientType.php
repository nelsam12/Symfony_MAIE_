<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Compte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('surname', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border p-3 w-full outline-0'
                ]
            ])
            ->add('telephone',
            TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border p-3  w-full outline-0'
                ]
            ])
            ->add('adresse', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border p-3  w-full outline-0'
                ]
            ])

            ->add('addCompte', CheckboxType::class, [
                'required' => false,
                'label' => 'Créer un compte',
                'mapped' => false,
                'attr' => [
                    'class' => 'border p-2 px-6 border-blue-800 hover:bg-blue-800 hover:text-white text-blue-800'
                ]
            ])
            ->add('compte', CompteType::class, [
                'required' => false,
                'label' => false,               
            ])
            
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
