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
    <section class="resources <?php echo esc_attr($className); ?>">
        <div class="resources-container relative py-[30px] sm:py-10  md:py-[74px]">
            <!-- mb-10 sm:mb-20 md:mb-[148px] -->
            <div class="lg:flex items-center relative overflow-hidden">
                <div class="lg:basis-1/4 lg:mr-6 max-lg:mb-6">
                    <div class="grid sm:gap-3 max-lg:text-center resources-info">
                        <h3 class="leading-[1.2] lg:max-w-[256px]">
                            <?php echo $title; ?>
                        </h3>

                        <p class=" text-n-400 sm:text-xl sm:leading-normal">
                            <?php echo $sub_title; ?>
                        </p>

                        <div class="hidden lg:block">
                            <?php
                            $options = [
                                'url' => '/resource',
                                //  $button_url,
                                'text' => 'View all Resources',
                                // $button_text
                                'color' => 'yellow'
                            ];
                            echo btn_primary($options); ?>
                        </div>
                    </div>
                </div>

                <div class="resources-slider-wrapper overflow-hidden w-full relative ">
                    <div class="resources-slider overflow-hidden w-full relative ">
                        <?php
                        $work = array(
                            'post_type' => 'resource',
                            'post_status' => 'publish',
                            'posts_per_page' => 5,

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
                            $taxonomies = 'resource-category';
                            $term_category = get_the_terms($id, $taxonomies);
                            ?>
                            <div class="resources__card mx-3 relative rounded-lg overflow-hidden group"
                                data-id="<?php echo $id; ?>">
                                <a href="<?php echo $permalink; ?>">
                                    <div class="relative resources__card--images aspect-[289/349]">
                                        <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                                            class="absolute w-full h-full inset-0 object-cover">
                                    </div>
                                </a>

                                <div class="resources__card--item text-white absolute bottom-[56px] px-4 py-5 z-10">
                                    <?php
                                    if ($term_category) {
                                        ?>
                                        <div class="related-category mb-3 <?php echo $taxonomies; ?> ">
                                            <div class="card-tag">
                                                <ul class="card-tag-inner">
                                                    <li class="flex gap-2">
                                                        <span class=" relative top-[6px] text-base text-primary-yellow">
                                                            <?php echo useSvg('send'); ?>
                                                        </span>


                                                        <div class="flex flex-wrap">
                                                            <?php
                                                            foreach ($term_category as $category) {
                                                                ?>
                                                                <a href="<?php echo esc_url(get_term_link($category)) ?>"
                                                                    class="category-tags">
                                                                    <span class="text-sm leading-normal font-medium"
                                                                        data-category="<?php echo $category->slug; ?>">
                                                                        <?php echo $category->name; ?>

                                                                    </span>
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class=" text-lg font-medium mb-6 line-clamp-2 group-hover:line-clamp-4">
                                        <a href="<?php echo $permalink; ?>">
                                            <?php echo $title; ?>
                                        </a><br>

                                    </div>

                                    <a href="<?php echo $permalink; ?>">
                                        <div class="text-sm flex items-center gap-2 animate-cursor">
                                            <div>Read me</div>
                                            <span class="arrow-move">
                                                <?php echo useSvg('long-arrow'); ?>
                                            </span>
                                        </div>
                                    </a>

                                </div>
                            </div>
                            <?php
                        }


                        ?>
                    </div>

                    <div class="resources-slider__navigation">
                        <div class="resources-slider__dots"></div>
                    </div>
                </div>



                <div class=" text-center block lg:hidden mt-8">
                    <?php
                    $options = [
                        'url' => '/resource',
                        //  $button_url,
                        'text' => 'View all Resources',
                        // $button_text
                        'color' => 'yellow'
                    ];
                    echo btn_primary($options); ?>
                </div>

            </div>
        </div>

    </section>
<?php endif; ?>