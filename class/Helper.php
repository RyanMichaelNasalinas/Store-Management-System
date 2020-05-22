<?php

class Helper
{
    public static function getTitle()
    {
        $pagetitle = basename($_SERVER['PHP_SELF'], '.php');
        if ($pagetitle == 'index') {
            echo "Home";
        } else {
            return str_replace("-", " ", ucfirst($pagetitle));
        }
    }

    public static function redirect($page)
    {
        header("location:" . $page);
    }

    public static function sanitizeField($field)
    {
        $field = trim($field);
        $field = strip_tags($field);
        $field = htmlspecialchars($field);

        return $field;
    }
}
