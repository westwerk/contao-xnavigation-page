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

namespace Bit3\Contao\XNavigation\Page\Condition;

use Bit3\FlexiTree\Condition\ConditionInterface;
use Bit3\FlexiTree\ItemInterface;

/**
 * Class PageIdCondition
 */
class PageIdCondition implements ConditionInterface
{
	/**
	 * @var int
	 */
	protected $pageId;

	public function __construct($pageId = false)
	{
		$this->pageId = $pageId !== false ? (int) $pageId : false;
	}

	/**
	 * @param int $pageId
	 */
	public function setPageId($pageId)
	{
		$this->pageId = (int) $pageId;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPageId()
	{
		return $this->pageId;
	}

	/**
	 * {@inheritdoc}
	 */
	public function matchItem(ItemInterface $item)
	{
		if ($item->getType() != 'page') {
			return true;
		}

		$pageId = $item->getExtra('id');
		return $pageId == $this->pageId;
	}

	/**
	 * {@inheritdoc}
	 */
	public function describe()
	{
		return sprintf('page.id == %d', $this->pageId);
	}
}
