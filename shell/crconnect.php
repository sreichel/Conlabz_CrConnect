<?php
/**
 * Conlabz GmbH
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com and you will be sent a copy immediately.
 *
 * @category   CleverReach
 * @package    Conlabz_CrConnect
 * @copyright  Copyright (c) 2016 Conlabz GmbH (http://conlabz.de)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

require_once 'abstract.php';

/**
 * CleverReach Connect Shell Script
 *
 * @category   CleverReach
 * @package    Conlabz_CrConnect
 * @author     David Pommer <david.pommer@conlabz.de>
 */
class Mage_Shell_Crconnect extends Mage_Shell_Abstract
{
	protected $_api;

	/**
	 *
	 */
	protected function _getApi()
	{
		if ($this->_api === NULL) {
			$this->_api = Mage::getModel('crconnect/api');
		}
		return $this->_api;
	}

	/**
	 * Run script
	 */
	public function run()
	{
		if ($this->getArg('sync') || $this->getArg('synchronize')) {
			$syncedUsers = $this->_getApi()->synchronize();
			if ($syncedUsers !== FALSE) {
				echo Mage::helper('adminhtml')->__("Synchronization successfull. %s users were transmitted.", $syncedUsers).PHP_EOL;
			} else {
				echo Mage::helper('adminhtml')->__("Error occured while synchronization process. Please try again later.").PHP_EOL;
			}
		} else {
			echo $this->usageHelp();
		}
	}

	/**
	 * Retrieve Usage Help Message
	 */
	public function usageHelp()
	{
		return <<<USAGE
Usage: php -f crconnect.php -- [options]

  --synchronize Run synchronization

  -h            Short alias for help
  help          This help

USAGE;
	}
}

$shell = new Mage_Shell_Crconnect;
$shell->run();