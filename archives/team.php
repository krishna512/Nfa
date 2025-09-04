<?php
$taxonomies = 'team-category';
$terms = get_terms(['taxonomy' => $taxonomies, 'hide_empty' => true]);
// var_dump($terms);
?>
<?php
echo get_archive_page_heading($posttype);
?>
<div class=" pt-[60px] pb-[60px] sm:pb-20">
    <div class="container">
        <h3 class="leading-[1.2] mb-2 sm:mb-8 ">Meet Our Dedicated Team</h3>

        <div class="<?php echo $taxonomies; ?> tab-menu sticky-menu sticky-tab">
            <ul class="flex gap-3 tab-menu__wrapper sticky-menu__item border-b-2 border-primary-blue overflow-x-auto">
                <!-- <li data-filter="all" class= max-sm:flex-col"active tab-menu__item cursor-pointer">All</li> -->
                <?php
                if ($terms) {
                    foreach ($terms as $term) {
                        ?>
                        <li class="tab-menu__item sticky-menu__item cursor-pointer shrink-0"
                            data-filter="<?php echo ($term->count > 0) ? $term->slug : 'no-data'; ?>">
                            <?php echo $term->name; ?>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="team card-animate-wrapper mt-[60px]">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-8 gap-x-6">
                <?php
                $team_query = array(
                    'post_type' => 'team',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                );


                $team_queries = new WP_Query($team_query);
                while ($team_queries->have_posts()) {
                    $team_queries->the_post();
                    $id = get_the_ID();
                    $title = get_the_title();
                    $taxoTermsSLug = taxoTermsSLug($id, $taxonomies);
                    $designation = get_field('designation');
                    $linkedin = get_field('linkedin');
                    $email = get_field('e-mail');



                    ?>
                    <div class="<?php echo $taxoTermsSLug; ?> bg-n-50  rounded-lg overflow-hidden relative team__card card-animate group"
                        data-id="<?php echo $id; ?>">
                        <a href="<?php the_permalink(); ?>" class="pointer-events-auto">

                            <div
                                class="relative group-hover:static pt-[98%] overflow-hidden team__card--images hover:aspect-[1.274]">
                                <?php if (has_post_thumbnail($id)) {
                                    $class = "absolute inset-0 w-full h-full object-cover duration-200 ease-in";
                                    echo get_the_post_thumbnail($id, 'medium', array('class' => $class));
                                }

                                ?>


                                <div
                                    class="px-5 grid gap-1 absolute bottom-9 group-hover:opacity-100 group-hover:visible text-white z-10 opacity-0 invisible team__card--hover-content">
                                    <div class=" mb-2 sm:mb-3">
                                        <div class="font-bold uppercase  text-2xl font-bigShouldersDisplay mb-1">

                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo $title; ?>
                                            </a>

                                        </div>
                                        <div class="text-xs">
                                            <?php echo $designation; ?>

                                        </div>
                                    </div>
                                    <div class="text-sm">
                                        <a href="<?php the_permalink(); ?>"
                                            class="flex gap-[6px] items-center animate-cursor">
                                            View
                                            Bio
                                            <span class="text-[10px] arrow-move">
                                                <?php echo useSvg('long-arrow'); ?>
                                            </span> </a>
                                    </div>
                                </div>


                            </div>
                            <div
                                class="p-5 grid gap-1  group-hover:invisible  group-hover:opacity-100 team__card--content duration-200 ease-in">
                                <div class="font-semibold text-n-500">

                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo $title; ?>
                                    </a>

                                </div>
                                <div class="text-xs text-n-400">
                                    <?php echo $designation; ?>

                                </div>
                            </div>


                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>