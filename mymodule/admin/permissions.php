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

use Xmf\Request;
use XoopsModules\Mymodule;
use XoopsModules\Mymodule\Constants;

require __DIR__ . '/header.php';

// Template Index
$templateMain = 'mymodule_admin_permissions.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));

$op = Request::getCmd('op', 'global');

// Get Form
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
\xoops_load('XoopsFormLoader');
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', _AM_MYMODULE_PERMISSIONS_GLOBAL);
$formSelect->addOption('approve_articles', _AM_MYMODULE_PERMISSIONS_APPROVE . ' Articles');
$formSelect->addOption('submit_articles', _AM_MYMODULE_PERMISSIONS_SUBMIT . ' Articles');
$formSelect->addOption('view_articles', _AM_MYMODULE_PERMISSIONS_VIEW . ' Articles');
$formSelect->addOption('approve_testfields', _AM_MYMODULE_PERMISSIONS_APPROVE . ' Testfields');
$formSelect->addOption('submit_testfields', _AM_MYMODULE_PERMISSIONS_SUBMIT . ' Testfields');
$formSelect->addOption('view_testfields', _AM_MYMODULE_PERMISSIONS_VIEW . ' Testfields');
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch ($op) {
	case 'global':
	default:
		$formTitle = _AM_MYMODULE_PERMISSIONS_GLOBAL;
		$permName = 'mymodule_ac';
		$permDesc = _AM_MYMODULE_PERMISSIONS_GLOBAL_DESC;
		$globalPerms = ['4' => _AM_MYMODULE_PERMISSIONS_GLOBAL_4, '8' => _AM_MYMODULE_PERMISSIONS_GLOBAL_8, '16' => _AM_MYMODULE_PERMISSIONS_GLOBAL_16];
		break;
	case 'approve_articles':
		$formTitle = _AM_MYMODULE_PERMISSIONS_APPROVE;
		$permName = 'mymodule_approve_articles';
		$permDesc = _AM_MYMODULE_PERMISSIONS_APPROVE_DESC . ' Articles';
		$handler = $helper->getHandler('articles');
		break;
	case 'submit_articles':
		$formTitle = _AM_MYMODULE_PERMISSIONS_SUBMIT;
		$permName = 'mymodule_submit_articles';
		$permDesc = _AM_MYMODULE_PERMISSIONS_SUBMIT_DESC . ' Articles';
		$handler = $helper->getHandler('articles');
		break;
	case 'view_articles':
		$formTitle = _AM_MYMODULE_PERMISSIONS_VIEW;
		$permName = 'mymodule_view_articles';
		$permDesc = _AM_MYMODULE_PERMISSIONS_VIEW_DESC . ' Articles';
		$handler = $helper->getHandler('articles');
		break;
	case 'approve_testfields':
		$formTitle = _AM_MYMODULE_PERMISSIONS_APPROVE;
		$permName = 'mymodule_approve_testfields';
		$permDesc = _AM_MYMODULE_PERMISSIONS_APPROVE_DESC . ' Testfields';
		$handler = $helper->getHandler('testfields');
		break;
	case 'submit_testfields':
		$formTitle = _AM_MYMODULE_PERMISSIONS_SUBMIT;
		$permName = 'mymodule_submit_testfields';
		$permDesc = _AM_MYMODULE_PERMISSIONS_SUBMIT_DESC . ' Testfields';
		$handler = $helper->getHandler('testfields');
		break;
	case 'view_testfields':
		$formTitle = _AM_MYMODULE_PERMISSIONS_VIEW;
		$permName = 'mymodule_view_testfields';
		$permDesc = _AM_MYMODULE_PERMISSIONS_VIEW_DESC . ' Testfields';
		$handler = $helper->getHandler('testfields');
		break;
}
$moduleId = $xoopsModule->getVar('mid');
$permform = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php');
$permFound = false;
if ('global' === $op) {
	foreach ($globalPerms as $gPermId => $gPermName) {
		$permform->addItem($gPermId, $gPermName);
	}
	$GLOBALS['xoopsTpl']->assign('form', $permform->render());
	$permFound = true;
}
if ('approve_articles' === $op || 'submit_articles' === $op || 'view_articles' === $op) {
	$articlesCount = $articlesHandler->getCountArticles();
	if ($articlesCount > 0) {
		$articlesAll = $articlesHandler->getAllArticles(0, 'art_title');
		foreach (\array_keys($articlesAll) as $i) {
			$permform->addItem($articlesAll[$i]->getVar('art_id'), $articlesAll[$i]->getVar('art_title'));
		}
		$GLOBALS['xoopsTpl']->assign('form', $permform->render());
	}
	$permFound = true;
}
if ('approve_testfields' === $op || 'submit_testfields' === $op || 'view_testfields' === $op) {
	$testfieldsCount = $testfieldsHandler->getCountTestfields();
	if ($testfieldsCount > 0) {
		$testfieldsAll = $testfieldsHandler->getAllTestfields(0, 'tf_text');
		foreach (\array_keys($testfieldsAll) as $i) {
			$permform->addItem($testfieldsAll[$i]->getVar('tf_id'), $testfieldsAll[$i]->getVar('tf_text'));
		}
		$GLOBALS['xoopsTpl']->assign('form', $permform->render());
	}
	$permFound = true;
}
unset($permform);
if (true !== $permFound) {
	\redirect_header('permissions.php', 3, _AM_MYMODULE_NO_PERMISSIONS_SET);
	exit();
}
require __DIR__ . '/footer.php';
