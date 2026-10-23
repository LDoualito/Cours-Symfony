<?php

namespace App\Form;

use App\Entity\Prise;
use App\Entity\Spot;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('espece', TextType::class, [
                'label' => 'Espèce',
                'attr' => [
                    'placeholder' => 'Brochet, sandre, truite...',
                ],
            ])
            ->add('poids', NumberType::class, [
                'label' => 'Poids (en kg)',
                'scale' => 2,
                'attr' => [
                    'placeholder' => '4.20',
                ],
            ])
            ->add('spot', EntityType::class, [
                'label' => 'Spot de pêche',
                'class' => Spot::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisis un spot...',
            ])
            ->add('date', DateType::class, [
                'label' => 'Date de la prise',
                'widget' => 'single_text',
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire',
                'required' => false,
                'attr' => [
                    'rows' => 4,
                    'placeholder' => 'Conditions, technique utilisée...',
                ],
            ])
            ->add('record', CheckboxType::class, [
                'label' => 'Est-ce un record personnel ?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prise::class,
        ]);
    }
}
