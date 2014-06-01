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
 * Event listener
 */
$GLOBALS['TL_EVENT_SUBSCRIBERS'][] = 'Bit3\Contao\XNavigation\Page\DefaultSubscriber';

/**
 * Menu root types
 */
$GLOBALS['XNAVIGATION_MENU_ROOT'][] = 'page';

/**
 * Provider
 */
$GLOBALS['XNAVIGATION_PROVIDER']['page'] = 'Bit3\Contao\XNavigation\Page\Provider\PageProvider';

/**
 * Conditions
 */
$GLOBALS['XNAVIGATION_CONDITION']['page_guests']    = 'Bit3\Contao\XNavigation\Page\Condition\PageGuestsCondition';
$GLOBALS['XNAVIGATION_CONDITION']['page_protected'] = 'Bit3\Contao\XNavigation\Page\Condition\PageProtectedCondition';
$GLOBALS['XNAVIGATION_CONDITION']['page_groups']    = 'Bit3\Contao\XNavigation\Page\Condition\PageGroupsCondition';
$GLOBALS['XNAVIGATION_CONDITION']['page_hide']      = 'Bit3\Contao\XNavigation\Page\Condition\PageHideCondition';
$GLOBALS['XNAVIGATION_CONDITION']['page_sitemap']   = 'Bit3\Contao\XNavigation\Page\Condition\PageSitemapCondition';
$GLOBALS['XNAVIGATION_CONDITION']['page_published'] = 'Bit3\Contao\XNavigation\Page\Condition\PagePublishedCondition';