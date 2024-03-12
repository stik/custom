<article class="entry-content group">
    <div class="flex flex-row gap-x-8">
        <div class="flex-shrink-0">
            <a href="<?php the_permalink(); ?>">
                <div class="w-28 aspect-square relative rounded-lg overflow-hidden">
                    <?php if(get_the_post_thumbnail_url(get_the_ID(),'medium')){ ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>" alt="" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110" loading="lazy" />
                    <?php } ?>
                </div>
            </a>
        </div>
        <div>
            <a href="<?php the_permalink(); ?>">
                <h3 class="is-style-h3 !mb-2"><?php the_title(); ?></h3>
            </a>
            <div class="flex flex-row gap-x-2 p-sm text-gray-600">
                <time><?php _e('Published'); ?>: <?php echo get_the_date(); ?></time>
            </div>
            <div class="mb-4">
                <a href="<?php the_permalink(); ?>">
                <p><?php the_excerpt(); ?></p>
                </a>
            </div>
        </div>
    </div>
</article>
