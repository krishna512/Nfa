<div class="">
    <?php
    $taxonomies = 'team-category';
    echo get_archive_page_heading($posttype);
    ?>

</div>
<div class=" pt-[60px] pb-[60px] sm:pb-20">
    <div class="container">
        <div class="team card-animate-wrapper mt-[60px]">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-8 gap-x-6">
                <?php
                while (have_posts()) {
                    the_post();
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