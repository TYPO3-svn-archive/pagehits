<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Armin Rüdiger Vieweg <armin.vieweg@diemedialen.de>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * the pagehits model
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Pagehits_Model_Pagehits {
	/**
	 * @var integer
	 */
	protected $pageUid = 0;

	/**
	 * @var boolean
	 */
	protected $filterBySession = FALSE;

	/**
	 * @var boolean
	 */
	protected $hasBeenUpdated = FALSE;

	/**
	 * @var integer count of pagehit AFTER updating
	 */
	protected $pagehitCount = 0;

	/**
	 * @param boolean $filterBySession
	 */
	public function setFilterBySession($filterBySession) {
		$this->filterBySession = (boolean) $filterBySession;
	}

	/**
	 * @return boolean
	 */
	public function getFilterBySession() {
		return $this->filterBySession;
	}

	/**
	 * @param boolean $hasBeenUpdated
	 */
	public function setHasBeenUpdated($hasBeenUpdated) {
		$this->hasBeenUpdated = $hasBeenUpdated;
	}

	/**
	 * @return boolean
	 */
	public function getHasBeenUpdated() {
		return $this->hasBeenUpdated;
	}

	/**
	 * @param integer $pageUid
	 */
	public function setPageUid($pageUid) {
		$this->pageUid = $pageUid;
	}

	/**
	 * @return integer
	 */
	public function getPageUid() {
		return $this->pageUid;
	}

	/**
	 * @param integer $pagehitCount
	 */
	public function setPagehitCount($pagehitCount) {
		$this->pagehitCount = $pagehitCount;
	}

	/**
	 * @return integer
	 */
	public function getPagehitCount() {
		return $this->pagehitCount;
	}
}
?>