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

require_once __DIR__ . '/admin.php';

// ---------------- Main ----------------
\define('_MA_MYMODULE_INDEX', 'Overview My Module');
\define('_MA_MYMODULE_TITLE', 'My Module');
\define('_MA_MYMODULE_DESC', 'This module is for doing following...');
\define('_MA_MYMODULE_INDEX_DESC', "Welcome to the homepage of your new module My Module!<br>
As you can see, you have created a page with a list of links at the top to navigate between the pages of your module. This description is only visible on the homepage of this module, the other pages you will see the content you created when you built this module with the module ModuleBuilder, and after creating new content in admin of this module. In order to expand this module with other resources, just add the code you need to extend the functionality of the same. The files are grouped by type, from the header to the footer to see how divided the source code.<br><br>If you see this message, it is because you have not created content for this module. Once you have created any type of content, you will not see this message.<br><br>If you liked the module ModuleBuilder and thanks to the long process for giving the opportunity to the new module to be created in a moment, consider making a donation to keep the module ModuleBuilder and make a donation using this button <a href='http://www.txmodxoops.org/modules/xdonations/index.php' title='Donation To Txmod Xoops'><img src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt='Button Donations' ></a><br>Thanks!<br><br>Use the link below to go to the admin and create content.");
\define('_MA_MYMODULE_NO_PDF_LIBRARY', 'Libraries TCPDF not there yet, upload them in root/Frameworks');
\define('_MA_MYMODULE_NO', 'No');
\define('_MA_MYMODULE_DETAILS', 'Show details');
\define('_MA_MYMODULE_BROKEN', 'Notify broken');
// ---------------- Contents ----------------
// Article
\define('_MA_MYMODULE_ARTICLE', 'Article');
\define('_MA_MYMODULE_ARTICLE_ADD', 'Add Articles');
\define('_MA_MYMODULE_ARTICLE_EDIT', 'Edit Articles');
\define('_MA_MYMODULE_ARTICLE_DELETE', 'Delete Articles');
\define('_MA_MYMODULE_ARTICLES', 'Articles');
\define('_MA_MYMODULE_ARTICLES_LIST', 'List of Articles');
\define('_MA_MYMODULE_ARTICLES_TITLE', 'Articles title');
\define('_MA_MYMODULE_ARTICLES_DESC', 'Articles description');
// Caption of Article
\define('_MA_MYMODULE_ARTICLE_ID', 'Id');
\define('_MA_MYMODULE_ARTICLE_CAT', 'Cat');
\define('_MA_MYMODULE_ARTICLE_TITLE', 'Title');
\define('_MA_MYMODULE_ARTICLE_DESCR', 'Descr');
\define('_MA_MYMODULE_ARTICLE_IMG', 'Img');
\define('_MA_MYMODULE_ARTICLE_STATUS', 'Status');
\define('_MA_MYMODULE_ARTICLE_FILE', 'File');
\define('_MA_MYMODULE_ARTICLE_RATINGS', 'Ratings');
\define('_MA_MYMODULE_ARTICLE_VOTES', 'Votes');
\define('_MA_MYMODULE_ARTICLE_CREATED', 'Created');
\define('_MA_MYMODULE_ARTICLE_SUBMITTER', 'Submitter');
// Testfield
\define('_MA_MYMODULE_TESTFIELD', 'Testfield');
\define('_MA_MYMODULE_TESTFIELD_ADD', 'Add Testfields');
\define('_MA_MYMODULE_TESTFIELD_EDIT', 'Edit Testfields');
\define('_MA_MYMODULE_TESTFIELD_DELETE', 'Delete Testfields');
\define('_MA_MYMODULE_TESTFIELDS', 'Testfields');
\define('_MA_MYMODULE_TESTFIELDS_LIST', 'List of Testfields');
\define('_MA_MYMODULE_TESTFIELDS_TITLE', 'Testfields title');
\define('_MA_MYMODULE_TESTFIELDS_DESC', 'Testfields description');
// Caption of Testfield
\define('_MA_MYMODULE_TESTFIELD_ID', 'Id');
\define('_MA_MYMODULE_TESTFIELD_TEXT', 'Text');
\define('_MA_MYMODULE_TESTFIELD_TEXTAREA', 'Textarea');
\define('_MA_MYMODULE_TESTFIELD_DHTML', 'Dhtml');
\define('_MA_MYMODULE_TESTFIELD_CHECKBOX', 'Checkbox');
\define('_MA_MYMODULE_TESTFIELD_YESNO', 'Yesno');
\define('_MA_MYMODULE_TESTFIELD_SELECTBOX', 'Selectbox');
\define('_MA_MYMODULE_TESTFIELD_USER', 'User');
\define('_MA_MYMODULE_TESTFIELD_COLOR', 'Color');
\define('_MA_MYMODULE_TESTFIELD_IMAGELIST', 'Imagelist');
\define('_MA_MYMODULE_TESTFIELD_URLFILE', 'Urlfile');
\define('_MA_MYMODULE_TESTFIELD_UPLIMAGE', 'Uplimage');
\define('_MA_MYMODULE_TESTFIELD_UPLFILE', 'Uplfile');
\define('_MA_MYMODULE_TESTFIELD_TEXTDATESELECT', 'Textdateselect');
\define('_MA_MYMODULE_TESTFIELD_SELECTFILE', 'Selectfile');
\define('_MA_MYMODULE_TESTFIELD_PASSWORD', 'Password');
\define('_MA_MYMODULE_TESTFIELD_COUNTRY_LIST', 'Country_list');
\define('_MA_MYMODULE_TESTFIELD_LANGUAGE', 'Language');
\define('_MA_MYMODULE_TESTFIELD_RADIO', 'Radio');
\define('_MA_MYMODULE_TESTFIELD_STATUS', 'Status');
\define('_MA_MYMODULE_TESTFIELD_DATETIME', 'Datetime');
\define('_MA_MYMODULE_TESTFIELD_COMBOBOX', 'Combobox');
\define('_MA_MYMODULE_TESTFIELD_COMMENTS', 'Comments');
\define('_MA_MYMODULE_TESTFIELD_RATINGS', 'Ratings');
\define('_MA_MYMODULE_TESTFIELD_VOTES', 'Votes');
\define('_MA_MYMODULE_TESTFIELD_UUID', 'Uuid');
\define('_MA_MYMODULE_TESTFIELD_IP', 'Ip');
\define('_MA_MYMODULE_TESTFIELD_READS', 'Reads');
\define('_MA_MYMODULE_INDEX_THEREARE', 'There are %s Testfields');
\define('_MA_MYMODULE_INDEX_LATEST_LIST', 'Last My Module');
// Submit
\define('_MA_MYMODULE_SUBMIT', 'Submit');
// Form
\define('_MA_MYMODULE_FORM_OK', 'Successfully saved');
\define('_MA_MYMODULE_FORM_DELETE_OK', 'Successfully deleted');
\define('_MA_MYMODULE_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_MA_MYMODULE_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
\define('_MA_MYMODULE_FORM_SURE_BROKEN', "Are you sure to notify as broken: <b><span style='color : Red;'>%s </span></b>");
\define('_MA_MYMODULE_INVALID_PARAM', 'Invalid parameter');
// ---------------- Ratings ----------------
\define('_MA_MYMODULE_RATING_CURRENT_1', 'Rating: %c / %m (%t rating totally)');
\define('_MA_MYMODULE_RATING_CURRENT_X', 'Rating: %c / %m (%t ratings totally)');
\define('_MA_MYMODULE_RATING_CURRENT_SHORT_1', '%c (%t rating)');
\define('_MA_MYMODULE_RATING_CURRENT_SHORT_X', '%c (%t ratings)');
\define('_MA_MYMODULE_RATING1', '1 of 5');
\define('_MA_MYMODULE_RATING2', '2 of 5');
\define('_MA_MYMODULE_RATING3', '3 of 5');
\define('_MA_MYMODULE_RATING4', '4 of 5');
\define('_MA_MYMODULE_RATING5', '5 of 5');
\define('_MA_MYMODULE_RATING_10_1', '1 of 10');
\define('_MA_MYMODULE_RATING_10_2', '2 of 10');
\define('_MA_MYMODULE_RATING_10_3', '3 of 10');
\define('_MA_MYMODULE_RATING_10_4', '4 of 10');
\define('_MA_MYMODULE_RATING_10_5', '5 of 10');
\define('_MA_MYMODULE_RATING_10_6', '6 of 10');
\define('_MA_MYMODULE_RATING_10_7', '7 of 10');
\define('_MA_MYMODULE_RATING_10_8', '8 of 10');
\define('_MA_MYMODULE_RATING_10_9', '9 of 10');
\define('_MA_MYMODULE_RATING_10_10', '10 of 10');
\define('_MA_MYMODULE_RATING_VOTE_BAD', 'Invalid vote');
\define('_MA_MYMODULE_RATING_VOTE_ALREADY', 'You have already voted');
\define('_MA_MYMODULE_RATING_VOTE_THANKS', 'Thank you for rating');
\define('_MA_MYMODULE_RATING_NOPERM', "Sorry, you don't have permission to rate items");
\define('_MA_MYMODULE_RATING_LIKE', 'Like');
\define('_MA_MYMODULE_RATING_DISLIKE', 'Dislike');
\define('_MA_MYMODULE_RATING_ERROR1', 'Error: update base table failed!');
// ---------------- Print ----------------
\define('_MA_MYMODULE_PRINT', 'Print');
// Admin link
\define('_MA_MYMODULE_ADMIN', 'Admin');
// ---------------- End ----------------
