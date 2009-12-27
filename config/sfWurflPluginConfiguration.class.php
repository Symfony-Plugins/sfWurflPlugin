<?php

/* This file is part of the sfWurflPlugin package.
 * (c) Samuel D. Smith <samuel.d.smith@hotmail.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code
 */

/**
 * sfWurflPlugin configuration
 *
 * @author sam <samuel.d.smith@hotmail.co.uk>
 */
class sfWurflPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function configure()
  {
    $sf_wurfl_lib_dir =
      realpath(dirname(__FILE__) . '/../lib/vendor/wurfl/WURFL');

    if (!file_exists($sf_wurfl_lib_dir))
    {
      throw new sfWurflConfigurationException(
        'Invalid WURFL library structure. Unable to find: "' . $sf_wurfl_lib_dir . '"');
    }

    $sf_wurfl_config_file =
      realpath(dirname(__FILE__) . '/../lib/vendor/wurfl/resources/wurfl-config.xml');

    if (!file_exists($sf_wurfl_config_file))
    {
      throw new sfWurflConfigurationException('Invalid WURFL library structure. Unable to find: "' . $sf_wurfl_config_file . '"');
    }

    // Finally...
    sfConfig::add(array(
      'sf_wurfl_lib_dir' => $sf_wurfl_lib_dir
      , 'sf_wurfl_config_file' => $sf_wurfl_config_file
    ));
  }

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    sfWurflBridge::initialize();

    /* Connect the sfWurflAutomaticDeviceBuilder#listenToRequestFilterParameters
     * method to the request.filter_parameters event
     */
    $filter = sfWurflAutomaticDeviceBuilder::getInstance();
    $this->dispatcher->connect('request.filter_parameters', array($filter, 'listenToRequestFilterParameters'));

    $device = sfWurflDevice::getInstance();
    $this->dispatcher->connect('wurfl.post_build_device', array($device, 'listenToWurflPostBuildDevice'));
  }
}
