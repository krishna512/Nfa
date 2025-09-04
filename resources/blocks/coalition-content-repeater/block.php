<?php
$id = '' . $block['id'];
$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}
$background_image = (function_exists('get_field') && $background_image = get_field('background_image')) ? $background_image : '';
$title = (function_exists('get_field') && $title = get_field('title')) ? $title : '';
$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>  coalition-image-section">
        <div class="relative overflow-hidden mb-[60px]">
            <img src="<?php echo $background_image; ?>" class="absolute h-full w-full object-cover inset-0">

            <div class="bg-dark-grey absolute h-full w-full inset-0 opacity-80 mix-blend-multiply"> </div>

            <div class="value-mask mask absolute h-full right-0 bottom-0 top-0 mix-blend-overlay">
                <?php echo useSvg('value-mask'); ?>
            </div>
            <div class="container">

                <div class="relative py-8 sm:pt-[76px] sm:pb-20 text-center max-w-[817px] mx-auto ">
                    <p class="max-w-[607px] mx-auto text-white text-center mb-6 sm:mb-9">
                        <?php echo $title; ?>
                    </p>


                    <div class="grid sm:grid-cols-3 gap-3 sm:gap-6 coalition-working-group ">
                        <?php
                        // Check rows exists.
                        if (have_rows('coalition_content_repeater')):

                            // Loop through rows.
                            while (have_rows('coalition_content_repeater')):
                                the_row();

                                // Load sub field value.
                    

                                $title = get_sub_field('title');

                                $sub_title = get_sub_field('sub_title');

                                // Do something...
                                ?>

                                <div class="coalition-group-card rounded-lg p-6 ">

                                    <h3>
                                        <?php echo $title; ?>
                                    </h3>
                                    <p class=" text-sm sm:text-lg text-center font-medium">
                                        <?php echo $sub_title; ?>
                                    </p>
                                </div>




                                <?php
                                // End loop.
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php endif;