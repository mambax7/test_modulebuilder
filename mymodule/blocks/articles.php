<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * My Module module for xoops
 *
 * @copyright      2020 XOOPS Project (https://xoops.org)
 * @license        GPL 2.0 or later
 * @package        mymodule
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         TDM XOOPS - Email:<info@email.com> - Website:<http://xoops.org>
 */

use XoopsModules\Mymodule;
use XoopsModules\Mymodule\Helper;
use XoopsModules\Mymodule\Constants;

include_once XOOPS_ROOT_PATH . '/modules/mymodule/include/common.php';

/**
 * Function show block
 * @param  $options
 * @return array
 */
function b_mymodule_articles_show($options)
{
	include_once XOOPS_ROOT_PATH . '/modules/mymodule/class/articles.php';
	$myts = MyTextSanitizer::getInstance();
	$GLOBALS['xoopsTpl']->assign('mymodule_upload_url', MYMODULE_UPLOAD_URL);
	$block       = [];
	$typeBlock   = $options[0];
	$limit       = $options[1];
	$lenghtTitle = $options[2];
	$helper      = Helper::getInstance();
	$articlesHandler = $helper->getHandler('Articles');
	$crArticles = new \CriteriaCompo();
	\array_shift($options);
	\array_shift($options);
	\array_shift($options);

	switch ($typeBlock) {
		case 'last':
		default:
			// For the block: articles last
			$crArticles->add(new \Criteria('art_online', Constants::PERM_GLOBAL_VIEW, '>'));
			$crArticles->setSort('art_created');
			$crArticles->setOrder('DESC');
			break;
		case 'new':
			// For the block: articles new
			$crArticles->add(new \Criteria('art_online', Constants::PERM_GLOBAL_VIEW, '>'));
			// new since last week: 7 * 24 * 60 * 60 = 604800
			$crArticles->add(new \Criteria('art_created', time() - 604800, '>='));
			$crArticles->add(new \Criteria('art_created', time(), '<='));
			$crArticles->setSort('art_created');
			$crArticles->setOrder('ASC');
			break;
		case 'hits':
			// For the block: articles hits
			$crArticles->add(new \Criteria('art_online', Constants::PERM_GLOBAL_VIEW, '>'));
			$crArticles->setSort('art_hits');
			$crArticles->setOrder('DESC');
			break;
		case 'top':
			// For the block: articles top
			$crArticles->add(new \Criteria('art_online', Constants::PERM_GLOBAL_VIEW, '>'));
			$crArticles->setSort('art_top');
			$crArticles->setOrder('ASC');
			break;
		case 'random':
			// For the block: articles random
			$crArticles->add(new \Criteria('art_online', Constants::PERM_GLOBAL_VIEW, '>'));
			$crArticles->setSort('RAND()');
			break;
	}

	$crArticles->setLimit($limit);
	$articlesAll = $articlesHandler->getAll($crArticles);
	unset($crArticles);
	if (\count($articlesAll) > 0) {
		foreach (\array_keys($articlesAll) as $i) {
			$block[$i]['id'] = $articlesAll[$i]->getVar('art_id');
			$block[$i]['cat'] = $articlesAll[$i]->getVar('art_cat');
			$block[$i]['title'] = $myts->htmlSpecialChars($articlesAll[$i]->getVar('art_title'));
			$block[$i]['descr'] = \strip_tags($articlesAll[$i]->getVar('art_descr'));
			$block[$i]['img'] = $articlesAll[$i]->getVar('art_img');
			$block[$i]['file'] = $articlesAll[$i]->getVar('art_file');
			$block[$i]['created'] = \formatTimestamp($articlesAll[$i]->getVar('art_created'));
			$block[$i]['submitter'] = \XoopsUser::getUnameFromId($articlesAll[$i]->getVar('art_submitter'));
		}
	}

	return $block;

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_mymodule_articles_edit($options)
{
	include_once XOOPS_ROOT_PATH . '/modules/mymodule/class/articles.php';
	$helper = Helper::getInstance();
	$articlesHandler = $helper->getHandler('Articles');
	$GLOBALS['xoopsTpl']->assign('mymodule_upload_url', MYMODULE_UPLOAD_URL);
	$form = _MB_MYMODULE_DISPLAY;
	$form .= "<input type='hidden' name='options[0]' value='".$options[0]."' />";
	$form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' />&nbsp;<br>";
	$form .= _MB_MYMODULE_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' /><br><br>";
	\array_shift($options);
	\array_shift($options);
	\array_shift($options);

	$crArticles = new \CriteriaCompo();
	$crArticles->add(new \Criteria('art_id', 0, '!='));
	$crArticles->setSort('art_id');
	$crArticles->setOrder('ASC');
	$articlesAll = $articlesHandler->getAll($crArticles);
	unset($crArticles);
	$form .= _MB_MYMODULE_ARTICLES_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
	$form .= "<option value='0' " . (\in_array(0, $options) == false ? '' : "selected='selected'") . '>' . _MB_MYMODULE_ALL_ARTICLES . '</option>';
	foreach (\array_keys($articlesAll) as $i) {
		$art_id = $articlesAll[$i]->getVar('art_id');
		$form .= "<option value='" . $art_id . "' " . (\in_array($art_id, $options) == false ? '' : "selected='selected'") . '>' . $articlesAll[$i]->getVar('art_title') . '</option>';
	}
	$form .= '</select>';

	return $form;

}
