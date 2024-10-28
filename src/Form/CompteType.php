<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Compte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border p-3 w-full outline-0'
                ]
            ])
            ->add('prenom', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border p-3 w-full outline-0'
                ]
            ])
            ->add('login', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border p-3 w-full outline-0'
                ]
            ])
            ->add('password', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border p-3 w-full outline-0'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
