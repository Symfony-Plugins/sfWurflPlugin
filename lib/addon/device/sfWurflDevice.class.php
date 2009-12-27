<?php

/* This file is part of the sfWurflPlugin package.
 * (c) Samuel D. Smith <samuel.d.smith@hotmail.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code
 */

/**
 * 
 * @package sfWurflDevice
 * @author  sam <samuel.d.smith@hotmail.co.uk>
 * @version SVN: $Id$
 */
class sfWurflDevice
{
  protected $device = null;

  /**
   * @return sfWurflDevice An instance of the sfWurflDevice object
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

  public function configure(WURFL_Device $device)
  {
    if (!isset($device) || is_null($device))
    {
      throw new sfWurflException();
    }

    $this->device = $device;
  }

  public function getCapability($name)
  {
    return $this->getDevice()->getCapability($name);
  }

  /**
   * Gets the device
   *
   * @return WURFL_Device The device
   */
  public function getDevice()
  {
    return $this->device;
  }

  /**
   * 
   *
   * @param sfEvent $event
   */
  public function listenToWurflPostBuildDevice(sfEvent $event)
  {
    if ('wurfl.post_build_device' !== $event->getName())
    {
      return;
    }

    $device = $event['device'];

    if ($device)
    {
      $this->configure($device);
    }
  }
}