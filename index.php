<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
?>
        <div class="container mx-auto">
            <div class="entry-content my-12">
                <?php the_content(); ?>
            </div>
        </div>
<?php
    }
}

get_footer();
