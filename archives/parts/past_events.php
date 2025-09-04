<?php
$args = array(
    'post_type' => 'event',
    'posts_per_page' => 12,
    'post_status' => array('publish'),
    'meta_query' => array(
        array(
            'key' => 'event_end_date',
            'value' => date('Y-m-d'),
            'compare' => '<',
            'type' => 'date'
        )
    ),
);
if ($event_type === 'past') {
    $paged = paged();
} else {
    $paged = 1;
}
$args['paged'] = $paged;

?>
<div id="past-events" class="tabcontent" style="display: <?php echo ($event_type === 'past') ? 'block' : 'none'; ?>;">
    <div class="event-card pt-11">
        <?php
        $past_events_query = new WP_Query($args);

        if ($past_events_query->have_posts()) { ?>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php while ($past_events_query->have_posts()) {
                    $past_events_query->the_post();
                    echo eventCard($id); ?>

                <?php } ?>
            </div>

        <?php

        } else {
        ?>
            <div>
                <p>No Past Event available </p>
            </div>
        <?php
        }
        ?>

        <?php if ($pagination = custom_query_pagination($past_events_query, $paged)) { ?>
            <div class="pt-8 md:pt-[60px]">
                <?php
                if (str_contains($pagination, 'upcoming')) {
                    echo str_replace('upcoming', 'past', $pagination);
                } elseif (str_contains($pagination, 'past')) {
                    echo $pagination;
                } else {
                    echo str_replace('events', 'events/past', $pagination);
                }
                ?>
            </div>
        <?php }
        wp_reset_postdata();
        ?>

    </div>

</div>