<?php

namespace Dashifen\LoginRequired;

use Dashifen\WPHandler\Handlers\HandlerException;
use Dashifen\WPHandler\Handlers\Plugins\AbstractPluginHandler;

class LoginRequired extends AbstractPluginHandler
{
  /**
   * initialize
   *
   * Uses addAction and/or addFilter to attach protected methods of this object
   * to the WordPress ecosystem of action and filter hooks.
   *
   * @return void
   * @throws HandlerException
   */
  public function initialize(): void
  {
    if (!$this->isInitialized()) {
      
      // the wp_head action runs on the public site, but not on the admin
      // screens.  this includes the login pages, so we don't end up in an
      // inifinte redirection loop.
      
      $this->addAction('wp_head', 'requireLogin');
    }
  }
  
  protected function requireLogin(): void
  {
    if (!is_user_logged_in()) {
      
      // if the visitor is not logged in, then we redirect to the login page
      // passing the current URL as the location to which we will return after
      // authentication.
      
      $url = home_url($GLOBALS['wp']->request);
      wp_safe_redirect(wp_login_url($url));
      exit;
    }
  }
}
