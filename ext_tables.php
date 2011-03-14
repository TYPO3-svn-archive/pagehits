<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Pagehits');

$tempColumns = Array (
	'tx_pagehits_hits' => Array (
		'exclude' => 1,
		'label' => 'Pagehits',
		'config'  => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	)
);

t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages', $tempColumns, 1);

t3lib_extMgm::addToAllTCAtypes('pages', 'tx_pagehits_hits;;;;1-1-1');
?>