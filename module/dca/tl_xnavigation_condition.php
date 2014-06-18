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
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['metapalettes']['page_id']        = array
(
	'condition' => array('type', 'title'),
	'settings'  => array('page_id_page_id', 'invert'),
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['metapalettes']['page_guests']    = array
(
	'condition' => array('type', 'title'),
	'settings'  => array('page_guests_accepted_guests_status', 'invert'),
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['metapalettes']['page_hide']      = array
(
	'condition' => array('type', 'title'),
	'settings'  => array('page_hide_accepted_hide_status', 'invert'),
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['metapalettes']['page_protected'] = array
(
	'condition' => array('type', 'title'),
	'settings'  => array('page_members_accepted_protected_status', 'invert'),
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['metapalettes']['page_sitemap']   = array
(
	'condition' => array('type', 'title'),
	'settings'  => array('page_sitemap_accepted_sitemap_status', 'invert'),
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['metapalettes']['page_published'] = array
(
	'condition' => array('type', 'title'),
	'settings'  => array('invert'),
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['metapalettes']['page_type']      = array
(
	'condition' => array('type', 'title'),
	'settings'  => array('page_type_accepted_type', 'invert'),
);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['fields']['page_id_page_id']                        = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_id_page_id'],
	'inputType' => 'pageTree',
	'sql'       => "int(10) NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['fields']['page_guests_accepted_guests_status']     = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_guests_accepted_guests_status'],
	'inputType' => 'select',
	'options'   => array('', '1'),
	'reference' => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_guests_accepted_guests_statuses'],
	'eval'      => array(
		'tl_class' => 'w50',
	),
	'sql'       => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['fields']['page_members_accepted_protected_status'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_members_accepted_protected_status'],
	'inputType' => 'select',
	'options'   => array('', '1'),
	'reference' => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_members_accepted_protected_statuses'],
	'eval'      => array(
		'tl_class' => 'w50',
	),
	'sql'       => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['fields']['page_hide_accepted_hide_status']         = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_hide_accepted_hide_status'],
	'inputType' => 'select',
	'options'   => array('', '1'),
	'reference' => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_hide_accepted_hide_statuses'],
	'eval'      => array(
		'tl_class' => 'w50',
	),
	'sql'       => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['fields']['page_sitemap_accepted_sitemap_status']   = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_sitemap_accepted_sitemap_status'],
	'inputType' => 'checkbox',
	'options'   => array('map_default', 'map_always', 'map_never'),
	'reference' => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_sitemap_accepted_sitemap_statuses'],
	'eval'      => array(
		'mandatory' => true,
		'multiple'  => true,
	),
	'sql'       => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_xnavigation_condition']['fields']['page_type_accepted_type']                = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_xnavigation_condition']['page_type_accepted_type'],
	'inputType' => 'select',
	'options'   => array_keys($GLOBALS['TL_PTY']),
	'reference' => &$GLOBALS['TL_LANG']['PTY'],
	'eval'      => array(
		'includeBlankOption' => true,
		'mandatory'          => true,
	),
	'sql'       => "varchar(255) NOT NULL default ''"
);
