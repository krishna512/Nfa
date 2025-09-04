<?php

//default archive page template card layout

?>

<div class="<?php echo $posttype; ?>-archive container">
    <?php
    echo get_archive_page_heading($posttype);
    ?>
    <?php
    if (have_posts()) {
        ?>
        <div class="grid grid-cols-1 sm:grid-cols-2  md:grid-cols-4 gap-3 py-20 px-9">
            <?php
            $work = array(
                'post_type' => 'work',
                'post_status' => 'publish',
                'posts_per_page' => 9,

            );


            $work_query = new WP_Query($work);
            // var_dump($work_query);
        
            while ($work_query->have_posts()) {
                $work_query->the_post();
                $id = get_the_ID();
                $permalink = get_the_permalink();
                $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
                $title = get_the_title();
                $excerpt = excerpt();
                $icon = get_field('icon', $id);
                // var_dump($icon);
                ?>
                <div class="our-work__content overflow-hidden relative rounded-lg group" data-id="<?php echo $id; ?>">
                    <a href="<?php the_permalink(); ?>">

                        <div class="our-work__images relative pt-[145%]">
                            <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                                class="absolute inset-0 w-full h-full object-cover ">

                        </div>

                        <div class="our-work__items absolute right-0 bottom-0  left-0">
                            <div class="relative bg-n-50 pt-8 pb-6 px-6 text-center">

                                <div class="flex justify-center mt-[-59px] ">
                                    <img src="<?php echo $icon; ?>">
                                </div>

                                <div class=" text-lg font-semibold mb-1 line-clamp-2">
                                    <?php echo $title; ?>
                                </div>

                                <div
                                    class="invisible opacity-0 group-hover:opacity-100 group-hover:visible duration-200 ease-in-out">


                                    <div class="text-n-40 mb-4 text-sm text-ellipsis line-clamp-6">
                                        <?php echo $excerpt; ?>
                                    </div>
                                    <div>
                                        <?php
                                        $options = [
                                            'url' => $permalink,
                                            'text' => 'Read More',
                                            'icon' => '',

                                        ];
                                        echo btn_primary($options); ?>
                                        <a href="<?php echo $permalink; ?>"><button>Read More</button></a>
                                    </div>
                                </div>


                            </div>

                        </div>


                    </a>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        ?>
        <div>
            <p>No data available </p>
        </div>
        <?php
    }
    echo main_query_pagination();
    ?>




</div>