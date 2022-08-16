<?php

namespace SEVENAJJY\Library;

trait InputFilter
{
    /**
     * Returns the filtered data (INT), or false if the filter fails.
     * 
     * @param int $input
     * @return mixed 
     */
    public function filterInt(int $input):mixed
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Returns the filtered data (FLOAT), or false if the filter fails.
     * 
     * @param float $input
     * @return mixed
     */
    public function filterFloat(float $input):mixed
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    /**
     * Returns the filtered data (STRING), or false if the filter fails.
     * 
     * @param string $input
     * @return mixed
     */
    public function filterString(string $input):mixed
    {
        return htmlentities(strip_tags($input), ENT_QUOTES, "UTF-8");
    }
}