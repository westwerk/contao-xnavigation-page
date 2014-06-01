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

namespace Bit3\Contao\XNavigation\Condition;

use Bit3\FlexiTree\Condition\ConditionInterface;
use Bit3\FlexiTree\ItemInterface;

/**
 * Class PageGroupsCondition
 */
class PageGroupsCondition implements ConditionInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function matchItem(ItemInterface $item)
	{
		if ($item->getType() != 'page') {
			return true;
		}

		if (!FE_USER_LOGGED_IN) {
			return false;
		}

		$pageGroups = $item->getExtra('groups');
		$memberGroups = \FrontendUser::getInstance()->groups;

		$groups = array_intersect($memberGroups, $pageGroups);
		return (bool) count($groups);
	}

	/**
	 * {@inheritdoc}
	 */
	public function describe()
	{
		return 'member.groups ⊂ page.groups';
	}
}
