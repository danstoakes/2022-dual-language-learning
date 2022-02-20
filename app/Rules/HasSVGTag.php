<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasSVGTag implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // returns true if $needle is a substring of $haystack
    function contains($needle, $haystack)
    {
        return strpos($haystack, $needle) !== false;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (isset($value)) {
            if ($value != strip_tags($value)) {
                if ($this->contains("<svg", $value) && $this->contains("</svg>", $value))
                    return true;
            }
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The language logo must be a valid SVG.";
    }
}
