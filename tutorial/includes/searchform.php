<?php
/**
 * Includes of WFWD WordPress Theme
 *
 * @package   WFWD
 * @version   1.0.9
 * @date      2016.06.17
 * @author    WangFan <wf_cmp_word@126.com>
 * @site      WangFan <www.upfreda.com>
 * @copyright Copyright (c) 2014, Zhiyan
 * @license   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link      http://www.zhiyanblog.com/tinection.html
**/
?>
<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
    <div class="search-input-wrap">
        <input class="search-input" type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" size="15" />
    </div>
</form>