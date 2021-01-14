<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SearchTransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

                 $builder
                     ->add('search', EntityType::class, [
                         'class' => Product::class,
                         'choice_label' => 'name',
                         'multiple' => true,
                         'expanded' => true,
                         'label' => 'Selectionner: ',
                         'label_attr' => [
                             'class' => 'checkbox-inline'
                         ]
                     ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
