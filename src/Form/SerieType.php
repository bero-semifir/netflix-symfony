<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('producteur')
            ->add('description')
            ->add('nombre_episodes')
            ->add(
                'date_sortie',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'attr' => [
                        'class' => 'js-datepicker',
                        'data-provide' => 'datepicker',
                        'data-date-format' => 'yyyy-mm-dd',
                        'data-date-language' => 'fr',
                        'data-date-autoclose' => 'true',
                    ],
                ]
            )
            ->add('Univers');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
