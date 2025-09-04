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
    <section id="<?php echo $id; ?>"
        class="<?php echo esc_attr($className); ?> goals__middle--images h-full grid items-center  ">
        <div class="relative rounded-lg overflow-hidden grid items-center">
            <div class="relative pt-[70%] md:pt-[134%]">
                <img loading="lazy" src="<?php echo $background_image; ?>"
                    class="absolute w-full h-full inset-0 object-cover">
            </div>
            <div class="absolute bottom-0 right-0 grid justify-end z-10 ">
                <div class=" relative text-white text-center p-6 sm:p-10">
                    <h2 class="leading-[1.2] mb-2">
                        <?php echo $title; ?>
                    </h2>

                    <?php echo $sub_title; ?>


                </div>
            </div>
            <div class=" goals__overlay ">

            </div>
    </section>

<?php endif; ?>