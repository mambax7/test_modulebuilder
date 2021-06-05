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

require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
\define('_MI_MYMODULE_NAME', 'My Module');
\define('_MI_MYMODULE_DESC', 'This module is for doing following...');
// ---------------- Admin Menu ----------------
\define('_MI_MYMODULE_ADMENU1', 'Dashboard');
\define('_MI_MYMODULE_ADMENU2', 'Categories');
\define('_MI_MYMODULE_ADMENU3', 'Articles');
\define('_MI_MYMODULE_ADMENU4', 'Testfields');
\define('_MI_MYMODULE_ADMENU5', 'Broken items');
\define('_MI_MYMODULE_ADMENU6', 'Permissions');
\define('_MI_MYMODULE_ADMENU7', 'Clone');
\define('_MI_MYMODULE_ADMENU8', 'Feedback');
\define('_MI_MYMODULE_ABOUT', 'About');
// ---------------- Admin Nav ----------------
\define('_MI_MYMODULE_ADMIN_PAGER', 'Admin pager');
\define('_MI_MYMODULE_ADMIN_PAGER_DESC', 'Admin per page list');
// User
\define('_MI_MYMODULE_USER_PAGER', 'User pager');
\define('_MI_MYMODULE_USER_PAGER_DESC', 'User per page list');
// Submenu
\define('_MI_MYMODULE_SMNAME1', 'Index page');
\define('_MI_MYMODULE_SMNAME3', 'Articles');
\define('_MI_MYMODULE_SMNAME4', 'Submit Articles');
\define('_MI_MYMODULE_SMNAME5', 'Testfields');
\define('_MI_MYMODULE_SMNAME6', 'Submit Testfields');
\define('_MI_MYMODULE_SMNAME7', 'Search');
// Rating bars
\define('_MI_MYMODULE_RATINGBAR_GROUPS', 'Groups with rating rights');
\define('_MI_MYMODULE_RATINGBAR_GROUPS_DESC', 'Select groups which should have the right to rate');
\define('_MI_MYMODULE_RATINGBARS', 'Allow rating');
\define('_MI_MYMODULE_RATINGBARS_DESC', 'Define whether rating should be possible and which kind of rating should be used');
\define('_MI_MYMODULE_RATING_NONE', 'Do not use rating');
\define('_MI_MYMODULE_RATING_5STARS', 'Rating with 5 stars');
\define('_MI_MYMODULE_RATING_10STARS', 'Rating with 10 stars');
\define('_MI_MYMODULE_RATING_LIKES', 'Rating with likes and dislikes');
\define('_MI_MYMODULE_RATING_10NUM', 'Rating with 10 points');
// Blocks
\define('_MI_MYMODULE_ARTICLES_BLOCK', 'Articles block');
\define('_MI_MYMODULE_ARTICLES_BLOCK_DESC', 'Articles block description');
\define('_MI_MYMODULE_ARTICLES_BLOCK_ARTICLE', 'Articles block  ARTICLE');
\define('_MI_MYMODULE_ARTICLES_BLOCK_ARTICLE_DESC', 'Articles block  ARTICLE description');
\define('_MI_MYMODULE_ARTICLES_BLOCK_LAST', 'Articles block last');
\define('_MI_MYMODULE_ARTICLES_BLOCK_LAST_DESC', 'Articles block last description');
\define('_MI_MYMODULE_ARTICLES_BLOCK_NEW', 'Articles block new');
\define('_MI_MYMODULE_ARTICLES_BLOCK_NEW_DESC', 'Articles block new description');
\define('_MI_MYMODULE_ARTICLES_BLOCK_HITS', 'Articles block hits');
\define('_MI_MYMODULE_ARTICLES_BLOCK_HITS_DESC', 'Articles block hits description');
\define('_MI_MYMODULE_ARTICLES_BLOCK_TOP', 'Articles block top');
\define('_MI_MYMODULE_ARTICLES_BLOCK_TOP_DESC', 'Articles block top description');
\define('_MI_MYMODULE_ARTICLES_BLOCK_RANDOM', 'Articles block random');
\define('_MI_MYMODULE_ARTICLES_BLOCK_RANDOM_DESC', 'Articles block random description');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK', 'Testfields block');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_DESC', 'Testfields block description');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_TESTFIELD', 'Testfields block  TESTFIELD');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_TESTFIELD_DESC', 'Testfields block  TESTFIELD description');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_LAST', 'Testfields block last');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_LAST_DESC', 'Testfields block last description');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_NEW', 'Testfields block new');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_NEW_DESC', 'Testfields block new description');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_HITS', 'Testfields block hits');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_HITS_DESC', 'Testfields block hits description');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_TOP', 'Testfields block top');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_TOP_DESC', 'Testfields block top description');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_RANDOM', 'Testfields block random');
\define('_MI_MYMODULE_TESTFIELDS_BLOCK_RANDOM_DESC', 'Testfields block random description');
// Config
\define('_MI_MYMODULE_EDITOR_ADMIN', 'Editor admin');
\define('_MI_MYMODULE_EDITOR_ADMIN_DESC', 'Select the editor which should be used in admin area for text area fields');
\define('_MI_MYMODULE_EDITOR_USER', 'Editor user');
\define('_MI_MYMODULE_EDITOR_USER_DESC', 'Select the editor which should be used in user area for text area fields');
\define('_MI_MYMODULE_EDITOR_MAXCHAR', 'Text max characters');
\define('_MI_MYMODULE_EDITOR_MAXCHAR_DESC', 'Max characters for showing text of a textarea or editor field in admin area');
\define('_MI_MYMODULE_KEYWORDS', 'Keywords');
\define('_MI_MYMODULE_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
\define('_MI_MYMODULE_SIZE_MB', 'MB');
\define('_MI_MYMODULE_MAXSIZE_IMAGE', 'Max size image');
\define('_MI_MYMODULE_MAXSIZE_IMAGE_DESC', 'Define the max size for uploading images');
\define('_MI_MYMODULE_MIMETYPES_IMAGE', 'Mime types image');
\define('_MI_MYMODULE_MIMETYPES_IMAGE_DESC', 'Define the allowed mime types for uploading images');
\define('_MI_MYMODULE_MAXWIDTH_IMAGE', 'Max width image');
\define('_MI_MYMODULE_MAXWIDTH_IMAGE_DESC', 'Set the max width to which uploaded images should be scaled (in pixel)<br>0 means, that images keeps the original size. <br>If an image is smaller than maximum value then the image will be not enlarge, it will be save in original width.');
\define('_MI_MYMODULE_MAXHEIGHT_IMAGE', 'Max height image');
\define('_MI_MYMODULE_MAXHEIGHT_IMAGE_DESC', 'Set the max height to which uploaded images should be scaled (in pixel)<br>0 means, that images keeps the original size. <br>If an image is smaller than maximum value then the image will be not enlarge, it will be save in original height');
\define('_MI_MYMODULE_MAXSIZE_FILE', 'Max size file');
\define('_MI_MYMODULE_MAXSIZE_FILE_DESC', 'Define the max size for uploading files');
\define('_MI_MYMODULE_MIMETYPES_FILE', 'Mime types file');
\define('_MI_MYMODULE_MIMETYPES_FILE_DESC', 'Define the allowed mime types for uploading files');
\define('_MI_MYMODULE_USE_TAG', 'Use TAG');
\define('_MI_MYMODULE_USE_TAG_DESC', 'If you use tag module, check this option to yes');
\define('_MI_MYMODULE_NUMB_COL', 'Number Columns');
\define('_MI_MYMODULE_NUMB_COL_DESC', 'Number Columns to View');
\define('_MI_MYMODULE_DIVIDEBY', 'Divide By');
\define('_MI_MYMODULE_DIVIDEBY_DESC', 'Divide by columns number');
\define('_MI_MYMODULE_TABLE_TYPE', 'Table Type');
\define('_MI_MYMODULE_TABLE_TYPE_DESC', 'Table Type is the bootstrap html table');
\define('_MI_MYMODULE_PANEL_TYPE', 'Panel Type');
\define('_MI_MYMODULE_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div');
\define('_MI_MYMODULE_IDPAYPAL', 'Paypal ID');
\define('_MI_MYMODULE_IDPAYPAL_DESC', 'Insert here your PayPal ID for donations');
\define('_MI_MYMODULE_SHOW_BREADCRUMBS', 'Show breadcrumb navigation');
\define('_MI_MYMODULE_SHOW_BREADCRUMBS_DESC', 'Show breadcrumb navigation which displays the current page in context within the site structure');
\define('_MI_MYMODULE_ADVERTISE', 'Advertisement Code');
\define('_MI_MYMODULE_ADVERTISE_DESC', 'Insert here the advertisement code');
\define('_MI_MYMODULE_MAINTAINEDBY', 'Maintained By');
\define('_MI_MYMODULE_MAINTAINEDBY_DESC', 'Allow url of support site or community');
\define('_MI_MYMODULE_BOOKMARKS', 'Social Bookmarks');
\define('_MI_MYMODULE_BOOKMARKS_DESC', 'Show Social Bookmarks in the single page');
// Global notifications
\define('_MI_MYMODULE_NOTIFY_GLOBAL', 'Global notification');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_NEW', 'Any new item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_NEW_CAPTION', 'Notify me about any new item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_NEW_SUBJECT', 'Notification about new item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_MODIFY', 'Any modified item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_MODIFY_CAPTION', 'Notify me about any item modification');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_MODIFY_SUBJECT', 'Notification about modification');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_DELETE', 'Any deleted item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_DELETE_CAPTION', 'Notify me about any deleted item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_DELETE_SUBJECT', 'Notification about deleted item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_APPROVE', 'Any item to approve');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_APPROVE_CAPTION', 'Notify me about any item waiting for approvement');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_APPROVE_SUBJECT', 'Notification about item waiting for approvement');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_BROKEN', 'Any broken item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_BROKEN_CAPTION', 'Notify me about any broken item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_BROKEN_SUBJECT', 'Notification about broken item');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_COMMENT', 'Any comments');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_COMMENT_CAPTION', 'Notify me about any comment');
\define('_MI_MYMODULE_NOTIFY_GLOBAL_COMMENT_SUBJECT', 'Notification about any comment');
// Article notifications
\define('_MI_MYMODULE_NOTIFY_ARTICLE', 'Article notification');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_MODIFY', 'Article modification');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_MODIFY_CAPTION', 'Notify me about article modification');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_MODIFY_SUBJECT', 'Notification about modification');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_DELETE', 'Article deleted');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_DELETE_CAPTION', 'Notify me about deleted articles');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_DELETE_SUBJECT', 'Notification delete article');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_APPROVE', 'Article approve');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_APPROVE_CAPTION', 'Notify me about articles waiting for approvement');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_APPROVE_SUBJECT', 'Notification article waiting for approvement');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_BROKEN', 'Article broken');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_BROKEN_CAPTION', 'Notify me about broken article');
\define('_MI_MYMODULE_NOTIFY_ARTICLE_BROKEN_SUBJECT', 'Notification about broken article');
// Testfield notifications
\define('_MI_MYMODULE_NOTIFY_TESTFIELD', 'Testfield notification');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_MODIFY', 'Testfield modification');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_MODIFY_CAPTION', 'Notify me about testfield modification');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_MODIFY_SUBJECT', 'Notification about modification');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_DELETE', 'Testfield deleted');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_DELETE_CAPTION', 'Notify me about deleted testfields');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_DELETE_SUBJECT', 'Notification delete testfield');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_APPROVE', 'Testfield approve');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_APPROVE_CAPTION', 'Notify me about testfields waiting for approvement');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_APPROVE_SUBJECT', 'Notification testfield waiting for approvement');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_BROKEN', 'Testfield broken');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_BROKEN_CAPTION', 'Notify me about broken testfield');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_BROKEN_SUBJECT', 'Notification about broken testfield');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_COMMENT', 'Testfield comment');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_COMMENT_CAPTION', 'Notify me about comments for testfield');
\define('_MI_MYMODULE_NOTIFY_TESTFIELD_COMMENT_SUBJECT', 'Notification about comments for testfield');
// Permissions Groups
\define('_MI_MYMODULE_GROUPS', 'Groups access');
\define('_MI_MYMODULE_GROUPS_DESC', 'Select general access permission for groups.');
\define('_MI_MYMODULE_ADMIN_GROUPS', 'Admin Group Permissions');
\define('_MI_MYMODULE_ADMIN_GROUPS_DESC', 'Which groups have access to tools and permissions page');
\define('_MI_MYMODULE_UPLOAD_GROUPS', 'Upload Group Permissions');
\define('_MI_MYMODULE_UPLOAD_GROUPS_DESC', 'Which groups have permissions to upload files');
// ---------------- End ----------------
