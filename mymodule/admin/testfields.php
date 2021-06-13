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
 * @copyright      2021 XOOPS Project (https://xoops.org)
 * @license        GPL 2.0 or later
 * @package        mymodule
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         TDM XOOPS - Email:<info@email.com> - Website:<http://xoops.org>
 */

use Xmf\Request;
use XoopsModules\Mymodule;
use XoopsModules\Mymodule\Constants;
use XoopsModules\Mymodule\Common;

require __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getCmd('op', 'list');
// Request tf_id
$tfId = Request::getInt('tf_id');
switch ($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet($style, null);
		$start = Request::getInt('start', 0);
		$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
		$templateMain = 'mymodule_admin_testfields.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
		$adminObject->addItemButton(\_AM_MYMODULE_ADD_TESTFIELD, 'testfields.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$testfieldsCount = $testfieldsHandler->getCountTestfields();
		$testfieldsAll = $testfieldsHandler->getAllTestfields($start, $limit);
		$GLOBALS['xoopsTpl']->assign('testfields_count', $testfieldsCount);
		$GLOBALS['xoopsTpl']->assign('mymodule_url', \MYMODULE_URL);
		$GLOBALS['xoopsTpl']->assign('mymodule_upload_url', \MYMODULE_UPLOAD_URL);
		// Table view testfields
		if ($testfieldsCount > 0) {
			foreach (\array_keys($testfieldsAll) as $i) {
				$testfield = $testfieldsAll[$i]->getValuesTestfields();
				$GLOBALS['xoopsTpl']->append('testfields_list', $testfield);
				unset($testfield);
			}
			// Display Navigation
			if ($testfieldsCount > $limit) {
				require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
				$pagenav = new \XoopsPageNav($testfieldsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', \_AM_MYMODULE_THEREARENT_TESTFIELDS);
		}
		break;
	case 'new':
		$templateMain = 'mymodule_admin_testfields.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
		$adminObject->addItemButton(\_AM_MYMODULE_LIST_TESTFIELDS, 'testfields.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Form Create
		$testfieldsObj = $testfieldsHandler->create();
		$form = $testfieldsObj->getFormTestfields();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'save':
		// Security Check
		if (!$GLOBALS['xoopsSecurity']->check()) {
			\redirect_header('testfields.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if ($tfId > 0) {
			$testfieldsObj = $testfieldsHandler->get($tfId);
		} else {
			$testfieldsObj = $testfieldsHandler->create();
		}
		// Set Vars
		$uploaderErrors = '';
		$testfieldsObj->setVar('tf_text', Request::getString('tf_text', ''));
		$testfieldsObj->setVar('tf_textarea', Request::getString('tf_textarea', ''));
		$testfieldsObj->setVar('tf_dhtml', Request::getText('tf_dhtml', ''));
		$testfieldsObj->setVar('tf_checkbox', Request::getInt('tf_checkbox', 0));
		$testfieldsObj->setVar('tf_yesno', Request::getInt('tf_yesno', 0));
		$testfieldsObj->setVar('tf_selectbox', Request::getInt('tf_selectbox', 0));
		$testfieldsObj->setVar('tf_user', Request::getInt('tf_user', 0));
		$testfieldsObj->setVar('tf_color', Request::getString('tf_color', ''));
		// Set Var tf_imagelist
		require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
		$uploader = new \XoopsMediaUploader(\XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32', 
													$helper->getConfig('mimetypes_image'), 
													$helper->getConfig('maxsize_image'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			//$uploader->setPrefix(tf_imagelist_);
			//$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if ($uploader->upload()) {
				$testfieldsObj->setVar('tf_imagelist', $uploader->getSavedFileName());
			} else {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
		} else {
			$testfieldsObj->setVar('tf_imagelist', Request::getString('tf_imagelist'));
		}
		$testfieldsObj->setVar('tf_urlfile', formatURL($_REQUEST['tf_urlfile']));
		// Set Var tf_urlfile
		require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
		$filename       = $_FILES['tf_urlfile']['name'];
		$imgNameDef     = Request::getString('tf_text');
		$uploader = new \XoopsMediaUploader(\MYMODULE_UPLOAD_FILES_PATH . '/testfields/', 
													$helper->getConfig('mimetypes_file'), 
													$helper->getConfig('maxsize_file'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][1])) {
			$extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
			$imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][1]);
			if ($uploader->upload()) {
				$testfieldsObj->setVar('tf_urlfile', $uploader->getSavedFileName());
			} else {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
		} else {
			if ($filename > '') {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
			$testfieldsObj->setVar('tf_urlfile', Request::getString('tf_urlfile'));
		}
		// Set Var tf_uplimage
		require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
		$filename       = $_FILES['tf_uplimage']['name'];
		$imgMimetype    = $_FILES['tf_uplimage']['type'];
		$imgNameDef     = Request::getString('tf_text');
		$uploader = new \XoopsMediaUploader(\MYMODULE_UPLOAD_IMAGE_PATH . '/testfields/', 
													$helper->getConfig('mimetypes_image'), 
													$helper->getConfig('maxsize_image'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][2])) {
			$extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
			$imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][2]);
			if ($uploader->upload()) {
				$savedFilename = $uploader->getSavedFileName();
				$maxwidth  = (int)$helper->getConfig('maxwidth_image');
				$maxheight = (int)$helper->getConfig('maxheight_image');
				if ($maxwidth > 0 && $maxheight > 0) {
					// Resize image
					$imgHandler                = new Mymodule\Common\Resizer();
					$imgHandler->sourceFile    = \MYMODULE_UPLOAD_IMAGE_PATH . '/testfields/' . $savedFilename;
					$imgHandler->endFile       = \MYMODULE_UPLOAD_IMAGE_PATH . '/testfields/' . $savedFilename;
					$imgHandler->imageMimetype = $imgMimetype;
					$imgHandler->maxWidth      = $maxwidth;
					$imgHandler->maxHeight     = $maxheight;
					$result                    = $imgHandler->resizeImage();
				}
				$testfieldsObj->setVar('tf_uplimage', $savedFilename);
			} else {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
		} else {
			if ($filename > '') {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
			$testfieldsObj->setVar('tf_uplimage', Request::getString('tf_uplimage'));
		}
		// Set Var tf_uplfile
		require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
		$filename       = $_FILES['tf_uplfile']['name'];
		$imgNameDef     = Request::getString('tf_text');
		$uploader = new \XoopsMediaUploader(\MYMODULE_UPLOAD_FILES_PATH . '/testfields/', 
													$helper->getConfig('mimetypes_file'), 
													$helper->getConfig('maxsize_file'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][3])) {
			$extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
			$imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][3]);
			if ($uploader->upload()) {
				$testfieldsObj->setVar('tf_uplfile', $uploader->getSavedFileName());
			} else {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
		} else {
			if ($filename > '') {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
			$testfieldsObj->setVar('tf_uplfile', Request::getString('tf_uplfile'));
		}
		$testfieldTextdateselectObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('tf_textdateselect'));
		$testfieldsObj->setVar('tf_textdateselect', $testfieldTextdateselectObj->getTimestamp());
		// Set Var tf_selectfile
		require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
		$filename       = $_FILES['tf_selectfile']['name'];
		$imgNameDef     = Request::getString('tf_text');
		$uploader = new \XoopsMediaUploader(\MYMODULE_UPLOAD_FILES_PATH . '/testfields/', 
													$helper->getConfig('mimetypes_file'), 
													$helper->getConfig('maxsize_file'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][4])) {
			$extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
			$imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][4]);
			if ($uploader->upload()) {
				$testfieldsObj->setVar('tf_selectfile', $uploader->getSavedFileName());
			} else {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
		} else {
			if ($filename > '') {
				$uploaderErrors .= '<br>' . $uploader->getErrors();
			}
			$testfieldsObj->setVar('tf_selectfile', Request::getString('tf_selectfile'));
		}
		$tfPassword = Request::getString('tf_password', '');
		if ('' !== $tfPassword) {
			$testfieldsObj->setVar('tf_password', password_hash($tfPassword, PASSWORD_DEFAULT));
		}
		$testfieldsObj->setVar('tf_country_list', Request::getString('tf_country_list', ''));
		$testfieldsObj->setVar('tf_language', Request::getString('tf_language', ''));
		$testfieldsObj->setVar('tf_radio', Request::getInt('tf_radio', 0));
		$testfieldsObj->setVar('tf_status', Request::getInt('tf_status', 0));
		$testfieldDatetimeArr = Request::getArray('tf_datetime');
		$testfieldDatetimeObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $testfieldDatetimeArr['date']);
		$testfieldDatetimeObj->setTime(0, 0, 0);
		$testfieldDatetime = $testfieldDatetimeObj->getTimestamp() + (int)$testfieldDatetimeArr['time'];
		$testfieldsObj->setVar('tf_datetime', $testfieldDatetime);
		$testfieldsObj->setVar('tf_combobox', Request::getInt('tf_combobox', 0));
		$testfieldsObj->setVar('tf_comments', Request::getInt('tf_comments', 0));
		$testfieldsObj->setVar('tf_ratings', Request::getFloat('tf_ratings', 0));
		$testfieldsObj->setVar('tf_votes', Request::getInt('tf_votes', 0));
		$testfieldsObj->setVar('tf_uuid', Request::getString('tf_uuid', ''));
		$testfieldsObj->setVar('tf_ip', Request::getString('tf_ip', ''));
		$testfieldsObj->setVar('tf_reads', Request::getInt('tf_reads', 0));
		// Insert Data
		if ($testfieldsHandler->insert($testfieldsObj)) {
			$newTfId = $testfieldsObj->getNewInsertedIdTestfields();
			$permId = isset($_REQUEST['tf_id']) ? $tfId : $newTfId;
			$grouppermHandler = \xoops_getHandler('groupperm');
			$mid = $GLOBALS['xoopsModule']->getVar('mid');
			// Permission to view_testfields
			$grouppermHandler->deleteByModule($mid, 'mymodule_view_testfields', $permId);
			if (isset($_POST['groups_view_testfields'])) {
				foreach ($_POST['groups_view_testfields'] as $onegroupId) {
					$grouppermHandler->addRight('mymodule_view_testfields', $permId, $onegroupId, $mid);
				}
			}
			// Permission to submit_testfields
			$grouppermHandler->deleteByModule($mid, 'mymodule_submit_testfields', $permId);
			if (isset($_POST['groups_submit_testfields'])) {
				foreach ($_POST['groups_submit_testfields'] as $onegroupId) {
					$grouppermHandler->addRight('mymodule_submit_testfields', $permId, $onegroupId, $mid);
				}
			}
			// Permission to approve_testfields
			$grouppermHandler->deleteByModule($mid, 'mymodule_approve_testfields', $permId);
			if (isset($_POST['groups_approve_testfields'])) {
				foreach ($_POST['groups_approve_testfields'] as $onegroupId) {
					$grouppermHandler->addRight('mymodule_approve_testfields', $permId, $onegroupId, $mid);
				}
			}
			if ('' !== $uploaderErrors) {
				\redirect_header('testfields.php?op=edit&tf_id=' . $tfId, 5, $uploaderErrors);
			} else {
				\redirect_header('testfields.php?op=list', 2, \_AM_MYMODULE_FORM_OK);
			}
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $testfieldsObj->getHtmlErrors());
		$form = $testfieldsObj->getFormTestfields();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'edit':
		$templateMain = 'mymodule_admin_testfields.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
		$adminObject->addItemButton(\_AM_MYMODULE_ADD_TESTFIELD, 'testfields.php?op=new', 'add');
		$adminObject->addItemButton(\_AM_MYMODULE_LIST_TESTFIELDS, 'testfields.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$testfieldsObj = $testfieldsHandler->get($tfId);
		$form = $testfieldsObj->getFormTestfields();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'delete':
		$templateMain = 'mymodule_admin_testfields.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('testfields.php'));
		$testfieldsObj = $testfieldsHandler->get($tfId);
		$tfText = $testfieldsObj->getVar('tf_text');
		if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				\redirect_header('testfields.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($testfieldsHandler->delete($testfieldsObj)) {
				\redirect_header('testfields.php', 3, \_AM_MYMODULE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $testfieldsObj->getHtmlErrors());
			}
		} else {
			$xoopsconfirm = new Common\XoopsConfirm(
				['ok' => 1, 'tf_id' => $tfId, 'op' => 'delete'],
				$_SERVER['REQUEST_URI'],
				\sprintf(\_AM_MYMODULE_FORM_SURE_DELETE, $testfieldsObj->getVar('tf_text')));
			$form = $xoopsconfirm->getFormXoopsConfirm();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		}
		break;
}
require __DIR__ . '/footer.php';
