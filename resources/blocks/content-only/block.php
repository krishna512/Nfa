<?php
$id = '' . $block['id'];
$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}


$content = (function_exists('get_field') && $title = get_field('content')) ? $title : '';
$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';




?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
        <div class="approach-container pt-[60px] pb-10">
            <div class=" max-w-[607px] mx-auto text-n-400">
                <?php echo $content; ?>

            </div>
        </div>
    </section>

<?php endif; ?>