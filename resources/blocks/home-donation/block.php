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
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section class=" <?php echo esc_attr($className); ?> ">
        <div class="make-donation relative overflow-hidden">

            <img loading="lazy" src="<?php echo $background_image; ?>" class="absolute w-full inset-0 h-full object-cover">

            <?php echo photo_credit_section($photo_credit); ?>
            <div class=" grid md:grid-cols-2 relative z-10 container  pt-[78px] pb-10 sm:pb-14 text-white">

                <div class="md:col-start-2 md:max-w-[589px]">
                    <div class="mb-4 sm:mb-6 make-donation-content">
                        <h1 class="max-sm:text-small-heading-2 max-sm:leading-[1.3] font-bold mb-3 ">
                            <?php echo $title; ?>
                        </h1>
                        <p class="sm:text-xl">
                            <?php echo $sub_title; ?>
                        </p>
                    </div>
                    <div class="make-donation-btn">
                        <?php
                        $options = [
                            'url' => $button_url,
                            'text' => 'Make a Donation',
                            'icon' => '',

                        ];
                        echo btn_primary($options); ?>
                    </div>


                </div>
            </div>
        </div>
    </section>

<?php endif; ?>