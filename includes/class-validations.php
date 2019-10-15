<?php

    trait Validations
    {
        public function __construct()
        {

        }

        protected function filterStrings($string)
        {
            return (string)trim(filter_var(filter_var($string, FILTER_SANITIZE_STRING), FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }

    }