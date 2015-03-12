<?php
/*
The Default Loop (used by index.php and category.php)
=====================================================

If you require only post excerpts to be shown in index and category pages, then use the [---more---] line within blog posts.

If you require different templates for different post types, then simply duplicate this template, save the copy as, e.g. "content-aside.php", and modify it the way you like it. (The function-call "get_post_format()" within index.php, category.php and single.php will redirect WordPress to use your custom content template.)

Alternatively, notice that index.php, category.php and single.php have a post_class() function-call that inserts different classes for different post types into the section tag (e.g. <section id="" class="format-aside">). Therefore you can simply use e.g. .format-aside {your styles} in css/bst.css style the different formats in different ways.
*/
?>

<?php if(have_posts()): while(have_posts()): the_post();?>
    <article role="article" id="post_<?php the_ID()?>">
        <header>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
            <h4>
              <em>
                <span class="author"><?php _e('By', 'fst'); echo " "; the_author() ?>,</span>
                <time datetime="<?php the_time('d-m-Y')?>"><?php the_time('jS F Y') ?></time>
              </em>
            </h4>
        </header>
        <section>
            <?php the_post_thumbnail(); ?>
            <?php the_content( __( '&hellip; ' . __('Continue reading', 'fst' ) . ' <big><i class="fi-arrow-right"></i></big>', 'fst' ) ); ?>
        </section>
        <footer>
            <p style="margin-bottom: 2rem;">
                <big><i class="fi-folder"></i></big>&nbsp; <?php _e('Category', 'fst'); ?>: <?php the_category(', ') ?><br/>
                <big><i class="fi-comment-quotes"></i></big>&nbsp; <?php _e('Comments', 'fst'); ?>: <?php comments_popup_link(__('None', 'fst'), '1', '%'); ?>
            </p>
        </footer>
    </article>
<?php endwhile; ?>

<?php if ( function_exists('fst_pagination') ) { fst_pagination(); } else if ( is_paged() ) { ?>
  <ul class="pagination">
    <li class="older"><?php next_posts_link('<i class="fi-arrow-left"></i> ' . __('Previous', 'fst')) ?></li>
    <li class="newer"><?php previous_posts_link(__('Next', 'fst') . ' <i class="fi-arrow-right"></i>') ?></li>
  </ul>
<?php } ?>

<?php else: wp_redirect(get_bloginfo('siteurl').'/404', 404); exit; endif; ?>
