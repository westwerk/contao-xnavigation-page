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

namespace Bit3\Contao\XNavigation\Page;

use Bit3\Contao\XNavigation\Event\CreateDefaultConditionEvent;
use Bit3\Contao\XNavigation\Event\EvaluateRootEvent;
use Bit3\Contao\XNavigation\Model\ConditionModel;
use Bit3\Contao\XNavigation\Page\Condition\PageTypeCondition;
use Bit3\Contao\XNavigation\Twig\TwigExtension;
use Bit3\Contao\XNavigation\XNavigationEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class DefaultSubscriber
 */
class DefaultSubscriber implements EventSubscriberInterface
{
	/**
	 * {@inheritdoc}
	 */
	public static function getSubscribedEvents()
	{
		return array(
			EVENT_XNAVIGATION_EVALUATE_ROOT             => 'evaluateRoot',
			XNavigationEvents::CREATE_DEFAULT_CONDITION => 'createDefaultCondition',
		);
	}

	public function evaluateRoot(EvaluateRootEvent $event)
	{
		$menu = $event->getMenuModel();

		if ($menu->root == 'page') {
			switch ($menu->page_root) {
				case 'root':
					$event->setItemName($this->getCurrentPage()->rootId);
					break;

				case 'parent':
					$event->setItemName($this->getCurrentPage()->pid);
					break;

				case 'current':
					$event->setItemName($this->getCurrentPage()->id);
					break;

				case 'level':
					$level  = $menu->page_root_level;
					$trail  = $this->getCurrentPage()->trail;
					$pageId = isset($trail[$level])
						? $trail[$level]
						: -1;
					$event->setItemName($pageId);
					break;

				case 'custom':
					$event->setItemName($menu->page_root_id);
					break;

				default:
					return;
			}

			$event->setItemType('page');
			$event->stopPropagation();
		}
	}

	public function createDefaultCondition(CreateDefaultConditionEvent $event)
	{
		$root          = new ConditionModel();
		$root->pid     = $event->getCondition()->id;
		$root->sorting = 128;
		$root->type    = 'and';
		$root->save();

		// page type
		$condition                          = new ConditionModel();
		$condition->pid                     = $root->id;
		$condition->sorting                 = 128;
		$condition->type                    = 'item_type';
		$condition->item_type_accepted_type = 'page';
		$condition->save();

		// page published
		$condition          = new ConditionModel();
		$condition->pid     = $root->id;
		$condition->sorting = 256;
		$condition->type    = 'page_published';
		$condition->save();

		// page hidden
		$condition                                 = new ConditionModel();
		$condition->pid                            = $root->id;
		$condition->sorting                        = 512;
		$condition->type                           = 'page_hide';
		$condition->page_hide_accepted_hide_status = '';
		$condition->save();

		// page type
		$or          = new ConditionModel();
		$or->pid     = $root->id;
		$or->sorting = 1024;
		$or->type    = 'or';
		$or->save();

		{
			$condition                          = new ConditionModel();
			$condition->pid                     = $or->id;
			$condition->sorting                 = 128;
			$condition->type                    = 'page_type';
			$condition->page_type_accepted_type = 'regular';
			$condition->save();

			$condition                          = new ConditionModel();
			$condition->pid                     = $or->id;
			$condition->sorting                 = 256;
			$condition->type                    = 'page_type';
			$condition->page_type_accepted_type = 'forward';
			$condition->save();

			$condition                          = new ConditionModel();
			$condition->pid                     = $or->id;
			$condition->sorting                 = 512;
			$condition->type                    = 'page_type';
			$condition->page_type_accepted_type = 'redirect';
			$condition->save();
		}

		// login status
		$or          = new ConditionModel();
		$or->pid     = $root->id;
		$or->sorting = 2048;
		$or->type    = 'or';
		$or->save();

		{
			// unprotected pages
			$and          = new ConditionModel();
			$and->pid     = $or->id;
			$and->sorting = 128;
			$and->type    = 'and';
			$and->save();

			{
				// login status -> not protected
				$condition                                         = new ConditionModel();
				$condition->pid                                    = $and->id;
				$condition->sorting                                = 128;
				$condition->type                                   = 'page_protected';
				$condition->page_members_accepted_protected_status = '';
				$condition->save();

				// login status -> not logged in
				$condition                                     = new ConditionModel();
				$condition->pid                                = $and->id;
				$condition->sorting                            = 256;
				$condition->type                               = 'member_login';
				$condition->member_login_accepted_login_status = 'logged_out';
				$condition->save();

				// login status -> page guests only
				$condition                                     = new ConditionModel();
				$condition->pid                                = $and->id;
				$condition->sorting                            = 512;
				$condition->type                               = 'page_guests';
				$condition->page_guests_accepted_guests_status = '';
				$condition->save();
			}
		}

		{
			// protected pages
			$and          = new ConditionModel();
			$and->pid     = $or->id;
			$and->sorting = 256;
			$and->type    = 'and';
			$and->save();

			{
				// login status -> protected
				$condition                                         = new ConditionModel();
				$condition->pid                                    = $and->id;
				$condition->sorting                                = 128;
				$condition->type                                   = 'page_protected';
				$condition->page_members_accepted_protected_status = '';
				$condition->save();

				// login status -> page groups
				$condition          = new ConditionModel();
				$condition->pid     = $and->id;
				$condition->sorting = 256;
				$condition->type    = 'page_groups';
				$condition->save();
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
