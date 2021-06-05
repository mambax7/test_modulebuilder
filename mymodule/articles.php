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
use XoopsModules\Mymodule\Common;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'mymodule_articles.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $helper->getConfig('userpager'));
$artId = Request::getInt('art_id', 0);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Paths
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('mymodule_url', MYMODULE_URL);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => _MA_MYMODULE_INDEX, 'link' => 'index.php'];
// Permissions
$permEdit = $permissionsHandler->getPermGlobalSubmit();
$GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
$GLOBALS['xoopsTpl']->assign('showItem', $artId > 0);

switch ($op) {
	case 'show':
	case 'list':
	default:
		// Breadcrumbs
		$xoBreadcrumbs[] = ['title' => _MA_MYMODULE_ARTICLES_LIST];
		$ratingbars = (int)$helper->getConfig('ratingbars');
		if ($ratingbars > 0) {
			$GLOBALS['xoTheme']->addStylesheet(MYMODULE_URL . '/assets/css/rating.css', null);
			$GLOBALS['xoopsTpl']->assign('rating', $ratingbars);
			$GLOBALS['xoopsTpl']->assign('rating_5stars', (Constants::RATING_5STARS === $ratingbars));
			$GLOBALS['xoopsTpl']->assign('rating_10stars', (Constants::RATING_10STARS === $ratingbars));
			$GLOBALS['xoopsTpl']->assign('rating_10num', (Constants::RATING_10NUM === $ratingbars));
			$GLOBALS['xoopsTpl']->assign('rating_likes', (Constants::RATING_LIKES === $ratingbars));
			$GLOBALS['xoopsTpl']->assign('itemid', 'art_id');
			$GLOBALS['xoopsTpl']->assign('mymodule_icon_url_16', MYMODULE_URL . '/' . $modPathIcon16);
		}
		$crArticles = new \CriteriaCompo();
		if ($artId > 0) {
			$crArticles->add(new \Criteria('art_id', $artId));
		}
		$articlesCount = $articlesHandler->getCount($crArticles);
		$GLOBALS['xoopsTpl']->assign('articlesCount', $articlesCount);
		$crArticles->setStart($start);
		$crArticles->setLimit($limit);
		$articlesAll = $articlesHandler->getAll($crArticles);
		if ($articlesCount > 0) {
			$articles = [];
			$artTitle = '';
			// Get All Articles
			foreach (\array_keys($articlesAll) as $i) {
				$articles[$i] = $articlesAll[$i]->getValuesArticles();
				$artTitle = $articlesAll[$i]->getVar('art_title');
				$keywords[$i] = $artTitle;
				$articles[$i]['rating'] = $ratingsHandler->getItemRating($articlesAll[$i]->getVar('art_id'), Constants::TABLE_ARTICLES);
			}
			$GLOBALS['xoopsTpl']->assign('articles', $articles);
			unset($articles);
			// Display Navigation
			if ($articlesCount > $limit) {
				include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
				$pagenav = new \XoopsPageNav($articlesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
			$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
			$GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));
			$GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
			$GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
			if ('show' == $op && '' != $artTitle) {
				$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($artTitle . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
			}
		}
		break;
	case 'save':
		// Security Check
		if (!$GLOBALS['xoopsSecurity']->check()) {
			\redirect_header('articles.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		// Check permissions
		if (!$permissionsHandler->getPermGlobalSubmit()) {
			\redirect_header('articles.php?op=list', 3, _NOPERM);
		}
		if ($artId > 0) {
			$articlesObj = $articlesHandler->get($artId);
		} else {
			$articlesObj = $articlesHandler->create();
		}
		$articlesObj->setVar('art_cat', Request::getInt('art_cat', 0));
		$articlesObj->setVar('art_title', Request::getString('art_title', ''));
		$articlesObj->setVar('art_descr', Request::getText('art_descr', ''));
		// Set Var art_img
		include_once XOOPS_ROOT_PATH . '/class/uploader.php';
		$filename       = $_FILES['art_img']['name'];
		$imgMimetype    = $_FILES['art_img']['type'];
		$imgNameDef     = Request::getString('art_title');
		$uploaderErrors = '';
		$uploader = new \XoopsMediaUploader(MYMODULE_UPLOAD_IMAGE_PATH . '/articles/', 
													$helper->getConfig('mimetypes_image'), 
													$helper->getConfig('maxsize_image'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
			$imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if (!$uploader->upload()) {
				$uploaderErrors = $uploader->getErrors();
			} else {
				$savedFilename = $uploader->getSavedFileName();
				$maxwidth  = (int)$helper->getConfig('maxwidth_image');
				$maxheight = (int)$helper->getConfig('maxheight_image');
				if ($maxwidth > 0 && $maxheight > 0) {
					// Resize image
					$imgHandler                = new Mymodule\Common\Resizer();
					$imgHandler->sourceFile    = MYMODULE_UPLOAD_IMAGE_PATH . '/articles/' . $savedFilename;
					$imgHandler->endFile       = MYMODULE_UPLOAD_IMAGE_PATH . '/articles/' . $savedFilename;
					$imgHandler->imageMimetype = $imgMimetype;
					$imgHandler->maxWidth      = $maxwidth;
					$imgHandler->maxHeight     = $maxheight;
					$result                    = $imgHandler->resizeImage();
				}
				$articlesObj->setVar('art_img', $savedFilename);
			}
		} else {
			if ($filename > '') {
				$uploaderErrors = $uploader->getErrors();
			}
			$articlesObj->setVar('art_img', Request::getString('art_img'));
		}
		$articlesObj->setVar('art_online', Request::getInt('art_online', 0));
		// Set Var art_file
		include_once XOOPS_ROOT_PATH . '/class/uploader.php';
		$filename       = $_FILES['art_file']['name'];
		$imgNameDef     = Request::getString('art_title');
		$uploader = new \XoopsMediaUploader(MYMODULE_UPLOAD_FILES_PATH . '/articles/', 
													$helper->getConfig('mimetypes_file'), 
													$helper->getConfig('maxsize_file'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][1])) {
			$extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
			$imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][1]);
			if (!$uploader->upload()) {
				$errors = $uploader->getErrors();
			} else {
				$articlesObj->setVar('art_file', $uploader->getSavedFileName());
			}
		} else {
			if ($filename > '') {
				$uploaderErrors = $uploader->getErrors();
			}
			$articlesObj->setVar('art_file', Request::getString('art_file'));
		}
		$articlesObj->setVar('art_ratings', Request::getFloat('art_ratings', 0));
		$articlesObj->setVar('art_votes', Request::getInt('art_votes', 0));
		$articleCreatedObj = \DateTime::createFromFormat(_SHORTDATESTRING, Request::getString('art_created'));
		$articlesObj->setVar('art_created', $articleCreatedObj->getTimestamp());
		$articlesObj->setVar('art_submitter', Request::getInt('art_submitter', 0));
		// Insert Data
		if ($articlesHandler->insert($articlesObj)) {
			$newArtId = $artId > 0 ? $artId : $articlesObj->getNewInsertedIdArticles();
			$grouppermHandler = \xoops_getHandler('groupperm');
			$mid = $GLOBALS['xoopsModule']->getVar('mid');
			// Permission to view_articles
			$grouppermHandler->deleteByModule($mid, 'mymodule_view_articles', $newArtId);
			if (isset($_POST['groups_view_articles'])) {
				foreach ($_POST['groups_view_articles'] as $onegroupId) {
					$grouppermHandler->addRight('mymodule_view_articles', $newArtId, $onegroupId, $mid);
				}
			}
			// Permission to submit_articles
			$grouppermHandler->deleteByModule($mid, 'mymodule_submit_articles', $newArtId);
			if (isset($_POST['groups_submit_articles'])) {
				foreach ($_POST['groups_submit_articles'] as $onegroupId) {
					$grouppermHandler->addRight('mymodule_submit_articles', $newArtId, $onegroupId, $mid);
				}
			}
			// Permission to approve_articles
			$grouppermHandler->deleteByModule($mid, 'mymodule_approve_articles', $newArtId);
			if (isset($_POST['groups_approve_articles'])) {
				foreach ($_POST['groups_approve_articles'] as $onegroupId) {
					$grouppermHandler->addRight('mymodule_approve_articles', $newArtId, $onegroupId, $mid);
				}
			}
			// Handle notification
			$artTitle = $articlesObj->getVar('art_title');
			$artOnline = $articlesObj->getVar('art_online');
			$tags = [];
			$tags['ITEM_NAME'] = $artTitle;
			$tags['ITEM_URL']  = XOOPS_URL . '/modules/mymodule/articles.php?op=show&art_id=' . $artId;
			$notificationHandler = \xoops_getHandler('notification');
			if (Constants::STATUS_SUBMITTED == $artOnline) {
				// Event approve notification
				$notificationHandler->triggerEvent('global', 0, 'global_approve', $tags);
				$notificationHandler->triggerEvent('articles', $newArtId, 'article_approve', $tags);
			} else {
				if ($artId > 0) {
					// Event modify notification
					$notificationHandler->triggerEvent('global', 0, 'global_modify', $tags);
					$notificationHandler->triggerEvent('articles', $newArtId, 'article_modify', $tags);
				} else {
					// Event new notification
					$notificationHandler->triggerEvent('global', 0, 'global_new', $tags);
				}
			}
			// redirect after insert
			if ('' !== $uploaderErrors) {
				\redirect_header('articles.php?op=edit&art_id=' . $newArtId, 5, $uploaderErrors);
			} else {
				\redirect_header('articles.php?op=list', 2, _MA_MYMODULE_FORM_OK);
			}
		}
		// Get Form Error
		$GLOBALS['xoopsTpl']->assign('error', $articlesObj->getHtmlErrors());
		$form = $articlesObj->getFormArticles();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'new':
		// Breadcrumbs
		$xoBreadcrumbs[] = ['title' => _MA_MYMODULE_ARTICLE_ADD];
		// Check permissions
		if (!$permissionsHandler->getPermGlobalSubmit()) {
			\redirect_header('articles.php?op=list', 3, _NOPERM);
		}
		// Form Create
		$articlesObj = $articlesHandler->create();
		$form = $articlesObj->getFormArticles();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'edit':
		// Breadcrumbs
		$xoBreadcrumbs[] = ['title' => _MA_MYMODULE_ARTICLE_EDIT];
		// Check permissions
		if (!$permissionsHandler->getPermGlobalSubmit()) {
			\redirect_header('articles.php?op=list', 3, _NOPERM);
		}
		// Check params
		if (0 == $artId) {
			\redirect_header('articles.php?op=list', 3, _MA_MYMODULE_INVALID_PARAM);
		}
		// Get Form
		$articlesObj = $articlesHandler->get($artId);
		$form = $articlesObj->getFormArticles();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'delete':
		// Breadcrumbs
		$xoBreadcrumbs[] = ['title' => _MA_MYMODULE_ARTICLE_DELETE];
		// Check permissions
		if (!$permissionsHandler->getPermGlobalSubmit()) {
			\redirect_header('articles.php?op=list', 3, _NOPERM);
		}
		// Check params
		if (0 == $artId) {
			\redirect_header('articles.php?op=list', 3, _MA_MYMODULE_INVALID_PARAM);
		}
		$articlesObj = $articlesHandler->get($artId);
		$artTitle = $articlesObj->getVar('art_title');
		if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				\redirect_header('articles.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($articlesHandler->delete($articlesObj)) {
				// Event delete notification
				$tags = [];
				$tags['ITEM_NAME'] = $artTitle;
				$notificationHandler = \xoops_getHandler('notification');
				$notificationHandler->triggerEvent('global', 0, 'global_delete', $tags);
				$notificationHandler->triggerEvent('articles', $artId, 'article_delete', $tags);
				\redirect_header('articles.php', 3, _MA_MYMODULE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $articlesObj->getHtmlErrors());
			}
		} else {
			$xoopsconfirm = new Common\XoopsConfirm(
				['ok' => 1, 'art_id' => $artId, 'op' => 'delete'],
				$_SERVER['REQUEST_URI'],
				\sprintf(_MA_MYMODULE_FORM_SURE_DELETE, $articlesObj->getVar('art_title')));
			$form = $xoopsconfirm->getFormXoopsConfirm();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		}
		break;
	case 'broken':
		// Breadcrumbs
		$xoBreadcrumbs[] = ['title' => _MA_MYMODULE_BROKEN];
		// Check params
		if (0 == $artId) {
			\redirect_header('articles.php?op=list', 3, _MA_MYMODULE_INVALID_PARAM);
		}
		$articlesObj = $articlesHandler->get($artId);
		$artTitle = $articlesObj->getVar('art_title');
		if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				\redirect_header('articles.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			$articlesObj->setVar('art_online', Constants::STATUS_BROKEN);
			if ($articlesHandler->insert($articlesObj)) {
				// Event broken notification
				$tags = [];
				$tags['ITEM_NAME'] = $artTitle;
				$tags['ITEM_URL']  = XOOPS_URL . '/modules/mymodule/articles.php?op=show&art_id=' . $artId;
				$notificationHandler = \xoops_getHandler('notification');
				$notificationHandler->triggerEvent('global', 0, 'global_broken', $tags);
				$notificationHandler->triggerEvent('articles', $artId, 'article_broken', $tags);
				\redirect_header('articles.php', 3, _MA_MYMODULE_FORM_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $articlesObj->getHtmlErrors());
			}
		} else {
			$xoopsconfirm = new Common\XoopsConfirm(
				['ok' => 1, 'art_id' => $artId, 'op' => 'broken'],
				$_SERVER['REQUEST_URI'],
				\sprintf(_MA_MYMODULE_FORM_SURE_BROKEN, $articlesObj->getVar('art_title')));
			$form = $xoopsconfirm->getFormXoopsConfirm();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		}
		break;
}

// Keywords
mymoduleMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
mymoduleMetaDescription(_MA_MYMODULE_ARTICLES_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', MYMODULE_URL.'/articles.php');
$GLOBALS['xoopsTpl']->assign('mymodule_upload_url', MYMODULE_UPLOAD_URL);

require __DIR__ . '/footer.php';
