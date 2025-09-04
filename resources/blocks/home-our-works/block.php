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
<section class="<?php echo esc_attr($className); ?>">
    <div class="our-work  pt-[60px] pb-[30px] sm:pt-20 sm:pb:10  md:pt-[134px] md:pb-[74px]  container">
        <!-- py-[60px] sm:py-20 md:pt-[134px] md:pb-[148px]  -->
        <?php if ($showhide): ?>
            <div class="text-center mb-6 md:mb-9 our-work-top">
                <h2 class="">
                    <?php echo $title; ?>
                </h2>
                <p class="sm:text-xl text-n-400 ">
                    <?php echo $sub_title; ?>
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2  md:grid-cols-3 lg:grid-cols-4 gap-3 our-work__wrapper">
                <?php
                $work = array(
                    'post_type' => 'work',
                    'post_status' => 'publish',
                    'posts_per_page' => 4,
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

                            <div class="our-work__images relative pt-[120%] md:pt-[145%]">
                                <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                                    class="absolute inset-0 w-full h-full object-cover ">

                            </div>
                            <a>

                                <div class="our-work__items absolute right-0 bottom-0  left-0">
                                    <div class="relative bg-n-50 pt-8 pb-6 px-6 text-center">

                                        <div class="flex justify-center mt-[-59px] ">
                                            <img src="<?php echo $icon; ?>">
                                        </div>

                                        <div class="  sm:text-lg font-semibold mb-1 line-clamp-2">
                                            <?php echo $title; ?>
                                        </div>

                                        <div
                                            class="invisible opacity-0 group-hover:opacity-100 group-hover:visible duration-200 ease-in-out">


                                            <div class="text-n-40 mb-4 text-sm text-ellipsis line-clamp-6">
                                                <?php echo $excerpt; ?>
                                            </div>

                                            <div class="">
                                                <?php
                                                $options = [
                                                    'url' => $permalink,
                                                    'text' => 'Read More',
                                                    'icon' => '',

                                                ];
                                                echo btn_outline($options); ?>
                                            </div>

                                        </div>


                                    </div>

                                </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>