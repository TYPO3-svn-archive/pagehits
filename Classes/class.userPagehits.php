<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Armin Ruediger Vieweg <info@professorweb.de>
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
 * Pagehits class to store calls of pages to db and make them accessible
 *
 * Full configuration example:
 *
 * includeLibs.user_Pagehits = EXT:pagehits/Classes/class.userPagehits.php
 * lib.pagehits = USER
 * lib.pagehits {
 * 	userFunc = user_Pagehits->addPagehit
 * 	userFunc {
 * 		filterBySession = 1
 * 	}
}
 */
class user_Pagehits {
	/**
	 * @var array
	 */
	private $userFunc;

	/**
	 * @var integer
	 */
	private $pageUid = 0;

	protected $evaluateThisPagehit = TRUE;


	/**
	 * Initializes the userfunction
	 *
	 * @return void
	 */
	protected function initializeUserfunction($conf) {
		$this->userFunc = $conf['userFunc.'];
		$this->pageUid = $GLOBALS['TSFE']->id;
	}

	/**
	 * User_function to add pagehit to current page
	 *
	 * @param string $content an empty string which is not used, but have to be set
	 * @param array $conf the typoscript configuration array which also contains
	 *                    the userFunction properties
	 *
	 * @return void
	 */
	public function addHits($content = '', $conf = array()) {
		$this->initializeUserfunction($conf);

		// Filter the increase of pagehits by session
		if ($this->userFunc['filterBySession']) {
			$ignoredUids = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_pagehits_ignoredUids');
			$ignoredUids = t3lib_div::trimExplode(',', $ignoredUids, TRUE);

			if (in_array($this->pageUid, $ignoredUids)) {
				$this->evaluateThisPagehit = FALSE;
			} else {
				$ignoredUids[] = $this->pageUid;
				$ignoredUids = implode(',', $ignoredUids);
				$GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_pagehits_ignoredUids', $ignoredUids);
			}
		}

		// Get current pagehits, increase them and store them back to pages table
		if ($this->evaluateThisPagehit === TRUE) {
			$currentPageHits = $this->getPagehits($this->pageUid);
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery(
				'pages',
				'uid=' . $this->pageUid . $this->cObj->enableFields('pages'),
				array('tx_pagehits_hits' => $currentPageHits + 1)
			);
		}

		// Hook 'addHits'
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pagehits']['addHits'])) {
			/** @var $pagehitModel Tx_Pagehits_Model_Pagehits */
			$pagehitModel = $this->generatePagehitModel();

			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pagehits']['addHits'] as $_classRef) {
				$_procObj = &t3lib_div::getUserObj($_classRef);
				$_procObj->main($this, $pagehitModel);
			}
		}

		return;
	}

	/**
	 * Returns the count of pagehits of current page
	 *
	 * @param string $content an empty string which is not used, but have to be set
	 * @param array $conf the typoscript configuration array which also contains
	 *                    the userFunction properties
	 *
	 * @return integer The count of pagehits
	 */
	public function showHits($content = '', $conf = array()) {
		$this->initializeUserfunction($conf);
		return $this->getPagehits($this->pageUid);
	}

	/**
	 * Returns the number of pagehits of given page, identified by its uid
	 *
	 * @param integer $uid Uid of page
	 *
	 * @return integer Number of pagehits of given page
	 */
	protected function getPagehits($uid) {
		$row = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow(
			'tx_pagehits_hits',
			'pages',
			'uid=' . intval($uid) . $this->cObj->enableFields('pages')
		);
		return intval($row['tx_pagehits_hits']);
	}

	/**
	 * Creates and returns a pagehit model, which is used for hook interactions
	 *
	 * @return Tx_Pagehits_Model_Pagehits
	 */
	protected function generatePagehitModel() {
		/** @var $pagehitModel Tx_Pagehits_Model_Pagehits */
		$pagehitModel = t3lib_div::makeInstance('Tx_Pagehits_Model_Pagehits');

		$pagehitModel->setPageUid($this->pageUid);
		$pagehitModel->setFilterBySession($this->userFunc['filterBySession']);
		$pagehitModel->setHasBeenUpdated($this->evaluateThisPagehit);
		$pagehitModel->setPagehitCount($this->getPagehits($this->pageUid));

		return $pagehitModel;
	}

}
?>