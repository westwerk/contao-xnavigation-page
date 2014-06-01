<?php

/**
 * xNavigation - Highly extendable and flexible navigation module for the Contao Open Source CMS
 *
 * Copyright (C) 2013 bit3 UG <http://bit3.de>
 *
 * @package    xNavigation
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @link       http://www.themeplus.de
 * @license    http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Table tl_page
 */

foreach (array_keys($GLOBALS['TL_PTY']) as $pty) {
	$hasSitemap = preg_match('~,sitemap[,;]~', $GLOBALS['TL_DCA']['tl_page']['palettes'][$pty]);
	$hasHide    = preg_match('~,hide[,;]~', $GLOBALS['TL_DCA']['tl_page']['palettes'][$pty]);

	if ($hasSitemap || $hasHide) {
		$GLOBALS['TL_DCA']['tl_page']['palettes'][$pty] = preg_replace(
			array('~,sitemap([,;])~', '~,hide([,;])~'),
			'$1',
			$GLOBALS['TL_DCA']['tl_page']['palettes'][$pty]
		);

		$fields = array();
		if ($hasHide) {
			$fields[] = 'hide';
		}
		if ($hasSitemap) {
			$fields[] = 'sitemap';
		}
		$fields[] = 'xnavigationSubitle';

		MetaPalettes::appendAfter(
			'tl_page',
			$pty,
			'expert',
			array('xnavigation' => $fields)
		);
	}
}

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['guests']['eval']['tl_class'] = 'w50 m12';
$GLOBALS['TL_DCA']['tl_page']['fields']['hide']['eval']['tl_class']   = 'w50 m12';

$GLOBALS['TL_DCA']['tl_page']['fields']['xnavigationSubitle'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_page']['xnavigationSubitle'],
	'exclude'   => true,
	'inputType' => 'text',
	'eval'      => array(
		'tl_class'  => 'w50',
		'maxlength' => 255,
	),
	'sql'       => "varchar(255) NOT NULL default ''"
);
