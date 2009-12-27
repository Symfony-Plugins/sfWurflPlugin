<?php

/* This file is part of the sfWurflPlugin package.
 * (c) Samuel D. Smith <samuel.d.smith@hotmail.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code
 */

/**
 * This class makes it easy to use the WURFL classes within symfony.
 * 
 * This class is based on the sfZendFrameworkBridge class, written by
 * Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * @see sfZendFrameworkBridge
 *
 * @package     sfWurflPlugin
 * @author      sam <samuel.d.smith@hotmail.co.uk>
 * @version     SVN: $Id$
 */
class sfWurflBridge
{
  static public function autoload($class)
  {
    try
    {
      return WURFL_ClassLoader::loadClass($class);
    }
    catch(WURFL_WURFLException $e)
    {
      return false;
    }
  }

  /**
   * Initializes the bridge between symfony and WURFL by detecting and including
   * the path to, and requiring the WURFL_ClassLoader class.
   *
   * If WURFL/ClassLoader.php does not exist then this function will raise a
   * sfWurflConfigurationException exception
   *
   * @throws sfWurflConfigurationException
   */
  static public function initialize()
  {
    $sf_wurfl_lib_dir = sfConfig::get('sf_wurfl_lib_dir');

    $filename = $sf_wurfl_lib_dir . '/ClassLoader.php';

    if (!file_exists($filename))
    {
      throw new sfWurflConfigurationException('Invalid WURFL library structure. Unable to find "' . $filename . '"');
    }

    sfToolkit::addIncludePath($sf_wurfl_lib_dir);

    require_once($filename);

    spl_autoload_register('sfWurflBridge::autoload');
  }
}