<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Drupal\DrupalExtension\Context\RawDrupalContext;

/**
 * Behat steps for testing the drupal_ci_test module.
 *
 * @codingStandardsIgnoreStart
 */
class DrupalCiTestFeatureContext extends RawDrupalContext implements SnippetAcceptingContext {

  /**
   * Setup for the test suite, enable some required modules and add content
   * title.
   *
   * @BeforeSuite
   */
  public static function prepare(BeforeSuiteScope $scope) {
    /** @var \Drupal\Core\Extension\ModuleHandler $moduleHandler */
    $moduleHandler = \Drupal::service('module_handler');
    if (!$moduleHandler->moduleExists('drupal_ci_test')) {
      \Drupal::service('module_installer')->install(['drupal_ci_test']);
    }

    // Also uninstall the inline form errors module for easier testing.
    if ($moduleHandler->moduleExists('inline_form_errors')) {
      \Drupal::service('module_installer')->uninstall(['inline_form_errors']);
    }
  }

}
