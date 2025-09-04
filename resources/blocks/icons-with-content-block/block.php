<?php
$id = '' . $block['id'];
$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>

<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> our-goal-wrapper">
        <div>
            <div class="grid  gap-6 our-goal__card">

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
                        <div class="our-goal__card--items bg-n-50 relative  overflow-hidden group rounded-lg ">
                            <?php if ($background_image): ?>
                                <div class="our-goal__image">
                                    <img loading="lazy" src="<?php echo $background_image; ?>"
                                        class="absolute transition-all duration-[0.4s] ease-linear  w-full h-full inset-0 object-cover opacity-0 group-hover:opacity-100">
                                </div>
                            <?php endif; ?>
                            <div
                                class="items-wrapper relative z-10 text-center py-6 sm:py-12 px-4 sm:px-10 flex flex-col justify-center items-center  ">
                                <?php if ($icons): ?>
                                    <div class="relative mb-8">
                                        <img loading="lazy" src="<?php echo $icons; ?>">
                                    </div>
                                <?php endif; ?>
                                <h4 class="group-hover:text-white duration-[0.4s] ease-linear  mb-2 leading-normal card-title ">
                                    <?php echo $heading; ?>
                                </h4>
                                <p class="text-n-400 card-paragraph duration-[.4s] group-hover:text-white ease-linear">
                                    <?php echo $sub_heading; ?>
                                </p>
                            </div>


                            <!-- <div
                                class="goal-wave absolute h-full w-full left-0 right-0 top-[88%] translate-y-0 group-hover:-translate-y-full z-50">
                                < ?php echo useSvg('our-goals-hover'); ?>
                            </div> -->

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