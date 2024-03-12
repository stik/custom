<?php

$block_id = (isset($attr['id'])) ? $attr['id'] : 'team-member-grid';
$block_classes = (isset($attr['class'])) ? $attr['class'] : '';

//grid
$block_grid = 'grid grid-cols-2 sm:gap-x-8 gap-y-8';

$number_of_columns = get_field('number_of_columns');
if ($number_of_columns == 2) $block_grid = 'grid grid-cols-1 sm:grid-cols-2 sm:gap-x-8 gap-y-8';
if ($number_of_columns == 3) $block_grid = 'grid grid-cols-1 sm:grid-cols-3 sm:gap-x-8 gap-y-8';
if ($number_of_columns == 4) $block_grid = 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 sm:gap-x-8 gap-y-8';

//members
$list_of_members = [];
if (have_rows('show_members')) {
    while (have_rows('show_members')) {
        the_row();
        $member = get_sub_field('member');
        $position = get_sub_field('display_position');

        if ($member) {
            $list_of_members[] = [
                'name' => get_field('name', $member),
                'position' => get_field('position', $member),
                'phone_number' => get_field('phone_number', $member),
                'profile_image' => get_field('profile_image', $member),
            ];
        }
    }
}

if (count($list_of_members) > 0) {
?>
    <section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($block_classes); ?>">
        <div class="<?php echo $block_grid; ?>">
            <?php foreach ($list_of_members as $lom) { ?>
                <div class="flex items-center flex-col col-span-1">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-200 mb-4">
                        <?php if ($lom['profile_image']) { ?>
                            <img src="<?php echo esc_url($lom['profile_image']['sizes']['medium']); ?>" alt="<?php echo esc_attr($lom['profile_image']['alt']); ?>" loading="lazy" class="object-cover !h-full w-full" />
                        <?php } else { ?>
                            <div class="bg-gray-200 h-full w-full"></div>
                        <?php } ?>
                    </div>
                    <h2 class="is-style-h3 !mb-2"><?php echo $lom['name']; ?></h2>
                    <?php if ($lom['position']) { ?>
                        <p class="is-style-h6 !mb-2">
                            <?php echo esc_html($lom['position']); ?>
                        </p>
                    <?php } ?>
                    <?php if ($lom['phone_number']) { ?>
                        <div class="flex flex-row items-center">
                            <img src="<?php echo get_template_directory_uri() . '/img/phone.svg'; ?>" alt="phone" class="w-4 h-4 mr-2" loading="lazy" />
                            <a href="tel:<?php echo get_phone($lom['phone_number']); ?>" class="link"><?php echo esc_html($lom['phone_number']); ?></a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
