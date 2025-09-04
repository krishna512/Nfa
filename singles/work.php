<?php $icon = get_field('icon');
$id = get_the_ID();
$title = get_the_title();
$posttype = get_post_type();
$background_image = get_field('background_image');
$photo_credit = get_field('photo_credit');
// var_dump($bannerImageID);
$sub_heading = get_field('sub_heading');
$permalink = get_permalink();
$current_slug = get_post(get_the_ID())->post_name;
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';


?>
<section class="<?php echo $posttype ?>">
    <div id="hero-banner"
        class=" hero__banner relative flex min-h-[430px] pt-20 pb-8 md:pt-32 md:pb-20 overflow-hidden hero-content">
        <img src="<?php echo $background_image; ?>" class="absolute inset-0 w-full h-full object-cover">

        <?php echo photo_credit_section($photo_credit); ?>
        <div class="container relative z-10 mt-auto hero__banner--content">
            <div class="text-white">
                <div class=" grid gap-4 relative z-10 max-w-xl">
                    <h1 class=" font-bigShouldersDisplay font-bold">
                        <?php echo $title; ?>
                    </h1>
                    <?php if ($sub_heading) { ?>
                        <p class=" text-xl md:pr-7">
                            <?php echo $sub_heading; ?>
                        </p>
                    <?php } ?>
                </div>

            </div>
        </div>

    </div>

    <div class="pt-[60px] work-section">
        <div class=" sticky-menu bg-white">
            <div class="container">
                <div class="">
                    <?php
                    $work = array(
                        'post_type' => 'work',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,

                    );


                    $work_query = new WP_Query($work);
                    // var_dump($work_query); 
                    ?>
                    <?php if ($work_query->have_posts()): ?>
                        <ul
                            class="work-menu sub-menu sticky-menu__wrapper  max-sm:rounded-lg flex  md:items-center lg:justify-center overflow-x-auto">
                            <?php while ($work_query->have_posts()) {
                                $work_query->the_post();

                                $id = get_the_ID();
                                $permalink = get_the_permalink();
                                // $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                // $current = ($actual_link == $permalink);
                                // var_dump($current);
                                $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
                                $title = get_the_title();
                                $excerpt = excerpt();
                                $post_slug = get_post(get_the_ID())->post_name;

                                $icon = get_field('icon', $id); ?>
                                <li
                                    class="menu-item  sticky-menu__item menu-item-<?php echo $id ?> <?php echo ($post_slug === $current_slug) ? "current-menu-item" : ""; ?>">
                                    <a href="<?php echo $permalink; ?>" class="flex items-center gap-x-2 menu-link">
                                        <!-- <span class="icon relative">
                                            <img src="< ?php echo $icon; ?>">

                                        </span> -->
                                        <?php echo $title; ?>
                                    </a>
                                </li>

                            <?php }
                            wp_reset_postdata();

                            ?>
                        </ul>
                    <?php endif; ?>


                </div>
            </div>
        </div>
        <div>
            <?php gutenbergEditorContent(); ?>
        </div>


    </div>
</section>