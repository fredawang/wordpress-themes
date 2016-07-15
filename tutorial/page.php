
<div id="container">
    <?php if(have_posts()):?>
        <?php while(have_posts()):the_post();?>
            <div class="post" id="<?php the_ID();?>" title="<?php the_title();?>">
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                <div class="entry">
                    <?php the_content();?>
                    page.php
                    <?php link_pages('<p><strong>Pages:</strong>', '</p>', 'number'); ?>
                    <?php edit_post_link('Edit', '<p>', '</p>'); ?>
                </div>
                
            </div>
        <?php endwhile;?>
        
    <?php else: ?>
        <div class="post">
            <h2>没有文章</h2>
        </div>
    <?php endif;?>
</div>
