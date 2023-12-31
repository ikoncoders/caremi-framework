<?php declare(strict_types=1);

namespace Caremi\FormBuilder\Type;

use Caremi\FormBuilder\FormExtensionTypeInterface;
use Caremi\Utility\Yaml;

class PasswordType extends InputType implements FormExtensionTypeInterface
{

    /** @var string - this is the text type extension */
    protected string $type = 'password';
    /** @var array - returns the defaults for the input type */
    protected array $defaults = [];

    /**
     * @inheritdoc
     *
     * @param array $fields
     * @param mixed $options
     * @param array $settings
     */
    public function __construct(array $fields, $options = null, array $settings = [])
    {
        /* Assigned arguments to parent InputType constructor */
        parent::__construct($fields, $options, $settings);
    }

    /**
     * @inheritdoc
     *
     * @param array $extensionOptions
     * @return void
     */
    public function configureOptions(array $extensionOptions = []): void
    {
        $this->defaults = [
            /**
             * An <input> element with type="password" that must contain 8 or more 
             * characters that are of at least one number, and one uppercase and 
             * lowercase letter:
             */
            'maxlength' => '',
            'minlength' => '',
            'placeholder' => '',
            'size' => '',
            'value' => '',
            'readonly' => false,
            'pattern' => Yaml::file('app')['security']['password_pattern'],
            'title' => 'Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters'
        ];

        parent::configureOptions($this->defaults);
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getExtensionDefaults() : array
    {
        return $this->defaults;
    }

    /**
     * Publicize the default object options to the base class
     *
     * @return array
     */
    public function getOptions() : array
    {
        return parent::getOptions();
    }

    /**
     * Return the third argument from the add() method. This array can be used
     * to modify and filter the final output of the input and HTML wrapper
     *
     * @return array
     */
    public function getSettings() : array
    {
        return parent::getSettings();
    }


}