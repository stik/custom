<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
?>
        <div class="container mx-auto">
            <div class="entry-content my-12">
                <h1 class="is-style-h1 mb-6"><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
<?php
    }
}

get_footer();
