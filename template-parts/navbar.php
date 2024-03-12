<?php
$logo_hlavicka  = get_field('logo', 'option');
?>
<div class="bg-white shadow-sm">
    <div class="container px-8">
        <div class="flex flex-row items-center justify-between gap-x-8">
            <div class="relative">
                <a class="h-12 relative block" href="<?php echo get_home_url() ?>">
                    <?php if ($logo_hlavicka) : ?>
                        <img src="<?php echo esc_url($logo_hlavicka['url']); ?>" alt="<?php echo esc_attr($logo_hlavicka['alt']); ?>" class="object-contain w-full h-full" loading="lazy" />
                    <?php endif; ?>
                </a>
            </div>
            <div class="h-full flex flex-row justify-center rounded-sm">
                <div class="mobile-menu_toggler py-4">
                    <button class="navbar-toggler md:hidden block w-5 h-4 relative mx-2 my-2" data-menu="mobile-menu" type="button">
                        <span class="transition-all w-full h-0.5 absolute bg-black right-0 top-0"></span>
                        <span class="transition-all w-3 h-0.5 absolute bg-black right-0 top-1/2 -translate-y-1/2"></span>
                        <span class="transition-all w-full h-0.5 absolute bg-black right-0 bottom-0"></span>
                    </button>
                </div>
                <nav class="desktop-menu hidden md:block">
                    <?php wp_nav_menu(array(
                        'menu'              => 'Primary',
                        'container'         => "",
                        'menu_class'        => 'navbar-nav',
                        'depth'             => 2,
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="md:hidden">
    <nav class="mobile-menu" id="mobile-menu">
        <?php wp_nav_menu(array(
            'menu'              => 'Primary',
            'container'         => "",
            'menu_class'        => 'navbar-nav',
            'depth'             => 2,
        ));
        ?>
    </nav>
</div>

