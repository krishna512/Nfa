<?php
// vacancy archive page
$taxonomies = 'opportunity-cate';
$terms = get_terms(['taxonomy' => $taxonomies, 'hide_empty' => true]);
?>

<div class="<?php echo $posttype; ?>-archive">

    <?php
    echo get_archive_page_heading($posttype);
    ?>

    <div class=" pt-[60px] pb-[60px] sm:pb-20">
        <div class="container">
        <?php if(have_posts()){?>
            <!-- <h3 class="leading-[1.2] mb-12 uppercase"> join our Team</h3> -->

            <div class="<?php echo $taxonomies; ?> tab-menu sticky-menu sticky-tab">
                <ul
                    class="flex max-sm:lex-col gap-3 tab-menu__wrapper sticky-menu__item border-b-2 border-primary-blue mb-8 sm:mb-[60px] overflow-x-auto">
                    <?php
                    if ($terms) {
                        foreach ($terms as $term) {
                            ?>
                            <li class="tab-menu__item sticky-menu__item opportunity__tab-menu--item cursor-pointer shrink-0"
                                data-filter="<?php echo ($term->count > 0) ? $term->slug : 'no-data'; ?>">
                                <?php echo $term->name; ?>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="opportunity">
               
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-y-8 gap-x-6">
                    <?php
                    $opportunity_query = array(
                        'post_type' => 'opportunity',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                    );


                    $opportunity_queries = new WP_Query($opportunity_query);
                    while ($opportunity_queries->have_posts()) {
                        $opportunity_queries->the_post();
                        $id = get_the_ID();
                        $permalink = get_the_permalink();
                        $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
                        $title = get_the_title();
                        $excerpt = excerpt();
                        $taxoTermsSLug = taxoTermsSLug($id, $taxonomies);
                        // $term_category = get_the_terms($id, $taxonomies);
                        // var_dump($term_category);
                        $published_date = get_the_date('d M, Y');
                        $deadline = get_field('deadline');
                        $today_date = date('d M, Y');
                        $vacancy_status = (strtotime($today_date) < strtotime($deadline)) ? true : false;
                        $deadline = date_format(date_create($deadline), "d M, Y");

                        $upload_file = get_field('upload_file');
                        $no_of_vacancies = get_field('number_of_openings');



                        ?>

                        <div class="<?php echo $taxoTermsSLug; ?> bg-n-50 py-6 px-4 rounded-lg overflow-hidden relative opportunity__card group"
                            data-id="<?php echo $id; ?>">
                            <div class="grid gap-6">
                                <div class="grid gap-4">
                                    <div class="grid gap-3">

                                        <a href="<?php echo $permalink; ?>" class="text-lg font-semibold ">
                                            <?php echo $title; ?>
                                        </a>

                                        <div class="flex gap-y-2 gap-x-4 flex-wrap">
                                            <?php if ($no_of_vacancies): ?>
                                                <div class="openings flex gap-2 items-center">
                                                    <span class="text-primary-blue">
                                                        <?php echo useSvg('author'); ?>
                                                    </span>
                                                    <span class="text-sm font-medium text-n-400">
                                                        <?php echo $no_of_vacancies; ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>

                                            <div class="deadline flex gap-2 items-center">
                                                <span class="text-normal text-primary-blue">
                                                    <?php echo useSvg('calender'); ?>
                                                </span>
                                                <span class="text-sm font-medium text-n-400">
                                                    <?php echo $deadline; ?>
                                                </span>
                                            </div>

                                        </div>
                                        <!-- <?php if ($upload_file): ?>
                                        <div class="flex gap-y-2 gap-x-4">
                                            <div class="flex gap-2">
                                                <a href="<?php echo $upload_file; ?>" download class="">
                                                    <?php echo useSvg('download'); ?>
                                                    <span>Download Job Description </span>
                                                </a>
                                            </div>

                                            <div>
                                                <a href="<?php echo $upload_file; ?>" target="_blank" class="">

                                                    <?php echo useSvg('view-eye-icon'); ?>
                                                    <span>View Job Description </span>
                                                </a>
                                            </div>
                                        </div>

                                    <?php endif ?> -->
                                    </div>

                                    <div class="vacancy-description text-n-400">
                                        <?php echo $excerpt; ?>
                                    </div>
                                </div>

                                <div class="view-details-btn">
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
                    ?>
                </div>
                <?php }else{

                    echo "Currently there are no vacancies available";
                }?>
            </div>
        </div>
    </div>


</div>
</div>