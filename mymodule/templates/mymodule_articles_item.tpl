<i id='artId_<{$article.art_id}>'></i>
<div class='panel-heading'>
	<h3 class='panel-title'><{$article.cat}></h3>
	<h3 class='panel-title'><{$article.title}></h3>
</div>
<div class='panel-body'>
	<span class='col-sm-9 justify'><{$article.descr}></span>
	<span class='col-sm-3'><img src='<{$mymodule_upload_url|default:false}>/images/articles/<{$article.img}>' alt='articles' /></span>
</div>
<div class='panel-foot'>
	<span class='block-pie justify'><{$smarty.const._MA_MYMODULE_ARTICLE_FILE}>: <{$article.file}></span>
	<span class='block-pie justify'><{$smarty.const._MA_MYMODULE_ARTICLE_CREATED}>: <{$article.created}></span>
	<span class='block-pie justify'><{$smarty.const._MA_MYMODULE_ARTICLE_SUBMITTER}>: <{$article.submitter}></span>
	<div class='col-sm-12 right'>
		<{if $showItem|default:''}>
			<a class='btn btn-success right' href='articles.php?op=list&amp;#artId_<{$article.art_id}>' title='<{$smarty.const._MA_MYMODULE_ARTICLES_LIST}>'><{$smarty.const._MA_MYMODULE_ARTICLES_LIST}></a>
		<{else}>
			<a class='btn btn-success right' href='articles.php?op=show&amp;art_id=<{$article.art_id}>' title='<{$smarty.const._MA_MYMODULE_DETAILS}>'><{$smarty.const._MA_MYMODULE_DETAILS}></a>
		<{/if}>
		<{if $permEdit|default:''}>
			<a class='btn btn-primary right' href='articles.php?op=edit&amp;art_id=<{$article.art_id}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
			<a class='btn btn-danger right' href='articles.php?op=delete&amp;art_id=<{$article.art_id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
		<{/if}>
		<a class='btn btn-warning right' href='articles.php?op=broken&amp;art_id=<{$article.art_id}>' title='<{$smarty.const._MA_MYMODULE_BROKEN}>'><{$smarty.const._MA_MYMODULE_BROKEN}></a>
	</div>
</div>
<{if $rating|default:''}>
	<{include file='db:mymodule_rate.tpl' item=$article}>
<{/if}>
