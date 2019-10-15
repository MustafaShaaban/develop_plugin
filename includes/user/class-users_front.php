<?php

    /**
     * Class Users_Front
     *
     * Login Form
     * Register Form
     * Reset Password step 1 Form
     * Reset Password step 2 Form
     * Account Form
     *
     */

    class Users_Front
    {
        public static $instance;
        private $plugin_key;

        public function __construct()
        {
            self::$instance = $this;
        }

        public static function get_instance()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }


    }
