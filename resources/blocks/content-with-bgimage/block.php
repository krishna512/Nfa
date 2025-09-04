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

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
        <div class="container pb-[60px] sm:pb-20 md:pb-[138px]">
            <div class="relative overflow-hidden rounded-lg">
                <div class="card-overlay"> </div>

                <img loading="lazy" src="<?php echo $background_image; ?>"
                    class="absolute w-full h-full inset-0 object-cover ">

                <div
                    class="relative z-10 text-white text-center max-w-[706px] m-auto px-4 py-[60px] sm:pt-[89px] sm:pb-[100px]">
                    <h3 class="leading-[1.2] mb-1">
                        <?php echo $title; ?>
                    </h3>
                    <p class="sm:text-xl leading-normal">
                        <?php echo $sub_title; ?>
                    </p>
                </div>

                <!-- <div class="absolute h-full z-[6] top-0 right-0 mask-value">
                    < ?php echo useSvg('value-mask'); ?>
                </div> -->

            </div>
        </div>
    </section>

<?php endif; ?>