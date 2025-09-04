<div class="text-center mb-9 py-20">
    <h2 class="font-bigShouldersDisplay font-bold uppercase">
        Insights Hub
    </h2>
    <p class="text-xl text-n-400 ">
        Explore a Wealth of Knowledge, Ideas, and Perspectives
    </p>
</div>
<div>
    <?php
     $post_query = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'order' => 'ASC',
        'orderby' => 'ID',

    );


    $posts_query = new WP_Query($post_query);
   
 while ($posts_query->have_posts()) {
        $posts_query-> the_post();
                $id = get_the_ID();
                $title = get_the_title();
                $permalink = get_the_permalink();
                $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
                   
                $published_date = get_the_date('d M, Y');
                $file_upload = get_field('file_upload');
                $author = get_field('author');
                    // var_dump($author);

            ?>
    <img src="<?php echo $feature_img; ?>">
    <div class="">
        <span class=""><?php echo useSvg('calender') ?></span><?php echo $published_date; ?>
    </div>
    <a href="<?php echo $permalink;?>">
        <h3><?php echo $title; ?></h3>
    </a>
    <?php
                    $options = [
                        'url' => $permalink,
                        'text' => 'View Detail',
                        'icon' => '',

                    ];
                    echo btn_primary($options); ?>
</div>



<?php }?>
</div>