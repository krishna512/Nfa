<?php
$id = '' . $block['id'];
$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<section class="register pt-[30px] sm:pt-10  md:pt-[74px] <?php echo esc_attr($className); ?> ">
    <?php if ($showhide):

        $event_query = array(
            'post_type' => 'event',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key' => 'featured_events',
                    'value' => 1,
                    'compare' => '='
                )
            )
        );


        $events_query = new WP_Query($event_query);

        while ($events_query->have_posts()) {
            $events_query->the_post();
            $id = get_the_ID();
            $permalink = get_the_permalink();
            $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
            $title = get_the_title();
            $excerpt = excerpt();
            $published_date = get_the_date('d M, Y');
            $event_location = get_field('event_location', $id);

            $event_published_date = get_field('event_published_date', $id);
            $event_published_dates = date_format(date_create($event_published_date), "d M, Y");

            $event_end_date = get_field('event_end_date', $id);
            $event_end_dates = date_format(date_create($event_end_date), "d M, Y");
            $today_date = date('d M, Y');
            $photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';

            ?>
    <div class="register__wrapper relative overflow-hidden">
        <div class="">
            <img loading="lazy" src="<?php echo $feature_img; ?>" class="absolute w-full h-full inset-0 object-cover">
        </div>
        <?php echo photo_credit_section($photo_credit); ?>
        <div class="relative grid md:grid-cols-2">
            <div
                class="register__content pt-12 sm:pt-[60px] pb-[110px] sm:pb-[168px] px-4 md:pl-[50px]  md:pr-4 md:col-start-2">
                <div class="grid gap-6  relative z-10 md:max-w-[74%]">
                    <!-- max-w-[467px] -->
                    <div class="grid gap-4 sm:gap-6">
                        <h2 class=" text-white">
                            <?php echo $title; ?>
                        </h2>
                        <div class="">

                            <p class=" flex text-sm sm:text-base gap-2 items-center text-white font-medium mb-3">
                                <span class="text-primary-yellow text-base sm:text-[22px]">
                                    <?php echo useSvg('calender'); ?>
                                </span>
                                <?php echo $event_published_dates; ?> -
                                <?php echo $event_end_dates; ?>
                            </p>

                            <?php if($event_location):?>
                            <p class=" flex text-sm sm:text-base gap-2 items-center text-white font-medium">
                                <span class="text-primary-yellow test-base sm:text-[22px]">
                                    <?php echo useSvg('location'); ?>
                                </span>
                                <?php echo $event_location; ?>
                            </p>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="button">
                        <?php
                                $options = [
                                    'url' => $permalink,
                                    'text' => 'View Details',
                                    'icon' => '',

                                ];
                                echo btn_primary($options); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php }
    endif; ?>
</section