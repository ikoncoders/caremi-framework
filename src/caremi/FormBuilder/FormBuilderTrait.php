<?php declare(strict_types=1);

namespace Caremi\FormBuilder;

use Caremi\Utility\Stringify;
use Caremi\FormBuilder\FormBuilderBlueprintInterface;
use Caremi\FormBuilder\Exception\FormBuilderOutOfBoundsException;
use Caremi\FormBuilder\Exception\FormBuilderInvalidArgumentException;

trait FormBuilderTrait
{

    /**
     * Render the HTML input tags. the first argument accepts the key value pair
     * html attribute. and the second argument is of a mixed data type define
     * within the controller. ie. can be the content for the textarea or
     * choices array of looping select, radio or multi-checkbox options
     *
     * @param array $attr
     * @param mixed $options
     * @return string
     */
    protected function renderHtmlElement(array $attr, $options = null)
    {
        $val = '';
        if (is_array($attr) && count($attr) > 0) {
            foreach ($attr as $key => $value) {
                if ($key !='') {
                    if ($value !=='') {
                        if (is_bool($value)) {
                            $val .= ($value === true) ? $key . ' ' : false;
                        } else {
                            $val .= $key . '="' . (is_array($value) ? implode(' ', $value) : $value) . '" ';/* Leave the space in */
                        }
                    }
                }
            }
            $val = substr_replace($val, '', -1);
            if (count($attr) > 0) {
                return $val;
            }
        }
    }

    /**
     * @param array $options
     * @return bool|string
     */
    protected function renderSelectOptions(array $options)
    {
        $output = '';
        if (is_array($options) && count($options) > 0) {
            foreach ($options['choices'] as $key => $choice) {
                $selected = '';
                if ($choice == $key && $key != '') {
                    $selected = ' selected';
                } elseif (isset($options['default']) && $options['default'] != null && $options['default'] == $key) {
                    $selected = ' selected';
                } else {
                    $selected = '';
                }
                $output .= '<option value="' . $key . '"' . $selected . '>' . htmlspecialchars(ucwords($choice)) . '</option>' . "\n";
            }

            return $output;
        }

        return false;
    }

    /**
     * @param array $attr
     * @param null $options
     * @return bool|string
     */
    protected function renderInputOptions(array $attr, $options = null)
    {
        if (!is_array($options)) {
            $options = array();
        }
        $val = '';
        if (is_array($attr) && count($attr) > 0) {
            foreach ($options['choices'] as $index => $choice) {
                $checked = '';
                if ($attr['value'] == $choice) {
                    $checked = ' checked';
                } elseif (isset($options['default']) && $options['default'] !=null && $options['default'] == $choice) {
                    $checked = ' checked';
                } else {
                    $checked = '';
                }
                $val .= '<input type="' . $attr['type'] . '" name="' . $attr['name'] . '" id="' . $attr['id'] . '_' . $index . '" class="' . implode(' ', $attr['class']) . '" value="' . $choice . '"' . $checked . '>' . ' ' . htmlspecialchars(Stringify::capitalize($choice)) . "\n<br>";
            }
            return $val;
        }
        return false;
    }

    /**
     * this method will automatically try and fetch the ID from the HTML input
     * its associated with to the populate its for="" tag. it will also use
     * the name tag from the input as the title for the label
     *
     * @param array $objectTypeOptions
     * @param string|null $class
     * @param string|null $label
     * @return string
     */
    protected function formLabel(
        array $objectTypeOptions, 
        ?string $class = null, 
        ?string $label = null
    ) : string
    {
        $output = '';
        if ($objectTypeOptions == null) {
            throw new FormBuilderInvalidArgumentException();
        }
        $output .= "\n<label";
        $output .= (!empty($objectTypeOptions['id']) ? ' for="' . $objectTypeOptions['id'] . '"' : '');
        $output .= (!empty($class) ? ' class="' . $class . '"' : ' class="uk-form-label"');
        $output .= '>';
        
        if ($label == '') {
            $output .= (!empty($objectTypeOptions['name']) ? str_replace(array('_', '-'), ' ', htmlspecialchars(ucwords($objectTypeOptions['name']))) : '');
        } else {
            $output .= $label;
        }
        $output .= "</label>\n";

        return $output;
    }

    /**
     * Throw an out of bound exception if we are passing a key which isn't part of the object
     * type default options
     *
     * @param array $fields - array option from controller
     * @param array $options - the array options from the extension classes
     * @param string $extensionObjectName - the name of the object the exception been thrown in
     * @return void
     */
    protected function throwExceptionOnBadInvalidKeys(array $fields, array $extensionOptions, string $extensionObjectName)
    {
        foreach (array_keys($fields) as $index) {
            if (!in_array($index, array_keys($extensionOptions), true)) {
                throw new FormBuilderOutOfBoundsException("One or more key '{$index}' is not a valid key for the object type $extensionObjectName");
            }
        }
    }

    public function filterArray(array $fields): mixed
    {
        $v = [];
        if (is_array($fields)) {
            foreach ($fields as $key => $value) {
                $v = $value;
            }
        }
        return $v;
    
    }


}