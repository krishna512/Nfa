<?php
$taxonomies = 'multimedia-category';
$terms = get_terms(['taxonomy' => $taxonomies]);
if (is_tax()) {
    $queried_object = get_queried_object();
    $tax_slug = $queried_object->slug;
}
// var_dump($terms);
?>

<div class="">
    <?php
    echo get_archive_page_heading($posttype);
    ?>
    <div class="container pt-[60px] pb-[60px] sm:pb-24">
        <?php echo taxnomycontent();  ?>
        <div>
            <?php
            $podacast = array(
                'post_type' => 'multimedia',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'multimedia-category',
                        'field' => 'slug',
                        'terms' => $tax_slug,
                    )
                ),



            );


            $poda_cast = new WP_Query($podacast);

            while ($poda_cast->have_posts()) {
                $poda_cast->the_post();
                $id = get_the_ID();
                $permalink = get_permalink();
                $title = get_the_title();
                $term_category = get_the_terms($id, $taxonomies);
                // var_dump($term_category);
                $taxoTermsSLug = taxoTermsSLug($id, $taxonomies);
                $video_url = get_field('video_url');
                $oEmbed = get_field('video_url');

                $image = ($oEmbed) ? acf_youtube_thumbnail($oEmbed) : get_the_post_thumbnail($id, 'large');
                ?>


                <div class="<?php echo $taxoTermsSLug; ?> " data-id="<?php echo $id; ?>">
                    <div class="flex flex-col lg:flex-row items-center gap-6 border-b border-grey93 pb-9 sm:pb-12">
                        <div class="lg:basis-[52%] w-full">
                            <div class="relative pt-[52%] overflow-hidden rounded-lg
                            ">
                                <a href="<?php echo $permalink; ?>">
                                    <?php echo $image; ?>
                                </a>
                            </div>
                        </div>
                        <div class="lg:basis-[40%]">
                            <div class="grid gap-3">


                                <a href="<?php echo $permalink; ?>" class="sm:text-lg font-semibold">
                                    <?php echo $title; ?>
                                </a>
                                <div class="text-sm text-n-400">
                                    <?php the_content(); ?>
                                </div>



                                <div>
                                    <?php
                                    $options = [
                                        'url' => $permalink,
                                        'text' => 'Play Now',
                                        'icon' => '',

                                    ];
                                    echo btn_outline($options); ?>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        <?php }

            ?>

        <!-- others Related Videos -->
        <div class=" pt-9 sm:pt-12 grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php
            $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
            $args = array(
                'post_type' => 'multimedia',
                'post_status' => 'publish',
                'posts_per_page' => 12,
                'paged' => $paged,
                'category__in' => wp_get_post_categories(get_the_ID()),
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'multimedia-category',
                        'field' => 'slug',
                        'terms' => $tax_slug,
                    )
                ),
            );

            $related_multimedia = new WP_Query($args);

            if ($related_multimedia->have_posts()) {

                while ($related_multimedia->have_posts()) {
                    $related_multimedia->the_post();
                    echo podcast($id);
                }
                wp_reset_postdata();
            } ?>


        </div>
        <?php

        if (custom_query_pagination($related_multimedia, $paged)) { ?>

            <div class=" pt-8 md:pt-[60px]">

                <?php echo custom_query_pagination($related_multimedia, $paged); ?>

            </div>

        <?php } ?>
    </div>