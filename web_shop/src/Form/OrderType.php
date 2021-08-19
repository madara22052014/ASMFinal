<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Phone;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Phone', EntityType::class, [
            'class' => Phone::class,
            'choice_label' => 'PhoneName',
            'multiple' => true,
            'expanded' => false
            ])
            ->add('Quantity')
            ->add('GuestName');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
