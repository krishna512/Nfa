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
<section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
    <!-- mb-24 -->
    <div class="text-center mb-9 sm:mb-12">
        <h3 class="">
            <?php echo $title; ?>
        </h3>
        <p class="text-n-400 sm:text-xl leading-normal">
            <?php echo $sub_title; ?>
        </p>
    </div>

    <div class="relative overflow-hidden">
        <!-- <div class="relative pt-[47%]"> -->
        <img loading="lazy" src="<?php echo $background_image; ?>" class="absolute w-full h-full inset-0 object-cover">
        <!-- </div> -->
        <div class="advocacy-card-overlay absolute inset-0 h-full w-full "></div>
        <div class="relative overflow-hidden max-w-[1028px] container py-10">
            <!--  my-7  -->

            <div class="relative  overflow-hidden  grid md:flex max-md:flex-col items-center">
                <div class="md:basis-[35%]">
                    <div class="relative overflow-hidden pt-[100%] md:pt-[140%]">
                        <img loading="lazy" src="<?php echo $seap_image; ?>" class="absolute inset-0 h-full w-full">
                    </div>

                </div>
                <div class="relative md:basis-[65%] overflow-hidden rounded-r-lg">
                    <div class="absolute inset-0 bg-dark-grey opacity-60 mix-blend-multiply"> </div>
                    <div class=" p-6 sm:py-[46px] sm:px-8 text-white relative z-10 ">
                        <div class="text-2xl font-bold font-bigShouldersDisplay capitalize ">
                            <?php echo $content; ?>
                        </div>


                        <?php if ($button_url): ?>
                        <div class="mt-6">

                            <?php
                                    $options = [
                                        'url' => $button_url,
                                        //  $button_url,
                                        'text' => 'View Full Report',
                                        "icon" => '',
                                        'color' => 'white'
                                        // $button_text
                            
                                    ];
                                    echo btn_outline($options); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif;