<small>
    <{if $rating_5stars}>
        <div class="mymodule_ratingblock">
            <div id="unit_long<{$item.id}>">
                <div id="unit_ul<{$item.id}>" class="mymodule_unit-rating">
                    <div class="mymodule_current-rating" style="width:<{$item.rating.size}>;"><{$item.rating.text}></div>
                    <div>
                        <a class="mymodule_r1-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING1}>" rel="nofollow">1</a>
                    </div>
                    <div>
                        <a class="mymodule_r2-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=2&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING2}>" rel="nofollow">2</a>
                    </div>
                    <div>
                        <a class="mymodule_r3-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=3&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING3}>" rel="nofollow">3</a>
                    </div>
                    <div>
                        <a class="mymodule_r4-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=4&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING4}>" rel="nofollow">4</a>
                    </div>
                    <div>
                        <a class="mymodule_r5-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=5&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING5}>" rel="nofollow">5</a>
                    </div>
                </div>
                <div>
                    <{$item.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
    <{if $rating_10stars}>
        <div class="mymodule_ratingblock">
            <div id="unit_long<{$item.id}>">
                <div id="unit_ul<{$item.id}>" class="mymodule_unit-rating-10">
                    <div class="mymodule_current-rating" style="width:<{$item.rating.size}>;"><{$item.rating.text}></div>
                    <div>
                        <a class="mymodule_r1-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_1}>" rel="nofollow">1</a>
                    </div>
                    <div>
                        <a class="mymodule_r2-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=2&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_2}>" rel="nofollow">2</a>
                    </div>
                    <div>
                        <a class="mymodule_r3-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=3&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_3}>" rel="nofollow">3</a>
                    </div>
                    <div>
                        <a class="mymodule_r4-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=4&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_4}>" rel="nofollow">4</a>
                    </div>
                    <div>
                        <a class="mymodule_r5-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=5&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_5}>" rel="nofollow">5</a>
                    </div>
                    <div>
                        <a class="mymodule_r6-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=6&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_6}>" rel="nofollow">6</a>
                    </div>
                    <div>
                        <a class="mymodule_r7-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=7&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_7}>" rel="nofollow">7</a>
                    </div>
                    <div>
                        <a class="mymodule_r8-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=8&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_8}>" rel="nofollow">8</a>
                    </div>
                    <div>
                        <a class="mymodule_r9-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=9&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_9}>" rel="nofollow">9</a>
                    </div>
                    <div>
                        <a class="mymodule_r10-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=10&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_10_10}>" rel="nofollow">10</a>
                    </div>
                </div>
                <div>
                    <{$item.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
<{if $rating_10num}>
        <div class="mymodule_ratingblock">
            <div id="unit_long<{$item.id}>">
                <div id="unit_ul<{$item.id}>" class="mymodule_unit-rating-10numeric">
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=1}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=1&amp;source=1" rel="nofollow">1</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=2}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=2&amp;source=1" rel="nofollow">2</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=3}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=3&amp;source=1" rel="nofollow">3</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=4}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=4&amp;source=1" rel="nofollow">4</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=5}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=5&amp;source=1" rel="nofollow">5</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=6}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=6&amp;source=1" rel="nofollow">6</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=7}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=7&amp;source=1" rel="nofollow">7</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=8}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=8&amp;source=1" rel="nofollow">8</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=9}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=9&amp;source=1" rel="nofollow">9</a>
                    <a class="mymodule-rater-numeric <{if $item.rating.avg_rate_value >=10}>mymodule-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=10&amp;source=1" rel="nofollow">10</a>
                </div>
                <div class='left'>
                    <{$item.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
    <{if $rating_likes}>
        <div class="mymodule_ratingblock">
            <a class="mymodule-rate-like" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_LIKE}>" rel="nofollow">
                <img class='mymodule-btn-icon' src='<{$mymodule_icon_url_16}>/like.png' alt='<{$smarty.const._MA_MYMODULE_RATING_LIKE}>' title='<{$smarty.const._MA_MYMODULE_RATING_LIKE}>'>(<{$item.rating.likes}>)</a>

            <a class="mymodule-rate-dislike" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=-1&amp;source=1" title="<{$smarty.const._MA_MYMODULE_RATING_DISLIKE}>" rel="nofollow">
                <img class='mymodule-btn-icon' src='<{$mymodule_icon_url_16}>/dislike.png' alt='<{$smarty.const._MA_MYMODULE_RATING_DISLIKE}>' title='<{$smarty.const._MA_MYMODULE_RATING_DISLIKE}>'> (<{$item.rating.dislikes}>)</a>
        </div>
    <{/if}>
</small>