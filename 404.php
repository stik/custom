<?php get_header(); ?>
<div class="container mx-auto">
    <div class="entry-content my-12">
        <h1 class="h1"><?php _e('Page not found'); ?></h1>
        <p><?php _e('Sorry, but the page you requested cannot be found.'); ?></p>
        <p><a href="<?php echo home_url(); ?>">&larr; <?php _e('Back to Home'); ?></a></p>
    </div>
</div>
<?php get_footer(); ?>
