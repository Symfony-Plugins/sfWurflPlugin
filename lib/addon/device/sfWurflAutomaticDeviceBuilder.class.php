<?php

/* This file is part of the sfWurflPlugin package.
 * (c) Samuel D. Smith <samuel.d.smith@hotmail.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code
 */

/**
 * @package sfWurflPlugin
 * @author  sam <samuel.d.smith@hotmail.co.uk>
 * @version SVN: $Id$
 */
class sfWurflAutomaticDeviceBuilder
{
  protected $manager = null;

  /**
   * Gets the instance of the class
   *
   * @return sfWurflAutomaticDeviceBuilder An instance of the
   * sfWurflAutomaticDeviceBuilder object
   */
  public static function getInstance()
  {
    static $instance;

    if (!isset($instance))
    {
      $class = __CLASS__;

      $instance = new $class;
    }

    return $instance;
  }

  public function __construct()
  {
    $this->configure();
  }

  private function configure()
  {
    $configFile = sfConfig::get('sf_wurfl_config_file');

    $this->manager = WURFL_WURFLManagerProvider::getWURFLManager($configFile);
  }

  /**
   * 
   */
  public function listenToRequestFilterParameters(sfEvent $event, $parameters)
  {
    if ('request.filter_parameters' !== $event->getName())
    {
      return $parameters;
    }

    $userAgent = $event->getSubject()->getHttpHeader('User-Agent');

    $device = $this->getManager()->getDeviceForUserAgent($userAgent);

    /* TODO Find a cleaner method of getting an instance of the current event
     * dispatcher
     */
    $dispatcher = sfContext::getInstance()->getEventDispatcher();
    $dispatcher->notify(new sfEvent($this, 'wurfl.post_build_device', array('device' => $device)));
    
    return $parameters;
  }

  /**
   * Returns the manager
   */
  public function getManager()
  {
    return $this->manager;
  }
}
