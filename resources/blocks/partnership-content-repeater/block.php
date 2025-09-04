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
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> incubation-services small-container">

        <div class="divide-y divide-grey93 grid gap-8 sm:gap-10">
            <?php
            // Check rows exists.
            if (have_rows('partnership_content_repeater')):

                // Loop through rows.
                while (have_rows('partnership_content_repeater')):
                    the_row();

                    // Load sub field value.
        
                    $number = get_sub_field('number');
                    $title = get_sub_field('title');
                    $image = get_sub_field('image');
                    $content = get_sub_field('content');

                    // Do something...
                    ?>
                    <div class="grid sm:grid-cols-6 gap-6 service-card ">

                        <div class="sm:col-span-2">
                            <div class=" relative pt-[97%] sm:pt-[118%] overflow-hidden rounded-lg ">
                                <img src="<?php echo $image; ?>" class="absolute h-full w-full inset-0 object-cover">


                                <div class="absolute bottom-5 px-5 z-10">
                                    <h4 class="text-primary-yellow">
                                        <?php echo $number; ?>
                                    </h4>
                                    <h4 class="text-white">
                                        <?php echo $title; ?>
                                    </h4>
                                </div>

                                <div class="services-overlay absolute inset-0 w-full h-full "> </div>

                                <div class="value-mask mask absolute right-0 bottom-0 top-0">
                                    <?php echo useSvg('value-mask'); ?>
                                </div>

                            </div>
                        </div>



                        <div class="sm:col-span-4 text-n-400">
                            <?php echo $content; ?>
                        </div>
                    </div>

                    <?php
                    // End loop.
                endwhile;
            endif;
            ?>
        </div>
    </section>

<?php endif;