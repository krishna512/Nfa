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
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> our-principles custom-card ">
        <div class="container  custom-card-wrapper">
            <div class="text-center mb-9">
                <h3 class="">
                    <?php echo $title; ?>
                </h3>
                <p class="text-n-400 sm:text-xl leading-normal">
                    <?php echo $sub_title; ?>
                </p>
            </div>
            <div class=" gap-6 grid sm:grid-cols-2 md:grid-cols-3">

                <?php

                $resource = array(
                    'post_type' => 'resource',
                    'post_status' => 'publish',
                    'posts_per_page' => 6,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'resource-category', //double check your taxonomy name in you dd 
                            'terms' => '30',
                        ),
                    ),


                );


                $resource_query = new WP_Query($resource);
                while ($resource_query->have_posts()) {
                    $resource_query->the_post();
                    $id = get_the_ID();
                    $taxonomies = 'resource-category';

                    echo resourcesCard($id, $taxonomies);
                }

                ?>
            </div>
            <div class=" mt-6 sm:mt-9 text-center">

                <?php
                $options = [
                    'url' => '/resources/upr-submission/',
                    //  $button_url,
                    'text' => 'View all UPR Submission',
                    // $button_text
            
                ];
                echo btn_primary($options); ?>
            </div>

        </div>

    </section>
    <?php
endif; ?>