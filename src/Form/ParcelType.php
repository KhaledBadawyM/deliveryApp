<?php

namespace App\Form;

use App\Entity\Parcel;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ParcelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('pickUp')
            ->add('dropOff')
//            ->add('status', HiddenType::class, [
//            ])
//            ->add('pickedAt', HiddenType::class)
//            ->add('deliveredAt', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parcel::class,
            'user' => null
        ]);
    }
}
