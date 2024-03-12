<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();

        $thumb_link   = '';
        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
        if ($thumbnail_id) {
            $image_url = wp_get_attachment_image_src($thumbnail_id, 'full');
            if ($image_url) {
                $thumb_link = $image_url[0];
            }
        }
        ?>
        <div>
            <div class="relative h-64 md:h-96 w-full text-center flex justify-center items-center">
                <div class="absolute inset-0 w-full h-full">
                    <?php if($thumb_link){ ?>
                        <img src="<?php echo $thumb_link; ?>" alt="" class="object-cover w-full h-full" loading="lazy" />
                    <?php } ?>
                    <div class="absolute inset-0 w-full h-full bg-black opacity-50"></div>
                </div>
                <div class="container entry-content text-center text-white z-10 relative">
                    <h1 class="is-style-h1 !mb-2"><?php the_title(); ?></h1>
                    <time class="is-style-h5"><?php _e('Published'); ?>: <?php echo get_the_date(); ?></time>
                </div>
            </div>
        </div>
        <div class="container mx-auto">
            <div class="entry-content my-12">
                <?php the_content(); ?>
            </div>
        </div>
        <?php
    }
}

get_footer();
