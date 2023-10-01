<?php declare(strict_types=1);

namespace Caremi\FormBuilder;

use Caremi\FormBuilder\Type\TextType;
use Caremi\FormBuilder\Type\EmailType;
use Caremi\FormBuilder\Type\RadioType;
use Caremi\FormBuilder\Type\SelectType;
use Caremi\FormBuilder\Type\SubmitType;
use Caremi\FormBuilder\Type\CheckboxType;
use Caremi\FormBuilder\Type\PasswordType;
use Caremi\FormBuilder\Type\TextareaType;
use Caremi\FormBuilder\Type\MultipleCheckboxType;
use Caremi\FormBuilder\FormBuilderBlueprintInterface;

class FormBuilderBlueprint implements FormBuilderBlueprintInterface
{

    private function args(
        string $name,
        array $class = [],
        mixed $value = null,
        string|null $placeholder = null
    ): array {
        return [
            'name' => $name,
            'class' => array_merge(['uk-input'], $class),
            'placeholder' => ($placeholder !== null) ? $placeholder : '',
            'value' => ($value !== null) ? $value : ''

        ];
    }

    private function arg(
        string $name,
        array $class = [],
        mixed $value = null
    ): array {
        return [
            'name' => $name,
            'class' => $class,
            'value' => ($value !== null) ? $value : ''

        ];
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * @param array $class
     * @param mixed $value
     * @param string|null $placeholder
     * @return array
     */
    public function text(
        string $name,
        array $class = [],
        mixed $value = null,
        bool $disabled = false,
        string|null $placeholder = null
    ): array {
        return [
            TextType::class => [
                array_merge(
                    $this->args($name, $class, $value, $placeholder),
                    ['disabled' => $disabled]
                )
            ]
        ];

    }

    public function textarea(
        string $name,
        array $class = [],
        mixed $id = null,
        string|null $placeholder = null,
        int $rows = 5,
        int $cols = 33,
    ): array {
        return [
            TextareaType::class => [
                'name' => $name,
                'class' => $class,
                'id' => $id,
                'placeholder' => $placeholder,
                'rows' => $rows,
                'cols' => $cols
            ]
        ];

    }


    public function email(
        string $name,
        array $class = [],
        mixed $value = null,
        bool $required = true,
        bool $pattern = false,
        string|null $placeholder = null
    ): array {
        return [
            EmailType::class => [
                array_merge(
                    $this->args($name, $class, $value, $placeholder),
                    ['required' => $required, 'pattern' => $pattern]
                )
            ]
        ];
    }

    public function password(
        string $name,
        array $class = [],
        mixed $value = null,
        string|null $autocomplete = null,
        bool $required = false,
        bool $pattern = false,
        bool $disabled = false,
        string|null $placeholder = null
    ): array {
        return [
            PasswordType::class => [
                array_merge(
                    $this->args($name, $class, $value, $placeholder),
                    ['autocomplete' => $autocomplete, 'required' => $required, 'pattern' => $pattern, 'disabled' => $disabled]
                )
            ]
        ];
    }
    
    /**
     * Undocumented function
     *
     * @param string $name
     * @param array $class
     * @param mixed $value = null
     * @return void
     */
    public function radio(string $name, array $class = [], mixed $value = null): array
    {
        return [
            RadioType::class => [
                array_merge(
                    $this->arg($name, array_merge(['uk-radio'], $class), $value),
                    []
                )
            ]
        ];
    }

    public function checkbox(
        string $name,
        array $class = [],
        mixed $value = null
    ): array {
        return [
            CheckboxType::class => [
                $this->arg($name, array_merge(['uk-checkbox'], $class), $value)
            ]
        ];
    }

    public function select(
        string $name,
        array $class = [],
        string $id = null,
        mixed $size = null
    ): array
    {
        return [
            SelectType::class => [
                'name' => $name,
                'class' => $class,
                'id' => $id,
                'size' => $size
            ]
        ];
    }


    /**
     * Undocumented function
     *
     * @param string $name
     * @param array $class
     * @param mixed $value
     * @return array
     */
    public function multipleCheckbox(
        string $name,
        array $class = [],
        mixed $value = null
    ): array {
        return [
            MultipleCheckboxType::class => [
                $this->arg($name, array_merge(['uk-checkbox'], $class), $value)
            ]
        ];
    }



    public function submit(
        string $name,
        array $class = [],
        mixed $value = null
    ): array {
        return [
            SubmitType::class => [
                $this->arg($name, $class, $value)
            ]
        ];
    }

    /**
     * Undocumented function
     *
     * @param array $choices
     * @return array
     */
    public function choices(array $choices, string|null $default = null): array
    {
        return [
            'choices' => $choices,
            'default' => ($default !==null) ? $default : 'pending'
        ];
    }

    /**
     * Undocumented function
     *
     * @param boolean $inlineFlipIcon
     * @param string $inlineIcon
     * @param boolean $showLabel
     * @param string $newLabel
     * @param boolean $wrapper
     * @return array
     */
    public function settings(bool $inlineFlipIcon = false, string $inlineIcon = null, bool $showLabel = true, string $newLabel = null, bool $wrapper = false, string|null $checkboxLabel = null, string|null $description = null): array
    {
        return [
            'inline_flip_icon' => $inlineFlipIcon,
            'inline_icon' => $inlineIcon,
            'show_label' => $showLabel,
            'new_label' => $newLabel,
            'before_after_wrapper' => $wrapper,
            'checkbox_label' => $checkboxLabel,
            'description' => $description
        ];
    }
}
