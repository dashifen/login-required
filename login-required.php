<?php
/**
 * Plugin Name: Login Required
 * Plugin URI: https://github.com/dashifen/login-required
 * Description: When enabled, requires that a visitor be logged into the site before displaying the site.
 * Author: David Dashifen Kees
 * Author URI: http://dashifen.com
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Requires at least: 5.6
 * Requires PHP: 7.4
 * Version: 2.0.0
 */

use Dashifen\Exception\Exception;
use Dashifen\LoginRequired\LoginRequired;

if (!class_exists('Dashifen\LoginRequired\LoginRequired')) {
  require_once 'vendor/autoload.php';
}

try {
  (function () {
    
    // by instantiating this object within this anonymous function it prevents
    // the addition of this variable in the WordPress global scope.
    
    $loginRequired = new LoginRequired();
    $loginRequired->initialize();
  })();
} catch (Exception $e) {
  LoginRequired::catcher($e);
}
