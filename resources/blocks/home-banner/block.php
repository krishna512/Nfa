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
$images = (function_exists('get_field') && $image = get_field('image')) ? $image : '';
// var_dump($images);
$button_text = (function_exists('get_field') && $button_text = get_field('button_text')) ? $button_text : '';

$button_url = (function_exists('get_field') && $button_url = get_field('button_url')) ? $button_url : '';
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';
$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';

global $svgIcon;

?>
<div id="hero-banner"
    class="<?php echo esc_attr($className); ?> hero__banner relative  min-h-[480px]  md:min-h-screen overflow-hidden flex">


    <?php if ($showhide): ?>
        <div class="hero__banner--image">
            <?php if ($images): ?> <img loading="lazy" class="absolute inset-0 w-full h-full object-cover"
                    src="<?php echo $images; ?>">
            </div>

            <div class="photo-credit absolute bottom-3 right-3 text-white p-2 text-xs z-[40] font-medium italic opacity-70">
                <div class="flex items-center">
                    <span> &copy; </span>
                    <span>
                        <?php echo $photo_credit; ?>
                    </span>
                </div>
            </div>

        <?php endif; ?>

        <div class="hero__banner--content container relative z-10 m-auto pt-[90px] md:pt-[96px]">
            <div class="max-w-[677px]">
                <h1
                    class="text-white text-small-heading md:text-display-d1 font-bigShouldersDisplay  font-bold mb-2 md:mb-6">
                    <?php echo $title; ?>
                </h1>
                <p class="text-white mb-4 md:mb-8">
                    <?php echo $sub_title; ?>
                </p>

                <?php
                $options = [
                    'url' => $button_url,
                    'text' => $button_text,
                    'color' => 'white',
                    'wave' => 'wave-hover',
                ];


                echo btn_outline($options); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- <div
        class="hero-mask mix-blend-overlay hidden sm:block max-w-full md:w-[476px] h-[280px]  md:h-[450px]  lg:h-[552px]  absolute right-[-44px] md:right-[-120px] bottom-[-3%]">
        < ?php echo useSvg('hero-mask'); ?>
    </div> -->

</div>