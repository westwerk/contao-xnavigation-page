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
 * Class PageTypeCondition
 */
class PageTypeCondition implements ConditionInterface
{

	/**
	 * @var string
	 */
	protected $acceptedType;

	public function __construct($acceptedType = '?')
	{
		$this->acceptedType = $acceptedType;
	}

	/**
	 * @param string $acceptedHideStatus
	 */
	public function setAcceptedType($acceptedHideStatus)
	{
		$this->acceptedType = (string) $acceptedHideStatus;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAcceptedType()
	{
		return $this->acceptedType;
	}

	/**
	 * {@inheritdoc}
	 */
	public function matchItem(ItemInterface $item)
	{
		if ($item->getType() != 'page') {
			return true;
		}

		$type = $item->getExtra('type');
		return $type == $this->acceptedType;
	}

	/**
	 * {@inheritdoc}
	 */
	public function describe()
	{
		return 'page.type == ' . $this->acceptedType;
	}
}
