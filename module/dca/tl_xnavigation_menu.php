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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_xnavigation_menu']['palettes'][] = 'page_root';

$GLOBALS['TL_DCA']['tl_xnavigation_menu']['metasubpalettes']['root_page'] = array('page_root');

$GLOBALS['TL_DCA']['tl_xnavigation_menu']['metasubselectpalettes']['page_root']['level']      = array('page_root_level');
$GLOBALS['TL_DCA']['tl_xnavigation_menu']['metasubselectpalettes']['page_root']['custom']     = array('page_root_id');
$GLOBALS['TL_DCA']['tl_xnavigation_menu']['metasubselectpalettes']['page_root']['individual'] = array('page_root_ids');

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_xnavigation_menu']['fields']['page_root']           = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_menu']['page_root'],
	'default'   => 'root',
	'inputType' => 'select',
	'filter'    => true,
	'options'   => array('root', 'parent', 'current', 'level', 'custom', 'individual'),
	'reference' => &$GLOBALS['TL_LANG']['tl_xnavigation_menu']['page_roots'],
	'eval'      => array(
		'mandatory'      => true,
		'submitOnChange' => true,
		'helpwizard'     => true,
		'tl_class'       => 'w50',
	),
	'sql'       => "varchar(32) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_xnavigation_menu']['fields']['page_root_level']     = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_menu']['page_root_level'],
	'default'   => '1',
	'inputType' => 'text',
	'eval'      => array(
		'mandatory' => true,
		'rgxp'      => 'digit',
		'tl_class'  => 'clr',
	),
	'sql'       => "int(10) NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_xnavigation_menu']['fields']['page_root_id']        = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_menu']['page_root_id'],
	'inputType' => 'pageTree',
	'eval'      => array(
		'mandatory' => true,
		'tl_class'  => 'clr',
	),
	'sql'       => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_xnavigation_menu']['fields']['page_root_ids']       = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_menu']['page_root_ids'],
	'inputType' => 'pageTree',
	'eval'      => array(
		'mandatory'  => true,
		'multiple'   => true,
		'fieldType'  => 'checkbox',
		'files'      => true,
		'orderField' => 'page_root_ids_order',
		'tl_class'   => 'clr',
	),
	'sql'       => "text NULL"
);
$GLOBALS['TL_DCA']['tl_xnavigation_menu']['fields']['page_root_ids_order'] = array(
	'sql' => 'text NULL',
);
