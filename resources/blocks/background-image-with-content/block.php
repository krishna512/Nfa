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
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';
    
$title = (function_exists('get_field') && $title = get_field('title')) ? $title : '';

$sub_title = (function_exists('get_field') && $sub_title = get_field('sub_title')) ? $sub_title : '';

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> ">
        <div class="approach-container">
            <div class="relative rounded-lg overflow-hidden">


                <div class="relative <?php echo $title ? '' : 'pt-[41%]'; ?>">
                    <!--  pt-[41%]-->
                    <img loading="lazy" src="<?php echo $background_image; ?>"
                        class="absolute w-full h-full inset-0 object-cover">
                        <?php echo photo_credit_section($photo_credit); ?>

                    <?php if ($title): ?>
                        <div class="hand-on-approach relative bottom-0 right-0 grid justify-end sm:pt-20 md:pt-[144px]">
                            <div
                                class=" relative text-white max-w-full sm:max-w-[478px] bg-dark-grey opacity-90 py-8 px-6 sm:pt-10 sm:px-10 sm:pb-[70px] rounded-t-lg">
                                <h4 class="leading-[1.3] mb-3 max-w-[272px]">
                                    <?php echo $title; ?>
                                </h4>

                                <?php echo $sub_title; ?>


                                <div class="mask-value absolute right-0 h-full top-0 ">
                                    <?php echo useSvg('value-mask'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

<?php endif; ?>