<?php
session_start();
date_default_timezone_set('Asia/Manila');

/**
 * Flash message helper
 * ex. flash('register_success', 'You are now registered')
 * display in view - echo flash('register_success');
 */
function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo sprintf('<div class="%s" id="msg-flash">%s</div>', $class, $_SESSION[$name]);

            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

//for protection of certain routes
function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}
