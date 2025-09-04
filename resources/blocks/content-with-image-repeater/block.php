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
<section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> our-principles custom-card ">
    <div class="container  custom-card-wrapper">
        <?php if ($title): ?>
        <div class="text-center mb-6 sm:mb-[60px]">
            <h3 class="">
                <?php echo $title; ?>
            </h3>
            <p class="text-n-400  sm:text-xl leading-normal">
                <?php echo $sub_title; ?>
            </p>
        </div>

        <?php endif ?>


        <div class="grid gap-y-12 card__content-wrapper">

            <?php

                // Check rows exists.
                if (have_rows('content_with_image_repeater')):

                    // Loop through rows.
                    while (have_rows('content_with_image_repeater')):
                        the_row();

                        // Load sub field value.
            
                        $heading = get_sub_field('heading');
                        $sub_heading = get_sub_field('sub_heading');
                        $image = get_sub_field('image');
                        $photo_credit = get_sub_field('photo_credit');
                        // var_dump($photo_credit);
    

                        // Do something...
                        ?>
            <div class="grid gap-4 sm:gap-6 md:grid-cols-2 card__content-items ">
                <?php if ($image): ?>
                
                <div class="relative pt-[52%] overflow-hidden rounded-lg card-items-images ">
                    <img loading="lazy" src="<?php echo $image; ?>" class="absolute w-full h-full inset-0 object-cover">
                    
                    <?php echo photo_credit_section($photo_credit); ?>
                </div>
                <?php endif; ?>
                <div class="flex flex-col justify-center card__content-items-wrapper">

                    <h4 class="sm:mb-3">
                        <?php echo $heading; ?>
                    </h4>
                    <p class="text-n-400">
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
                endif;
                ?>
        </div>
    </div>
</section>
<?php
endif; ?>