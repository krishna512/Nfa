<?php

$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$id = get_the_ID();
$posttype = get_post_type();
$permalink = get_the_permalink();
$title = get_the_title();
$content = get_the_content();

// echo $posttype;
/**
 * ===================
 * Banner Image
 * ===================
 */
$bannerImageID = (has_post_thumbnail()) ? get_post_thumbnail_id() : '';

if (!$bannerImageID) {
    // get archive image as default
    $pageIdentify = $posttype . '_options';
    $bannerImageID = (function_exists('get_field') && $background_image = get_field('background_image', $pageIdentify)) ? $background_image : '';
}
$published_date = get_the_date('d M, Y');


$deadline = get_field('deadline');
$today_date = date('d M, Y');
$vacancy_status = (strtotime($today_date) < strtotime($deadline)) ? true : false;
$deadline = date_format(date_create($deadline), "d M, Y");

$upload_file = get_field('upload_file');
$sub_heading = get_field('sub_heading');
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit', $pageIdentify)) ? $photo_credit : '';


// if ($posttype == 'vacancy') {
//     $Apply_url = get_field('vacancy_button_url', "option") . '?title=' . $title . '&id=' . $id;

// }
// // var_dump($term_category);
// if ($posttype == 'consultancy') {
//     $Apply_url = get_field('google_form_link');
// }

?>
<section class="<?php echo $posttype ?>">
    <!-- < ?php echo singleHeroContent($bannerImageID); ?> -->
    <!-- Hero section -->

    <div id="hero-banner"
        class=" hero__banner relative flex min-h-[430px] pt-20 pb-8 md:pt-32 md:pb-20 overflow-hidden hero-content">
        <?php if ($bannerImageID) {
            echo wp_get_attachment_image($bannerImageID, "full", false, array("class" => "absolute inset-0 w-full h-full object-cover"));
        }

        echo photo_credit_section($photo_credit);
        ?>

        <div class="container relative z-10 mt-auto hero__banner--content">
            <div class="text-white">
                <div class=" grid gap-4 relative z-10 max-w-xl">
                    <h1 class=" font-bigShouldersDisplay font-bold">
                        <!-- < ?php echo $title; ?> -->
                        WORK WITH US
                    </h1>
                    <?php if ($sub_heading) { ?>
                        <p class=" text-xl md:pr-7">
                            <?php echo $sub_heading; ?>
                        </p>
                    <?php } ?>


                    <p>
                        <a href="/opportunity-cate/vacancy/" class="flex gap-2 items-center">
                            <span class="text-base">
                                <?php echo useSvg('left-arrow'); ?>
                            </span>
                            Back to vacancy
                        </a>
                    </p>



                </div>

            </div>

        </div>

    </div>

    <!-- Hero section end -->


    <div class="<?php echo $posttype; ?> container pt-[60px] pb-[60px] sm:pb-20 md:pb-24 ">
        <div class="<?php echo $posttype . '-' . $id ?>  opportunity-single">


            <div class="max-w-[607px] mx-auto">
                <div class="opportunity-details grid gap-8 sm:gap-12 divide-y divide-grey93">

                    <div class="opportunity-single-content">

                        <h4 class="text-2xl mb-3 sm:mb-5">

                            <?php echo $title; ?>

                        </h4>

                        <div class="flex gap-2 sm:gap-4 flex-wrap">

                            <div class="flex gap-2">
                                <div class="font-medium">Post Date:</div>
                                <div class="text-n-400">
                                    <?php echo $published_date; ?>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <div class="font-medium">Deadline:

                                </div>
                                <div class="text-n-400">
                                    <?php echo $deadline; ?>
                                </div>
                            </div>
                        </div>


                        <div class="text-n-400 vacancy-paragraph">
                            <!-- < ?php gutenbergEditorContent(); ?> -->
                            <?php echo $content; ?>
                        </div>


                        <?php if ($upload_file) { ?>
                            <div class=" mt-6 sm:mt-8">

                                <?php
                                $options = [
                                    'url' => $upload_file,
                                    'text' => 'View Description',
                                    // 'icon' => '',
                            
                                ];
                                echo btn_primary($options); ?>


                            </div>

                        <?php } ?>

                    </div>


                    <div class="share-link-btn pt-8 sm:pt-12">
                        <div class="font-medium text-sm grid gap-3">
                            <?php echo __('Share this', 'nfa'); ?>
                            <?php echo $posttype; ?>

                            <?php echo yi_social_share(); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <!-- TEst end -->
    </div>

</section>