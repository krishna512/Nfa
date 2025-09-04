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
$content = (function_exists('get_field') && $content = get_field('content')) ? $content : '';
$image = (function_exists('get_field') && $image = get_field('image')) ? $image : '';
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';
  

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';
$hasImageOnly = !empty($image) && empty($title) && empty($content);



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> partnership-image-block">

        <div class=" approach-container work-block">
            <div class="single-work-wrapper max-w-[607px] mx-auto my-5 sm:my-10">

                <?php if ($title): ?>
                    <h3 class="mb-3 mt-10 sm:mt-[60px]">
                        <?php echo $title; ?>
                    </h3>
                <?php endif; ?>


                <?php if ($image): ?>
                    <div class="single-work-image">
                        <div class="relative pt-[45%] overflow-hidden rounded-lg">
                            <img src="<?php echo $image; ?>" class="absolute h-full w-full inset-0 object-cover">
                            <?php echo photo_credit_section($photo_credit); ?>
                        </div>
                        
                    </div>
                <?php endif; ?>

                <div class="paragraph wp-block-post-content entry-content">
                    <?php echo $content; ?>

                </div>
            </div>


        </div>
    </section>

<?php endif;