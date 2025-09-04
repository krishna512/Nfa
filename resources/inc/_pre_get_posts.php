<?php


// set posts_per_page for post

function filter_main_query($query)
{
	/**
	 * =========================================
	 * resource
	 * =========================================
	 */
	if (!is_admin() && $query->is_main_query() && is_post_type_archive('resource')) {
		// post per pagination
		$post_per_page = 12;
		$query->set('posts_per_page', $post_per_page);

		// order
		$query->set('orderby', 'meta_value');
		$query->set('meta_key', 'published_date');
		$query->set('order', 'DESC');

		// get url parameters
		$_GET_country = (isset($_GET["search_country"])) ? $_GET["search_country"] : '';
		$_GET_category = (isset($_GET["resource_category"])) ? $_GET["resource_category"] : '';
		$_GET_search_resource = (isset($_GET["search_resource"])) ? $_GET["search_resource"] : '';

		if ($_GET_search_resource) {
			$query->set('s', $_GET_search_resource);
		}

		// tax query
		$tax_query = array(
			'relation' => 'AND',
		);
		if ($_GET_country) {
			$tax_query[] = array(
				'taxonomy' => 'country',
				'field' => 'slug',
				'terms' => $_GET_country,
			);
		}
		if ($_GET_category) {
			$tax_query[] = array(
				'taxonomy' => 'resource-category',
				'field' => 'slug',
				'terms' => $_GET_category,
			);
		}


		if ($_GET_category || $_GET_country) {
			$query->set('tax_query', $tax_query);
		}


		return;
	}

	/**
	 * =========================================
	 * event
	 * =========================================
	 */
	if (!is_admin() && $query->is_main_query() && is_post_type_archive('event')) {
		// post per pagination
		$post_per_page = 1;
		$query->set('posts_per_page', $post_per_page);

		return;
	}
}

add_action('pre_get_posts', 'filter_main_query', 11);



// ============================
// Change request using hook
// ============================
function nfa_rewrite_request($query)
{
	if (isset($query['post_type'])) {
		if ($query['post_type'] === 'event') {
			if (isset($query['event'])) {
				if ($query['event'] === 'past' || $query['event'] === 'upcoming') {
					$query['type'] = $query['event'];
					unset($query['event']);
					unset($query['name']);
				}
			}
		}
	}
	return $query;
}
add_filter('request', 'nfa_rewrite_request', 9999, 1);
