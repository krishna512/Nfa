<?php

$id = get_the_ID();
$posttype = get_post_type();
$permalink = get_the_permalink();
$title = get_the_title();

// $feature_img = get_the_post_thumbnail_url();
// get thumbnail image
// $bannerImageID = (has_post_thumbnail()) ? get_post_thumbnail_id() : '';
$bannerImageID = (function_exists('get_field') && $fearure_image = get_field('fearure_image')) ? $fearure_image : '';
if (!$bannerImageID) {
    // get archive image as default
    $pageIdentify = $posttype . '_options';
    $bannerImageID = (function_exists('get_field') && $background_image = get_field('background_image', $pageIdentify)) ? $background_image : '';
}
$published_date = get_the_date('d M, Y');

$sub_heading = get_field('sub_heading');
$event_published_date = get_field('event_published_date');
$event_published_date = ($event_published_date) ? date_format(date_create($event_published_date), "d M, Y") : '';

$event_end_date = get_field('event_end_date');
$end_date = ($event_end_date) ? date_format(date_create($event_end_date), "d M, Y") : '';

$event_location = get_field('event_location');
$feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
$title = get_the_title();

$additional_content = get_field('additional_content ');
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit', $pageIdentify)) ? $photo_credit : '';

?>
<section <?php echo $posttype ?>>
    <div id="hero-banner" class=" hero__banner relative flex min-h-[430px] pt-20 pb-8 md:pt-24 md:pb-20 overflow-hidden hero-content">
        <?php if ($bannerImageID) {
            echo wp_get_attachment_image($bannerImageID, "full", false, array("class" => "absolute inset-0 w-full h-full object-cover"));
        }

        echo photo_credit_section($photo_credit);
        ?>

        <div class="container relative z-10 mt-auto hero__banner--content">
            <div class="text-white">
                <div class=" grid gap-6 relative z-10 max-w-xl">
                    <div class="grid gap-6">
                        <h1 class=" font-bigShouldersDisplay font-bold">
                            <?php echo $title; ?>
                        </h1>

                        <div class="flex gap-3 flex-wrap">
                            <div class="flex items-center gap-2">
                                <?php if ($event_published_date) : ?>
                                    <span class="text-white text-xl">
                                        <?php echo useSvg('calender') ?>
                                    </span>
                                <?php endif; ?>
                                <div class="text-sm">
                                    <?php echo $event_published_date; ?>
                                    <?php if ($event_end_date) : ?>
                                        -
                                        <?php echo $event_end_date; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ($event_location) : ?>
                                <div class="flex items-center gap-2">
                                    <span class="text-white text-xl">
                                        <?php echo useSvg('location') ?>
                                    </span>
                                    <div class="text-sm ">
                                        <?php echo $event_location; ?>
                                    </div>

                                </div>

                            <?php endif; ?>
                        </div>
                    </div>

                    <p>
                        <a href="<?php echo get_post_type_archive_link('event') ?>" class="flex gap-2 items-center">
                            <span class="text-base">
                                <?php echo useSvg('left-arrow'); ?>
                            </span>
                            Back to Events
                        </a>
                    </p>

                </div>

            </div>
        </div>

    </div>

    <div class="container pt-[60px] pb-[60px] sm:pb-24">
        <div class="<?php echo $posttype; ?> event-single border-b border-grey93">

            <div class="max-w-[607px] m-auto pb-8 sm:pb-12">

                <div class="event-details mb-8 sm:mb-9">
                    <div>
                        <div class="event-images items-center">
                            <div class="relative pt-[54%] overflow-hidden rounded-lg">
                                <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>" class="absolute h-full w-full inset-0 object-cover">
                            </div>
                        </div>


                        <div class="text-n-400 paragraph wp-block-post-content entry-content">
                            <?php gutenbergEditorContent(); ?>
                        </div>

                    </div>


                </div>

                <div class="share-link-btn">
                    <div class="font-medium text-sm grid gap-3">
                        <?php echo __('Share this', 'nfa'); ?>
                        <?php echo $posttype; ?>

                        <?php echo yi_social_share(); ?>
                    </div>
                </div>


            </div>


            <div class="other-event border-t border-grey93 pt-9 sm:pt-12 grid gap-y-6 sm:gap-y-9">
                <?php
                $related_events = get_posts(
                    array(
                        'post_type' => 'event',
                        'post_status' => 'publish',
                        'posts_per_page' => 3,
                        'category__in' => wp_get_post_categories(get_the_ID()),
                        'order' => 'ASC',
                        'orderby' => 'ID',
                        'post__not_in' => array(get_the_ID()),
                    )
                );

                if ($related_events) { ?>
                    <h3 class="">OTHER EVENTS</h3>
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <?php foreach ($related_events as $post) {

                            setup_postdata($post); ?>

                            <?php echo eventCard($id); ?>

                        <?php } ?>
                    </div>
                <?php
                    wp_reset_postdata();
                } else {
                ?>
                    <div>
                        <p>No Event available </p>
                    </div>
                <?php
                }

                ?>

            </div>

        </div>

</section>