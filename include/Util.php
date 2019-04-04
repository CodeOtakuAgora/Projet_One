<?php

    class Util
    {
        public static function getGetParam($param)
        {
            if (!empty($_GET[$param]) && $_GET[$param] !== '') {
                return $_GET[$param];
            }
            return '';
        }

        public static function getPostParam($param)
        {
            if (!empty($_POST[$param]) && $_POST[$param] !== '') {
                return $_POST[$param];
            }
            return '';
        }
    }