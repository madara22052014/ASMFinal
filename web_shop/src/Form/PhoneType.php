<?php

namespace App\Form;

use App\Entity\Phone;
use App\Entity\Publisher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('PhoneName')
            ->add('OperatingSystem')
            ->add('Memory')
            ->add('RAM')
            ->add('Dimension')
            ->add('Price')
            ->add('Publisher', EntityType::class, [
            'class' => Publisher::class,
            'choice_label' => "CompanyName",
            ])
            -> add('Image', FileType::class,
            [
                'label' => 'Phone Image',
                'data_class' => null,
                'required' => is_null($builder->getData()->getImage())
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }
}
