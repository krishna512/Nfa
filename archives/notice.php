<?php

//default archive page template card layout

?>

<div class="<?php echo $posttype; ?>-archive">
    <?php
    echo get_archive_page_heading($posttype);
    ?>
    <div class="events-wrapper container pt-[60px] pb-[60px] sm:pb-24">
        <div class="grid gap-10 sm:gap-[60px] divide-y divide-grey93">
            <div class="notice-card">
                <?php
                if (have_posts()) {
                    ?>

                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <?php
                        while (have_posts()) {
                            the_post();
                            $id = get_the_ID();

                            echo noticeCard($id);

                        }

                        ?>
                    </div>

                    <?php

                } else {
                    ?>
                    <div>
                        <p>No Notices available </p>
                    </div>
                    <?php
                }
                // $pagination = main_query_pagination();
                // echo $pagination;
                
                ?>

                <?php if (main_query_pagination()) { ?>

                    <div class=" pt-8 md:pt-[60px]">

                        <?php echo main_query_pagination(); ?>

                    </div>

                <?php } ?>



            </div>

        </div>

    </div>
</div>