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
$seap_image = (function_exists('get_field') && $seap_image = get_field('seap_image')) ? $seap_image : '';
$button_url = (function_exists('get_field') && $button_url = get_field('button_url')) ? $button_url : '';

$background_image = (function_exists('get_field') && $background_image = get_field('background_image')) ? $background_image : '';

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> container py-[60px] sm:py-24">
        <div class="max-w-[1016px] mx-auto">
            <div class="sm:flex grid items-center">
                <div class="basis-[40%] relative overflow-hidden border-[5px] border-n-100">
                    <div class=" pt-[140%]">

                        <img loading="lazy" src="<?php echo $seap_image; ?>"
                            class="absolute h-full w-full inset-0 object-cover">
                    </div>
                </div>
                <div class="basis-[60%]">
                    <div class="relative overflow-hidden rounded-e-lg">
                        <div>
                            <img loading="lazy" src="<?php echo $background_image; ?>"
                                class="absolute w-full h-full inset-0 object-cover">
                        </div>

                        <div class=" bg-dark-grey opacity-60 absolute inset-0 h-full w-full "></div>
                        <div class=" relative text-white py-10 md:py-[60px] px-6 md:pl-[30px] md:pr-[62px]">
                            <h4 class="uppercase leading-[1.3] mb-3">
                                <?php echo $title; ?>
                            </h4>

                            <?php echo $sub_title; ?>

                            <?php if ($button_url): ?>
                                <div class="mt-6">

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
                    </div>

                </div>

            </div>
        </div>
    </section>

<?php endif;