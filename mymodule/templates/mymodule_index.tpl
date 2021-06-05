<{include file='db:mymodule_header.tpl' }>

<!-- Start index list -->
<table>
	<thead>
		<tr class='center'>
			<th><{$smarty.const._MA_MYMODULE_TITLE}>  -  <{$smarty.const._MA_MYMODULE_DESC}></th>
		</tr>
	</thead>
	<tbody>
		<tr class='center'>
			<td class='bold pad5'>
				<ul class='menu text-center'>
					<li><a href='<{$mymodule_url}>'><{$smarty.const._MA_MYMODULE_INDEX}></a></li>
					<li><a href='<{$mymodule_url}>/articles.php'><{$smarty.const._MA_MYMODULE_ARTICLES}></a></li>
					<li><a href='<{$mymodule_url}>/testfields.php'><{$smarty.const._MA_MYMODULE_TESTFIELDS}></a></li>
				</ul>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr class='center'>
			<td class='bold pad5'>
				<{if $adv|default:''}><{$adv|default:false}><{/if}>
			</td>
		</tr>
	</tfoot>
</table>
<!-- End index list -->

<div class='mymodule-linetitle'><{$smarty.const._MA_MYMODULE_INDEX_LATEST_LIST}></div>
<{if $articlesCount|default:0 > 0}>
	<!-- Start show new articles in index -->
	<table class='table table-<{$table_type}>'>
					</tr><tr>
		<tr>
			<!-- Start new link loop -->
			<{foreach item=article from=$articles name=article}>
				<td class='col_width<{$numb_col}> top center'>
					<{include file='db:mymodule_articles_list.tpl' article=$article}>
				</td>
				<{if $smarty.foreach.article.iteration is div by $divideby}>
					</tr><tr>
				<{/if}>
			<{/foreach}>
			<!-- End new link loop -->
		</tr>
	</table>
<{/if}>
<div class='mymodule-linetitle'><{$smarty.const._MA_MYMODULE_INDEX_LATEST_LIST}></div>
<{if $testfieldsCount|default:0 > 0}>
	<!-- Start show new testfields in index -->
	<table class='table table-<{$table_type}>'>
					</tr><tr>
		<tr>
			<!-- Start new link loop -->
			<{foreach item=testfield from=$testfields name=testfield}>
				<td class='col_width<{$numb_col}> top center'>
					<{include file='db:mymodule_testfields_list.tpl' testfield=$testfield}>
				</td>
				<{if $smarty.foreach.testfield.iteration is div by $divideby}>
					</tr><tr>
				<{/if}>
			<{/foreach}>
			<!-- End new link loop -->
		</tr>
	</table>
<{/if}>
<{include file='db:mymodule_footer.tpl' }>
