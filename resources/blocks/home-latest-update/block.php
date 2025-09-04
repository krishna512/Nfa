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
        <div class="bg-n-50">
            <!-- mb-10  sm:mb-20 md:mb-[148px] -->
            <div class="py-10 sm:py-20 container latest-block">
                <div class="mb-6 sm:mb-12 text-center">
                    <h3 class="font-bigShouldersDisplay font-bold leading-[1.2]">
                        <?php echo $title; ?>
                    </h3>
                    <p class=" sm:text-xl leading-normal text-n-400">
                        <?php echo $sub_title; ?>
                    </p>
                </div>

                <?php
                $blog = array(
                    'post_type' => 'blog',
                    'post_status' => 'publish',
                    'posts_per_page' => 1,


                );


                $blogs = new WP_Query($blog);

                // if ($featured_posts): ?>
                <div class="grid lg:grid-cols-12 gap-[22px] relative latest-block-wrapper" data-id="<?php echo $id; ?>">
                    <?php while ($blogs->have_posts()):
                        $blogs->the_post();
                        $id = get_the_ID();
                        $published_date = get_the_date('d M, Y');
                        $permalink = get_the_permalink();
                        $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
                        $title = get_the_title();
                        $excerpt = excerpt();
                        ?>
                        <div class="relative update-feature pt-[58%] lg:col-span-7 rounded-lg overflow-hidden group">
                            <a href="<?php echo $permalink ?>">
                                <!-- < ?php echo the_permalink($featured_posts) ?> -->

                                <img loading="lazy" src="<?php echo $feature_img; ?>"
                                    class=" absolute w-full h-full inset-0 object-cover group-hover:scale-105 transition-all duration-[.4s] ease-in-out">

                            </a>

                            <div
                                class=" w-full sm:max-w-[63%] relative sm:absolute p-4 sm:py-5 sm:px-6 update-feature-content bottom-0 sm:bottom-9">
                                <!-- max-w-[421px] -->
                                <div class="">
                                    <a href="<?php echo $permalink ?>">
                                        <div class="sm:text-lg mb-1 font-medium leading-normal">
                                            <!-- <?php echo esc_html($featured_posts->post_title); ?> -->
                                            <?php echo $title; ?>
                                        </div>
                                    </a>

                                    <div class="text-sm sm:text-base text-n-400">
                                        <?php echo $published_date; ?>
                                    </div>

                                </div>

                            </div>
                        </div>


                    <?php endwhile; ?>


                    <div class="lg:col-span-5 overflow-hidden latest-update-side grid space-y-4 divide-y divide-text-grey">
                        <?php $work = array(
                            'post_type' => 'blog',
                            'post_status' => 'publish',
                            'posts_per_page' => 3,
                            'order' => 'DESC',
                            'post__not_in' => array(get_the_ID()),
                        );


                        $work_query = new WP_Query($work);
                        // var_dump($work_query);
                    
                        while ($work_query->have_posts()) {
                            $work_query->the_post();
                            $id = get_the_ID();
                            $published_date = get_the_date('d M, Y');
                            $permalink = get_the_permalink();
                            $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
                            $title = get_the_title();
                            $excerpt = excerpt();
                            ?>
                            <div class="grid sm:grid-cols-2 gap-4 latest-side-content " data-id="<?php echo $id; ?>">

                                <!-- <div class=" relative rounded-lg pt-[57%] overflow-hidden"> -->
                                <a class="relative rounded-lg pt-[49%] overflow-hidden group" href="<?php echo $permalink; ?>">
                                    <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                                        class="absolute h-full w-full left-0 top-0 object-cover group-hover:scale-105 transition-all duration-[.4s] ease-in-out">
                                </a>
                                <!-- </div> -->


                                <div class="">
                                    <a href="<?php echo $permalink; ?>"
                                        class="sm:text-lg font-medium mb-1 text-primary-black leading-normal">
                                        <?php echo $title; ?>
                                    </a>
                                    <div class="text-sm sm:text-base text-n-400 leading-normal">
                                        <?php echo $published_date; ?>
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
                        'url' => '/blog',
                        //  $button_url,
                        'text' => 'View all Blogs',
                        // $button_text
                
                    ];
                    echo btn_primary($options); ?>
                </div>
            </div>
        </div>

    </section>

<?php endif; ?>