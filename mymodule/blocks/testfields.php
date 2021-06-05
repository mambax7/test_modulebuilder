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
function b_mymodule_testfields_show($options)
{
	include_once XOOPS_ROOT_PATH . '/modules/mymodule/class/testfields.php';
	$myts = MyTextSanitizer::getInstance();
	$GLOBALS['xoopsTpl']->assign('mymodule_upload_url', MYMODULE_UPLOAD_URL);
	$block       = [];
	$typeBlock   = $options[0];
	$limit       = $options[1];
	$lenghtTitle = $options[2];
	$helper      = Helper::getInstance();
	$testfieldsHandler = $helper->getHandler('Testfields');
	$crTestfields = new \CriteriaCompo();
	\array_shift($options);
	\array_shift($options);
	\array_shift($options);

	switch ($typeBlock) {
		case 'last':
		default:
			// For the block: testfields last
			$crTestfields->add(new \Criteria('tf_status', Constants::PERM_GLOBAL_VIEW, '>'));
			$crTestfields->setSort('tf_datetime');
			$crTestfields->setOrder('DESC');
			break;
		case 'new':
			// For the block: testfields new
			$crTestfields->add(new \Criteria('tf_status', Constants::PERM_GLOBAL_VIEW, '>'));
			// new since last week: 7 * 24 * 60 * 60 = 604800
			$crTestfields->add(new \Criteria('tf_datetime', time() - 604800, '>='));
			$crTestfields->add(new \Criteria('tf_datetime', time(), '<='));
			$crTestfields->setSort('tf_datetime');
			$crTestfields->setOrder('ASC');
			break;
		case 'hits':
			// For the block: testfields hits
			$crTestfields->add(new \Criteria('tf_status', Constants::PERM_GLOBAL_VIEW, '>'));
			$crTestfields->setSort('tf_hits');
			$crTestfields->setOrder('DESC');
			break;
		case 'top':
			// For the block: testfields top
			$crTestfields->add(new \Criteria('tf_status', Constants::PERM_GLOBAL_VIEW, '>'));
			$crTestfields->setSort('tf_top');
			$crTestfields->setOrder('ASC');
			break;
		case 'random':
			// For the block: testfields random
			$crTestfields->add(new \Criteria('tf_status', Constants::PERM_GLOBAL_VIEW, '>'));
			$crTestfields->setSort('RAND()');
			break;
	}

	$crTestfields->setLimit($limit);
	$testfieldsAll = $testfieldsHandler->getAll($crTestfields);
	unset($crTestfields);
	if (\count($testfieldsAll) > 0) {
		foreach (\array_keys($testfieldsAll) as $i) {
			$block[$i]['id'] = $testfieldsAll[$i]->getVar('tf_id');
			$block[$i]['text'] = $myts->htmlSpecialChars($testfieldsAll[$i]->getVar('tf_text'));
		}
	}

	return $block;

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_mymodule_testfields_edit($options)
{
	include_once XOOPS_ROOT_PATH . '/modules/mymodule/class/testfields.php';
	$helper = Helper::getInstance();
	$testfieldsHandler = $helper->getHandler('Testfields');
	$GLOBALS['xoopsTpl']->assign('mymodule_upload_url', MYMODULE_UPLOAD_URL);
	$form = _MB_MYMODULE_DISPLAY;
	$form .= "<input type='hidden' name='options[0]' value='".$options[0]."' />";
	$form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' />&nbsp;<br>";
	$form .= _MB_MYMODULE_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' /><br><br>";
	\array_shift($options);
	\array_shift($options);
	\array_shift($options);

	$crTestfields = new \CriteriaCompo();
	$crTestfields->add(new \Criteria('tf_id', 0, '!='));
	$crTestfields->setSort('tf_id');
	$crTestfields->setOrder('ASC');
	$testfieldsAll = $testfieldsHandler->getAll($crTestfields);
	unset($crTestfields);
	$form .= _MB_MYMODULE_TESTFIELDS_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
	$form .= "<option value='0' " . (\in_array(0, $options) == false ? '' : "selected='selected'") . '>' . _MB_MYMODULE_ALL_TESTFIELDS . '</option>';
	foreach (\array_keys($testfieldsAll) as $i) {
		$tf_id = $testfieldsAll[$i]->getVar('tf_id');
		$form .= "<option value='" . $tf_id . "' " . (\in_array($tf_id, $options) == false ? '' : "selected='selected'") . '>' . $testfieldsAll[$i]->getVar('tf_text') . '</option>';
	}
	$form .= '</select>';

	return $form;

}
