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

$sub_title = (function_exists('get_field') && $sub_title = get_field('sub_title')) ? $sub_title : '';

$button_url = (function_exists('get_field') && $button_url = get_field('button_url')) ? $button_url : '';


$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>

<!-- <?php if ($showhide): ?> -->

    <section class="<?php echo esc_attr($className); ?>">
        <div class=" stateless-block container relative z-10  pb-[30px] sm:pb-10 md:pb-[74px]">
            <!-- mb-[60px] sm:mb-20 md:mb-[148px] -->
            <div
                class="relative overflow-hidden rounded-2xl py-10  sm:py-16 px-5 sm:px-10 md:pl-[105px] md:pr-16 mt-[-68px] sm:mt-[-108px]">
                <img src="<?php echo $background_image; ?>" class="absolute w-full h-full inset-0 object-cover">
                <div class=" relative max-w-[600px] stateless-block-content">
                    <div class="title">
                        <h2 class=" font-bigShouldersDisplay font-bold mb-3">
                            <?php echo $title; ?>
                        </h2>
                    </div>
                    <p class=" text-sm sm:text-xl text-n-500 mb-6">
                        <?php echo $sub_title; ?>
                    </p>

                    <div class="button">
                        <?php
                        $options = [
                            'url' => $button_url,
                            'text' => "Discover More",
                            'color' => 'yellow'
                        ];
                        echo btn_outline($options); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <?php endif; ?> -->