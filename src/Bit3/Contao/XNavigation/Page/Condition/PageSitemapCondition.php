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
 * Class PageSitemapCondition
 */
class PageSitemapCondition implements ConditionInterface
{
	/**
	 * @var bool
	 */
	protected $acceptedSitemapStatus;

	public function __construct(array $acceptedSitemapStatus = array())
	{
		$this->acceptedSitemapStatus = $acceptedSitemapStatus;
	}

	/**
	 * @param boolean $acceptedSitemapStatus
	 */
	public function setAcceptedSitemapStatus(array $acceptedSitemapStatus)
	{
		$this->acceptedSitemapStatus = $acceptedSitemapStatus;
		return $this;
	}

	/**
	 * @SuppressWarnings(PHPMD.BooleanGetMethodName)
	 * @return boolean
	 */
	public function getAcceptedSitemapStatus()
	{
		return $this->acceptedSitemapStatus;
	}

	/**
	 * {@inheritdoc}
	 */
	public function matchItem(ItemInterface $item)
	{
		if ($item->getType() != 'page') {
			return true;
		}

		$sitemap = $item->getExtra('sitemap');
		return in_array($sitemap, $this->acceptedSitemapStatus);
	}

	/**
	 * {@inheritdoc}
	 */
	public function describe()
	{
		$parts = array();

		foreach ($this->acceptedSitemapStatus as $acceptedSitemapStatus) {
			$parts[] = sprintf('page.sitemap="%s"', $acceptedSitemapStatus);
		}

		if (count($parts)) {
			return sprintf('(%s)', implode(' OR ', $parts));
		}

		return false;
	}
}
