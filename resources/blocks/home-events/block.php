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


$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>

<?php if ($showhide): ?>
<section class="<?php echo esc_attr($className); ?>">
    <div class="container latest-block py-[30px] sm:py-10  md:py-[74px]">
        <div class="mb-6 sm:mb-12 text-center">
            <h3 class="font-bigShouldersDisplay font-bold leading-[1.2]">
                <?php echo $title; ?>
            </h3>
            <p class=" sm:text-xl leading-normal text-n-400">
                <?php echo $sub_title; ?>
            </p>
        </div>
        <div class="event-card pt-11" data-id="<?php echo $id; ?>">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php $event = array(
                            'post_type' => 'event',
                            'posts_per_page' => 3,
                            'post_status' => array('publish'),
                            'meta_query' => array(
                                 array(
                                    'key' => 'featured_events',
                                    'value' => 0,
                                    'compare' => '='
                                ),
                                
                            )
                        );


                        $event_query = new WP_Query($event);
                        // var_dump($work_query);
                    
                        while ($event_query->have_posts()) {
                            $event_query->the_post();
                            $id = get_the_ID();
                            $permalink = get_the_permalink();
                            $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
                            $title = get_the_title();
                            $excerpt = excerpt();
                            $published_date = get_the_date('d M, Y');
                            $event_location = get_field('event_location');
                        
                            $event_published_date = get_field('event_published_date',$id);
                            $event_published_date = ($event_published_date) ? date_format(date_create($event_published_date), "d M, Y") : '';
                        
                            $event_end_date = get_field('event_end_date',$id);
                            $event_end_dates = ($event_end_date) ? date_format(date_create($event_end_date), "d M, Y") : '';
                            $today_date = date('d M, Y');
                            ?>
                <div class="rounded-lg card-animate overflow-hidden flex flex-col" data-id="<?php echo $id; ?>">
                    <a href="<?php echo $permalink; ?>" class="group">
                        <div class="relative pt-[58%] overflow-hidden">
                            <img src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                                class="absolute h-full w-full inset-0 object-cover group-hover:scale-105 transition-all duration-[.4s] ease-in-out">
                        </div>
                    </a>

                    <div class="events-card--content flex-1  py-6 px-4 bg-n-50">

                        <div class="flex gap-y-2 gap-x-4 flex-wrap mb-4">
                            <div class="flex items-center gap-2">

                                <?php if ($event_published_date): ?>
                                <span class="text-primary-blue text-lg">
                                    <?php echo useSvg('calender') ?>
                                </span>
                                <?php endif; ?>

                                <div class="text-sm text-n-400">
                                    <?php echo $event_published_date; ?>
                                    <?php if ($event_end_dates): ?>
                                    -
                                    <?php echo $event_end_dates; ?>
                                    <?php endif; ?>

                                </div>


                            </div>
                            <?php if ($event_location): ?>
                            <div class="flex items-center gap-2">
                                <span class="text-primary-blue text-lg">
                                    <?php echo useSvg('location') ?>
                                </span>
                                <div class="text-sm text-n-400">
                                    <?php echo $event_location; ?>
                                </div>

                            </div>

                            <?php endif; ?>
                        </div>

                        <div class="sm:text-lg text-primary-black font-semibold mb-6">
                            <a href="<?php echo $permalink; ?>">
                                <?php echo $title; ?>
                            </a>

                        </div>
                    </div>


                </div>


                <?php
                        }
                        ?>
            </div>

        </div>
        <div class="mt-9 text-center button">

            <?php
                    $options = [
                        'url' => '/events',
                        'text' => 'View all Events',
                        ];
                    echo btn_primary($options); ?>
        </div>
    </div>


</section>

<?php endif; ?>