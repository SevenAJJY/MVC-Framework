<?php

namespace SEVENAJJY\Library;

/**
 * To verify the validity of the input fields.
 * 
 * Some terms & rules and their explanation.
 * Req = required
 * num = number
 *      -> int
 *          -> eq  = equals
 *          -> lt  = less than
 *          -> gt  = greater than
 *          -> max = maximum
 *          -> min = minimum
 *          -> between
 *      -> float
 *          -> (M, D) = How many digits are after the decimal point and how many after it.
 * alpha = alphabet
 *      -> eq - lt - gt - min - max - bEtween
 * alphanum = alphanumeric
 *      -> eq - lt - gt - min - max - bEtween
 * email
 * date
 *   -> YYYY-mm-dd
 * url
 */
trait Validate{
    private $_regexPatterns = [
        'num'           => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int'           => '/^[0-9]+$/',
        'float'         => '/^[0-9]+\.[0-9]+$/',
        'alpha'         => '/^[a-zA-Z\p{Arabic} ]+$/u',
        'alphanum'      => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
        'vdate'          => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
        'email'         => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'url'           => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
    ];

    public function req($value)
        {
            return '' != $value || !empty($value);
        }

        public function num($value)
        {
            return (bool) preg_match($this->_regexPatterns['num'] ,$value);
        }

        public function int($value)
        {
            return (bool) preg_match($this->_regexPatterns['int'] ,$value);
        }

        public function float($value)
        {
            return (bool) preg_match($this->_regexPatterns['float'] ,$value);
        }   

        public function alpha($value)
        {
            return (bool) preg_match($this->_regexPatterns['alpha'] ,$value);
        }

        public function alphanum($value)
        {
            return (bool) preg_match($this->_regexPatterns['alphanum'] ,$value);
        }

        /**
         * 
         * function Equal
         * @param mixed $value
         * @param mixed $matchAgainst
         * 
         * @return bool
         */
        public function eq($value , $matchAgainst): bool
        {
            return $value == $matchAgainst;
        }

        /**
         * function Equal Field
         * @param mixed $value
         * @param mixed $otherFieldValue
         * 
         * @return bool
         */
        public function eq_field($value , $otherFieldValue): bool
        {
            return $value == $otherFieldValue;
        }

        /**
         *  function Less Than
         * @param mixed $value
         * @param mixed $matchAgainst
         * 
         * @return bool
         */
        public function lt($value , $matchAgainst): bool
        {
            if(is_string($value)) {
                return mb_strlen($value) < $matchAgainst;
            } elseif (is_numeric($value)) {
                return $value < $matchAgainst;
            }
        }

        /**
         * function Greater Than
         * @param mixed $value
         * @param mixed $matchAgainst
         * 
         * @return bool
         */
        public function gt($value , $matchAgainst): bool
        {
            if(is_string($value)) {
                return mb_strlen($value) > $matchAgainst;
            } 
            elseif (is_numeric($value)) {
                return $value > $matchAgainst;
            }
        }

        /**
         * function Minimum
         * @param mixed $value
         * @param mixed $min
         * 
         * @return bool | mixed
         */
        public function min($value , $min): bool
        {
            if(is_string($value)) {
                return mb_strlen($value) >= $min;
            } 
            elseif (is_numeric($value)) {
                return $value >= $min;
            }
        }

        /**
         * function Maximum
         * @param mixed $value
         * @param mixed $max
         * 
         * @return bool
         */
        public function max($value , $max): bool
        {
            if (is_String($value)) {
                return mb_strlen($value) <= $max;
            }
            elseif (is_numeric($value)) {
                return $value <= $max ;
            }
        }

        /**
         * function between
         * @param mixed $value
         * @param mixed $min
         * @param mixed $max
         * 
         * @return bool
         */
        public function between($value , $min , $max)
        {
            if(is_string($value)) {
                return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
            } 
            elseif (is_numeric($value)) {
                return $value >= $min && $value <= $max;
            }
        }

        /**
         * Find out how many digits are after the comma and before it in the decimal numbers
         * @param mixed $value
         * @param mixed $beforeDP
         * @param mixed $afterDP
         * 
         * @return bool
         */
        public function floatlike($value , $beforeDP , $afterDP): bool
        {
            if (!$this->float($value)) {
                return false ;
            }
            $pattern = '/^[0-9]{'. $beforeDP .'}\.[0-9]{'. $afterDP .'}$/';
            return (bool) preg_match($pattern ,$value);
        }

        /**
         * validate date (Date format MySQL 'YYYY-MM-DD')
         * @param mixed $value
         * 
         * @return bool
         */
        public function vdate($value): bool
        {
            return (bool) preg_match($this->_regexPatterns['vdate'], $value);
        }

        /**
         * validate Email
         * @param mixed $value
         * 
         * @return bool
         */
        public function email($value): bool
        {
            return (bool) preg_match($this->_regexPatterns['email'], $value);
        }

        /**
         * validate URL
         * @param mixed $value
         * 
         * @return bool
         */
        public function url($value): bool
        {
            return (bool) preg_match($this->_regexPatterns['url'], $value);
        }
}