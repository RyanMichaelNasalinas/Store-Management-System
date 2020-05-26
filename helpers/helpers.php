<?php

// Get Title
function getTitle()
{
    $pagetitle = basename($_SERVER['PHP_SELF'], '.php');
    if ($pagetitle == 'Index') {
        return $pagetitle = "Home";
    } else {
        return implode(' ', array_map('ucfirst', explode('-', $pagetitle)));
    }
}

// Sanitize Field
function sanitizeField($field)
{
    $field = trim($field);
    $field = strip_tags($field);
    $field = htmlspecialchars($field);

    return $field;
}

// Check if field is empty
function isEmpty($field)
{
    return empty($field) ? true : false;
}

// Display Errors
function displayError($errors = [])
{
    $output = '';
    if (!empty($errors)) {
        $output .= "<div>";
        $output .= "<ul>";
        foreach ($errors as $error) {
            $output .= "<li>$error</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

function redirect($location)
{
    header("location: " . $location);
}

function isAdmin($access, $page)
{
    if ($access == "admin") {
        return true;
    } else {
        redirect($page);
    }
}
