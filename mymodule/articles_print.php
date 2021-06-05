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
require_once XOOPS_ROOT_PATH . '/header.php';
$artId = Request::getInt('art_id');
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
if (empty($artId)) {
	\redirect_header(MYMODULE_URL . '/index.php', 2, _MA_MYMODULE_INVALID_PARAM);
}
// Get Instance of Handler
$articlesHandler = $helper->getHandler('Articles');
$grouppermHandler = \xoops_getHandler('groupperm');
// Verify that the article is published
$articles = $articlesHandler->get($artId);
// Verify permissions
if (!$grouppermHandler->checkRight('mymodule_view', $artId->getVar('art_id'), $groups, $GLOBALS['xoopsModule']->getVar('mid'))) {
	\redirect_header(MYMODULE_URL . '/index.php', 3, _NOPERM);
	exit();
}
$article = $articles->getValuesArticles();
$GLOBALS['xoopsTpl']->append('articles_list', $article);

$GLOBALS['xoopsTpl']->assign('xoops_sitename', $GLOBALS['xoopsConfig']['sitename']);
$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($articles->getVar('art_title') . ' - ' . _MA_MYMODULE_PRINT . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
$GLOBALS['xoopsTpl']->display('db:articles_print.tpl');
