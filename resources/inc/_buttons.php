<?php
function btn_outline($parameter = [])
{
    $default = array(
        "url" => "#",
        'text' => "view all",
        'icon' => 'long-arrow',
        'color' => 'primary',
        'wave' => 'dark-btn-wave',
    );
    $options = array_merge($default, $parameter);

    if ($options['color'] === 'white' && $options['wave'] === 'wave-hover') {
        $class = "text-white hover:text-primary-black border-y-50 hover:border-y-200";
    } elseif ($options['color'] === 'white' && $options['wave'] === 'dark-btn-wave') {
        $class = "text-white hover:text-primary-black border-primary-yellow";
    } else {
        $class = "text-primary-black border-primary-yellow";

    }

    // ($options['wave'] === 'dark-btn-wave') ?? $class = 'text-white hover:text-primary-black';

    ob_start();
    ?>

    <a href="<?php echo $options['url']; ?>" class=" <?php echo $class; ?> outline-btn animate-cursor group/item z-10 transition duration-[.4s] ease-linear
    text-sm md:text-base font-medium py-3 px-8 inline-flex items-center gap-[10px] relative rounded-lg border-2
    overflow-hidden">
        <?php echo $options['text']; ?>

        <?php if ($options['icon']): ?>

            <span class="arrow-move">
                <?php echo useSvg($options['icon']); ?>
            </span>
        <?php endif; ?>
        <div class="wave z-[-5] absolute  w-[129%]  h-auto top-full left-0 translate-y-0 duration-[.4s] transition ease-linear group-hover/item:-translate-y-[98%] group-hover/item:ease-linear
            ">
            <!-- w-[262px] h-[83px] left-[-7px]  -->

            <?php echo useSvg($options['wave']); ?>

        </div>
    </a>


    <?php
    $btn_layout_1_return = ob_get_contents();
    ob_end_clean();

    return $btn_layout_1_return;
}



function btn_primary($parameter = [])
{
    $default = array(
        "url" => "#",
        'text' => "view all",
        'icon' => 'long-arrow',
        // 'color' => 'primary',
        'size' => 'large'
    );
    $options = array_merge($default, $parameter);

    if ($options['size'] === 'small') {
        $class = "py-2";
    } else {
        $class = "py-3";
    }

    if ($options['icon'] === 'long-arrow') {
        $classes = 'arrow-move';
    }

    ob_start();
    ?>

    <a href="<?php echo $options['url']; ?>" class=" <?php echo $class; ?> primary-btn animate-cursor group/item bg-primary-yellow text-primary-black z-10
    transition duration-[.4s] ease-linear text-base font-medium px-8 inline-flex items-center gap-[10px] relative
    rounded-lg overflow-hidden">
        <?php echo $options['text']; ?>
        <?php if ($options['icon']): ?>
            <span class="<?php echo $classes; ?>">
                <?php echo useSvg($options['icon']); ?>
            </span>
        <?php endif; ?>

        <div class=" wave z-[-5] absolute w-[129%] top-full left-0 translate-y-0 duration-[.4s] transition ease-linear
        group-hover/item:-translate-y-[98%] group-hover/item:ease-linear ">
            <!-- w-[262px] h-[83px] -->
            <?php echo useSvg('wave-hover'); ?>
        </div>
    </a>




    <?php
    $btn_layout_1_return = ob_get_contents();
    ob_end_clean();

    return $btn_layout_1_return;
}



?>