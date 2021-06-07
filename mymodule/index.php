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
 * @author         TDM XOOPS - Email:<info@email.com> - Website:<https://xoops.org>
 */

use Xmf\Request;
use XoopsModules\Mymodule;
use XoopsModules\Mymodule\Constants;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'mymodule_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => _MA_MYMODULE_INDEX];
// Paths
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('mymodule_url', MYMODULE_URL);
// Tables
$articlesCount = $articlesHandler->getCountArticles();
$GLOBALS['xoopsTpl']->assign('articlesCount', $articlesCount);
$count = 1;
if ($articlesCount > 0) {
	$start = Request::getInt('start', 0);
	$limit = Request::getInt('limit', $helper->getConfig('userpager'));
	$articlesAll = $articlesHandler->getAllArticles($start, $limit);
	// Get All Articles
	$articles = [];
	foreach (\array_keys($articlesAll) as $i) {
		$article = $articlesAll[$i]->getValuesArticles();
		$acount = ['count', $count];
		$articles[] = \array_merge($article, $acount);
		$keywords[] = $articlesAll[$i]->getVar('tf_text');
		++$count;
	}
	$GLOBALS['xoopsTpl']->assign('articles', $articles);
	unset($articles);
	// Display Navigation
	if ($articlesCount > $limit) {
		require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
		$pagenav = new \XoopsPageNav($articlesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
		$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
	}
	$GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(_MA_MYMODULE_INDEX_THEREARE, $articlesCount));
	$GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
	$GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Tables
$testfieldsCount = $testfieldsHandler->getCountTestfields();
$GLOBALS['xoopsTpl']->assign('testfieldsCount', $testfieldsCount);
$count = 1;
if ($testfieldsCount > 0) {
	$start = Request::getInt('start', 0);
	$limit = Request::getInt('limit', $helper->getConfig('userpager'));
	$testfieldsAll = $testfieldsHandler->getAllTestfields($start, $limit);
	// Get All Testfields
	$testfields = [];
	foreach (\array_keys($testfieldsAll) as $i) {
		$testfield = $testfieldsAll[$i]->getValuesTestfields();
		$acount = ['count', $count];
		$testfields[] = \array_merge($testfield, $acount);
		$keywords[] = $testfieldsAll[$i]->getVar('tf_text');
		++$count;
	}
	$GLOBALS['xoopsTpl']->assign('testfields', $testfields);
	unset($testfields);
	// Display Navigation
	if ($testfieldsCount > $limit) {
		require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
		$pagenav = new \XoopsPageNav($testfieldsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
		$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
	}
	$GLOBALS['xoopsTpl']->assign('lang_thereare', \sprintf(_MA_MYMODULE_INDEX_THEREARE, $testfieldsCount));
	$GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
	$GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Keywords
mymoduleMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);
// Description
mymoduleMetaDescription(_MA_MYMODULE_INDEX_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', MYMODULE_URL.'/index.php');
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('mymodule_upload_url', MYMODULE_UPLOAD_URL);
require __DIR__ . '/footer.php';
