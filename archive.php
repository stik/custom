<?php get_header(); ?>
    <div class="container mx-auto">
        <div class="my-12">
            <header class="page-header entry-content text-center mb-8">
                <h1 class="is-style-h1">
                    <?php
                    if(is_category()){
                        single_cat_title();
                    }else{
                        _e( 'Archive', 'custom' );
                    }
                    ?>
                </h1>
            </header>
            <?php if ( have_posts() ){ ?>
                <div class="flex flex-col gap-y-8">
                    <?php
                    while ( have_posts() ){
                        the_post();
                        get_template_part( 'template-parts/post-list');
                    }
                    ?>
                </div>
            <?php
                get_template_part( 'template-parts/pagination');
            }else{
                ?>
                <div class="text-center entry-content">
                    <div>
                        <p><?php _e( 'Sorry, no posts matched your criteria.', 'custom' ); ?></p>
                    </div>
                </div>
                <?php
            }
            ?>
		</div>
    </div>
<?php
get_footer();
