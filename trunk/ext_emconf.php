<?php

########################################################################
# Extension Manager/Repository config file for ext "pagehits".
#
# Auto generated 14-03-2011 22:54
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Pagehits',
	'description' => 'The pagehits extension extends the pages table with a new column which contains the number of visitors\' hits on this page.',
	'category' => 'plugin',
	'author' => 'Armin Ruediger Vieweg',
	'author_email' => 'info@professorweb.de',
	'author_company' => 'Professor Web - Webdesign Blog',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'version' => '1.0.0',
	'loadOrder' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:7:{s:12:"ext_icon.gif";s:4:"3f54";s:17:"ext_localconf.php";s:4:"2ec3";s:14:"ext_tables.php";s:4:"8ef2";s:14:"ext_tables.sql";s:4:"03e7";s:30:"Classes/class.userPagehits.php";s:4:"9f2b";s:34:"Configuration/TypoScript/setup.txt";s:4:"d554";s:14:"doc/manual.sxw";s:4:"00ae";}',
	'suggests' => array(
	),
);

?>