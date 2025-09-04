<?php
$id = '' . $block['id'];
$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$title = (function_exists('get_field') && $title = get_field('title')) ? $title : '';

$sub_title = (function_exists('get_field') && $sub_title = get_field('sub_title')) ? $sub_title : '';

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
<section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
    <div class="essence-block container  pb-[60px] sm:pb-20 md:pb-[136px]">
        <?php if ($title): ?>
        <div class="text-center mb-6 md:mb-10">
            <h3 class="leading-[1.2] ">
                <?php echo $title; ?>
            </h3>
            <p class=" sm:text-xl text-n-400 leading-normal">
                <?php echo $sub_title; ?>
            </p>
        </div>
        <?php endif; ?>
        <div class="grid sm:grid-cols-2  md:grid-cols-3 gap-6 essence__card">

            <?php

                // Check rows exists.
                if (have_rows('content_with_icons_repeater')):

                    // Loop through rows.
                    while (have_rows('content_with_icons_repeater')):
                        the_row();

                        // Load sub field value.
                        $icons = get_sub_field('icons');
                        $heading = get_sub_field('heading');
                        $sub_heading = get_sub_field('sub_heading');
                        $background_image = get_sub_field('background_image');

                        // Do something...
                        ?>
            <div class="essence__card--items bg-n-50  flex flex-col justify-center relative">
                <?php if ($background_image): ?>
                <div class=" essence__image--block aspect-square">
                    <img loading="lazy" src="<?php echo $background_image; ?>"
                        class="absolute w-full h-full inset-0 object-cover ">
                </div>
                <?php endif; ?>
                <div class="items-wrapper p-6 sm:p-8 ">
                    <?php if ($icons): ?>
                    <div class="relative mb-2">
                        <img loading="lazy" src="<?php echo $icons; ?>">
                    </div>
                    <?php endif; ?>
                    <h4 class="mb-2 uppercase leading-normal card-title ">
                        <?php echo $heading; ?>
                    </h4>
                    <p class="text-sm sm:text-base text-n-400 card-paragraph">
                        <?php echo $sub_heading; ?>
                    </p>
                </div>

            </div>
            <?php


                        // End loop.
                    endwhile;

                    // No value.
                else:
                    // Do something...
                endif; ?>
        </div>
    </div>
</section>
<?php
endif; ?>