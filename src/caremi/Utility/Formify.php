<?php declare(strict_types=1);

namespace Caremi\Utility;

class Formify
{

    public function referrer()
    {
        return '<input type="hidden" name="referredby" id="referredby" value="' . $_SERVER['HTTP_REFERER'] . '">';
    }

    /**
     * Undocumented function
     *
     * @param [type] $checked
     * @param [type] $current
     * @return boolean
     */
    public function isChecked($checked, $current)
    {   
        if ($checked == $current)
            return ' checked="checked"';
    }

    /**
     * Undocumented function
     *
     * @param [type] $selected
     * @param [type] $current
     * @return boolean
     */
    public function isSelected($selected, $current)
    {
        if ($selected == $current)
            return ' selected="selected"';
    }


}
