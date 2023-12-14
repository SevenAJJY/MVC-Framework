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
    public function filterInt($input):mixed
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Returns the filtered data (FLOAT), or false if the filter fails.
     * 
     * @param float $input
     * @return mixed
     */
    public function filterFloat($input):mixed
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    /**
     * Returns the filtered data (STRING), or false if the filter fails.
     * 
     * @param string $input
     * @return mixed
     */
    public function filterString($input):mixed
    {
        return htmlentities(strip_tags($input), ENT_QUOTES, "UTF-8");
    }

    /**
     * filter ans sanitize array of strings
     * @param array $arr
     * 
     * @return  array
     */
    public function filterStringArray(array $arr)
    {
        foreach ($arr as $key => $value) {
            $arr[$key] = htmlentities(strip_tags(trim($value)), ENT_QUOTES, 'utf-8');
        }
        return $arr;
    }
}