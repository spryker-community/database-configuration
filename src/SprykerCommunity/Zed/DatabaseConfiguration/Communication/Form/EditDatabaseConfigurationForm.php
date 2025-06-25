<?php

namespace SprykerCommunity\Zed\DatabaseConfiguration\Communication\Form;

use DateTime;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \SprykerCommunity\Zed\DatabaseConfiguration\Communication\DatabaseConfigurationCommunicationFactory getFactory()
 */
class EditDatabaseConfigurationForm extends AbstractType
{
    /**
     * @var string
     */
    protected const FIELD_KEY = 'configuration_key';

    /**
     * @var string
     */
    protected const FIELD_VALUE = 'configuration_value';

    /**
     * @var string
     */
    protected const LABEL_KEY = 'Key';

    /**
     * @var string
     */
    protected const LABEL_VALUE = 'Value';

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'database-configuration';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addNameField($builder)
            ->addValueField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addNameField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_KEY,
            TextType::class,
            [
                'label' => static::LABEL_KEY,
                'required' => true,
                'disabled' => true,
            ],
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addValueField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_VALUE,
            TextType::class,
            [
                'label' => static::LABEL_VALUE,
                'required' => false,
            ],
        );

        return $this;
    }
}
