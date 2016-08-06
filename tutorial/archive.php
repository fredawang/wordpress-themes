<?php
/**
 * Archive Template of WFWD WordPress Theme
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
<?php 
    if(is_category(array("news","hotcomments","random","hotnews"))){
        get_template_part('/includes/category/first' );
        //include(TEMPLATEPATH . '/includes/category/first.php');
    } else{
        include(TEMPLATEPATH . '/index.php');
    }
?>
