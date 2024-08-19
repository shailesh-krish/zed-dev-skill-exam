<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeCreateForm extends AbstractType
{
    public const FIELD_NAME = 'name';
    public const FIELD_COLOR = 'color';
    public const FIELD_LOCATION = 'id_location';
    public const LOCATION_CHOICES = 'location_choices';

    public function configureOptions(OptionsResolver $resolver): void
    {
        //parent::configureOptions($resolver);
        $resolver->setDefined([
            static::LOCATION_CHOICES,

        ]);
        $resolver->setRequired([
            static::LOCATION_CHOICES,

        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'antelope';
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $this->addNameField($builder)
            ->addColorField($builder)->addLocationField($builder, $options);
    }

    protected function addLocationField(
        FormBuilderInterface $builder,
        array $options
    ): static {
        $builder->add(static::FIELD_LOCATION, ChoiceType::class,
            [
                'label' => 'Location',
                'placeholder' => 'Choose a location',
                'choices' => array_flip($options[static::LOCATION_CHOICES]),

                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]);

        return $this;
    }

    protected function createNotBlankConstraint(): NotBlank
    {
        return new NotBlank();
    }

    protected function addColorField(FormBuilderInterface $builder
    ): static {
        $builder->add(static::FIELD_COLOR, TextType::class, [
            'constraints' => [
                $this->createNotBlankConstraint(),
            ],
        ]);

        return $this;
    }

    protected function addNameField(FormBuilderInterface $builder): static
    {
        $builder->add(static::FIELD_NAME, TextType::class, [
            'label' => 'Name',
            'constraints' => [
                $this->createNotBlankConstraint(),
            ],
        ]);

        return $this;
    }
}
