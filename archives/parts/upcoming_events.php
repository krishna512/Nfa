<?php

$event_query = array(
    'post_type' => 'event',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'featured_events',
            'value' => 1,
            'compare' => '='
        ),
        array(
            'key' => 'event_end_date',
            'value' => date('Y-m-d'),
            'compare' => '>=',
            'type' => 'date'
        )
    )

);

$upcoming_fature_id = 0;
$events_query = new WP_Query($event_query);

?>
<div id="upcoming-events" class="tabcontent"
    style="display: <?php echo ($event_type === 'upcoming') ? 'block' : 'none'; ?>;">

    <div class="<?php echo $posttype; ?>">

        <?php
        while ($events_query->have_posts()) {
            $events_query->the_post();
            $upcoming_fature_id = $id = get_the_ID();
            $permalink = get_the_permalink();
            $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
            $title = get_the_title();
            $excerpt = excerpt(245);
            $published_date = get_the_date('d M, Y');
            $event_location = get_field('event_location');
            $event_published_date = get_field('event_published_date', $id);
            $event_published_date = ($event_published_date) ? date_format(date_create($event_published_date), "d M, Y") : '';

            $event_end_date = get_field('event_end_date', $id);
            $event_end_date = ($event_end_date) ? date_format(date_create($event_end_date), "d M, Y") : '';
            $today_date = date('d M, Y');


            $vacancy_status = (strtotime($today_date) < strtotime($event_end_date)) ? true : false;

            ?>


            <div data-id="<?php echo $id; ?>" id="upcoming events"
                class="flex flex-col lg:flex-row items-center gap-6 border-b border-grey93 pb-9 sm:pb-12 tabcontent">
                <div class="lg:basis-[52%] w-full">
                    <a href="<?php echo $permalink; ?>" class="group">
                        <div class="relative pt-[52%] overflow-hidden rounded-lg">
                            <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                                class="absolute h-full w-full inset-0 object-cover group-hover:scale-105 transition-all duration-[.4s] ease-in-out">
                        </div>
                    </a>
                </div>
                <div class=" lg:basis-[40%]">
                    <div class="grid gap-4 mb-5">
                        <div class="flex gap-3 flex-wrap">
                            <div class="flex items-center gap-2">
                                <?php if ($event_published_date): ?>
                                    <span class="text-primary-blue text-lg">
                                        <?php echo useSvg('calender') ?>
                                    </span>
                                <?php endif; ?>

                                <div class="text-sm text-n-400">
                                    <?php echo $event_published_date; ?>
                                    <?php if ($event_end_date): ?>
                                        -
                                        <?php echo $event_end_date; ?>
                                    <?php endif; ?>

                                </div>

                            </div>

                            <?php if ($event_location) { ?>
                                <div class="flex items-center gap-2">
                                    <span class="text-primary-blue text-lg">
                                        <?php echo useSvg('location') ?>
                                    </span>
                                    <div class="text-sm text-n-400">
                                        <?php echo $event_location; ?>
                                    </div>

                                </div>
                            <?php } ?>
                        </div>
                        <div>
                            <div class="text-lg font-semibold text-primary-black mb-1">
                                <a href="<?php echo $permalink; ?>">
                                    <?php echo $title; ?>
                                </a>
                            </div>
                            <div class="text-n-400">
                                <?php echo $excerpt; ?>
                            </div>
                        </div>
                    </div>

                    <div>
                        <?php
                        $options = [
                            'url' => $permalink,
                            'text' => 'View Detail',
                            'icon' => '',

                        ];
                        echo btn_outline($options); ?>
                    </div>

                </div>
            </div>

            <?php
        }
        wp_reset_postdata();

        ?>

    </div>

    <div class="event-card pt-11">
        <?php
        $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

        $today_date = date('d M, Y');
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => 12,
            'post_status' => array('publish'),
            'meta_query' => array(
                array(
                    'key' => 'event_end_date',
                    'value' => date('Y-m-d'),
                    'compare' => '>=',
                    'type' => 'date'
                )
            ),
            'paged' => 1
        );
        if ($event_type === 'upcoming') {
            $paged = paged();
        } else {
            $paged = 1;
        }
        $args['paged'] = $paged;

        if ($upcoming_fature_id) {
            $args['post__not_in'] = [$upcoming_fature_id];
        }
        $upcoming_events = new WP_Query($args);
        if ($upcoming_events->have_posts()) { ?>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php while ($upcoming_events->have_posts()) {
                    $upcoming_events->the_post();
                    echo eventCard($id); ?>

                <?php } ?>
            </div>

            <?php

        } else {
            ?>
            <div>
                <p>No Upcoming Event available </p>
            </div>
            <?php
        }
        ?>

        <?php if ($pagination = custom_query_pagination($upcoming_events, $paged)) { ?>
            <div class="pt-8 md:pt-[60px]">
                <?php
                if (str_contains($pagination, 'past')) {
                    echo str_replace('past', 'upcoming', $pagination);
                } elseif (str_contains($pagination, 'upcoming')) {
                    echo $pagination;
                } else {
                    echo str_replace('events', 'events/upcoming', $pagination);
                }
                ?>
            </div>
        <?php }
        wp_reset_postdata();
        ?>



    </div>


</div>