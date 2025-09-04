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

$content = (function_exists('get_field') && $content = get_field('content')) ? $content : '';
$seap_image = (function_exists('get_field') && $seap_image = get_field('seap_image')) ? $seap_image : '';
$button_url = (function_exists('get_field') && $button_url = get_field('button_url')) ? $button_url : '';

$background_image = (function_exists('get_field') && $background_image = get_field('background_image')) ? $background_image : '';

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> pt-5 ">
        <div class="container max-w-[1028px]">
            <div class="relative overflow-hidden mb-[60px] rounded-lg">


                <!-- <div class="relative pt-[47%]"> -->
                <img loading="lazy" src="<?php echo $background_image; ?>"
                    class="absolute w-full h-full inset-0 object-cover">
                <!-- </div> -->
                <div class="seap-card-overlay absolute inset-0 h-full w-full "></div>
                <div class="relative overflow-hidden py-8  sm:py-16 px-6 sm:px-8">


                    <div class="relative seap overflow-hidden  grid md:flex max-md:flex-col items-center gap-5 py-8 px-6">
                        <div class="seap-overlay absolute inset-0 bg-dark-grey opacity-60"> </div>
                        <div class="md:basis-[35%]">
                            <div class="relative overflow-hidden pt-[100%] md:pt-[140%]">
                                <img loading="lazy" src="<?php echo $seap_image; ?>" class="absolute inset-0 h-full w-full">
                            </div>

                        </div>
                        <div class=" relative text-white md:basis-[65%]">

                            <div class="seap-content-text">
                                <?php echo $content; ?>
                            </div>

                            <?php if ($button_url): ?>
                                <div class="mt-5">

                                    <?php
                                    $options = [
                                        'url' => $button_url,
                                        //  $button_url,
                                        'text' => 'Visit SEAP',
                                        // $button_text
                            
                                    ];
                                    echo btn_primary($options); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class=" mask value-mask absolute right-0  bottom-0 h-full">
                            <?php echo useSvg('work-mask'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif;