<?php

function paged()
{
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
    return $paged;
}

function custom_query_pagination($query, $paged)
{

    global $wp_query, $svgIcon;

    $big = 999999999;
    $rightIcon = useSvg('chevron-right');
    $leftIcon = useSvg('chevron-left');

    $paginate = paginate_links(
        array(
            'base' => str_replace($big, '%#%', html_entity_decode(get_pagenum_link($big))),
            'total' => $query->max_num_pages,
            'current' => $paged,
            'format' => '?paged=%#%',
            'show_all' => false,
            'type' => 'plain',
            'end_size' => 4,
            'mid_size' => 1,
            'prev_next' => true,
            'prev_text' => sprintf($leftIcon),
            'next_text' => sprintf($rightIcon),
            'add_args' => false,
            'add_fragment' => '',
        )
    );

    $paginate = $paginate ? str_replace('next', 'next', $paginate):'';
    $html = "";

    if ($paginate) {
        $html .= '<div class="ajax-pagination">';
        $html .= '<nav class="navigation pagination" role="navigation">';
        $html .= '<div class="nav-links">';
        $html .= $paginate;
        $html .= '</div>';
        $html .= '</nav>';
        $html .= '</div>';
    }

    return $html;

}


function main_query_pagination()
{

    global $wp_query, $svgIcon;

    $big = 999999999;

    $rightIcon = useSvg('chevron-right');
    $leftIcon = useSvg('chevron-left');

    $paginate = paginate_links(
        array(
            'base' => str_replace($big, '%#%', html_entity_decode(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'show_all' => false,
            'type' => 'plain',
            'end_size' => 4,
            'mid_size' => 1,
            'prev_next' => true,
            'prev_text' => sprintf($leftIcon),
            'next_text' => sprintf($rightIcon),
            'add_args' => false,
            'add_fragment' => '',
        )
    );

    $paginate = $paginate ? str_replace('next', 'next', $paginate):'';

    $html = "";

    if ($paginate) {
        $html .= '<div class="ajax-pagination">';
        $html .= '<nav class="navigation pagination" role="navigation">';
        $html .= '<div class="nav-links">';
        $html .= $paginate;
        $html .= '</div>';
        $html .= '</nav>';
        $html .= '</div>';
    }
    return $html;
}