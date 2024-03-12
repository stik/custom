<?php

$block_id = (isset($attr['id'])) ? $attr['id'] : 'team-member-detail';
$block_classes = (isset($attr['class'])) ? $attr['class'] : '';

//member info
$member = get_field('member');
if ($member) {
    $name = get_field('name', $member);
    $position = get_field('position', $member);
    $email = get_field('e-mail', $member);
    $phone_number = get_field('phone_number', $member);
    $profile_image = get_field('profile_image', $member);
    $description = get_field('description', $member);

    //show all posts where member is Reviewer
    $member_posts = [];
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 5,
        'meta_query'     => array(
            array(
                'key'     => 'reviewer',
                'value'   => $member,
                'compare' => '=',
            ),
        ),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ){
            $query->the_post();
            $post_title = get_the_title();
            $post_link = get_the_permalink();

            $member_posts[] = [
                'title' => $post_title,
                'link' => $post_link,
            ];
        }
        wp_reset_postdata();
    }

?>
    <section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($block_classes); ?> member-detail my-8">
        <div class="py-8 px-8 bg-gray-50 rounded-sm">
            <div class="flex flex-col sm:flex-row gap-8">
                <div>
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-200">
                        <?php if ($profile_image) { ?>
                            <img src="<?php echo esc_url($profile_image['sizes']['medium']); ?>" alt="<?php echo esc_attr($profile_image['alt']); ?>" loading="lazy" class="object-cover !h-full w-full" />
                        <?php } else { ?>
                            <div class="bg-gray-200 h-full w-full flex justify-center items-center text-7xl text-white">?</div>
                        <?php } ?>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <?php if ($name) { ?>
                        <h3 class="is-style-h2 !mb-2"><?php echo esc_html($name); ?></h3>
                    <?php } ?>
                    <?php if ($position) { ?>
                        <p class="is-style-h6 !mb-4">
                            <?php echo esc_html($position); ?>
                        </p>
                    <?php } ?>
                    <?php if ($email || $phone_number) { ?>
                        <div class="flex flex-col md:flex-row gap-4">
                            <?php if ($phone_number) { ?>
                                <div class="flex flex-row items-center">
                                    <img src="<?php echo get_template_directory_uri() . '/img/phone.svg'; ?>" alt="phone" class="w-4 h-4 mr-2" loading="lazy" />
                                    <a href="tel:<?php echo get_phone($phone_number); ?>" class="link"><?php echo esc_html($phone_number); ?></a>
                                </div>
                            <?php } ?>
                            <?php if ($email) { ?>
                                <div class="flex flex-row items-center">
                                    <img src="<?php echo get_template_directory_uri() . '/img/mail.svg'; ?>" alt="mail" class="w-4 h-4 mr-2" loading="lazy" />
                                    <a href="mailto:<?php echo esc_html($email); ?>" class="link"><?php echo esc_html($email); ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if ($description) { ?>
                <div class="mt-8"><?php echo $description; ?></div>
            <?php } ?>
            <?php if ($member_posts) { ?>
                <div class="mt-8">
                    <h2 class="is-style-h3 !mb-4"><?php _e('Recent Posts', 'argo'); ?></h2>
                    <ul>
                        <?php foreach($member_posts as $mp){ ?>
                            <li><a href="<?php echo esc_url($mp['link']); ?>"><?php echo esc_html($mp['title']); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
