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

namespace Bit3\Contao\XNavigation\Provider;

use Bit3\FlexiTree\Event\CollectItemsEvent;
use Bit3\FlexiTree\Event\CreateItemEvent;
use Contao\PageModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class Page
 */
class PageProvider implements EventSubscriberInterface
{
	/**
	 * {@inheritdoc}
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'create-item'   => 'createItem',
			'collect-items' => array('collectItems', 100),
		);
	}

	public function collectItems(CollectItemsEvent $event)
	{
		$item = $event->getParentItem();

		if ($item->getType() == 'page') {
			$t = \PageModel::getTable();
			$arrColumns = array("$t.pid=?");

			if (!BE_USER_LOGGED_IN)
			{
				$time = time();
				$arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
			}

			$pages = \PageModel::findBy(
				$arrColumns,
				array($item->getExtra('id')),
				array('order' => 'sorting')
			);

			if ($pages) {
				$factory = $event->getFactory();

				foreach ($pages as $page) {
					$factory->createItem('page', $page->id, $item);
				}
			}
		}
	}

	public function createItem(CreateItemEvent $event)
	{
		$item = $event->getItem();

		if ($item->getType() == 'page') {
			$page = \PageModel::findByPk($item->getName());

			if ($page) {
				$item->setUri(\Frontend::generateFrontendUrl($page->row()));
				$item->setLabel($page->title);

				if ($page->cssClass) {
					$class = $item->getAttribute('class', '');
					$item->setAttribute('class', trim($class . ' ' . $page->cssClass));

					$class = $item->getLinkAttribute('class', '');
					$item->setLinkAttribute('class', trim($class . ' ' . $page->cssClass));

					$class = $item->getLabelAttribute('class', '');
					$item->setLabelAttribute('class', trim($class . ' ' . $page->cssClass));
				}

				$currentPage = $this->getCurrentPage();

				$item->setExtras($page->row());
				$item->setCurrent($currentPage->id == $page->id);
				$item->setTrail(in_array($page->id, $currentPage->trail));
			}
		}
	}

	/**
	 * @SuppressWarnings(PHPMD.Superglobals)
	 * @SuppressWarnings(PHPMD.CamelCaseVariableName)
	 * @return \PageModel
	 */
	protected function getCurrentPage()
	{
		return $GLOBALS['objPage'];
	}
}
