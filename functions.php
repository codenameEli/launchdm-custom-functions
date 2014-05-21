Custom Functions in PHP
<?php

/*  This function will wrap elements in
    whatever you pass to $open and $close
    for every $count. Must be in a while loop
    and have set a counter.

    example: 

    global $post;
    $query_args = array(
        'post_type' => 'client_logos',
        'order' => 'ASC',
        'posts_per_page' => 99
    );
    $custom_query = new WP_Query( $query_args );
    $count = 0;
    while( $custom_query->have_posts() ) :
        $custom_query -> the_post();
        // Variables
        $name = get_the_title();
        $logo = get_the_post_thumbnail();
        $row = '<div class="row"><div class="span1"></div>';
        $end = '<div class="span1"></div></div>';

        wrap_every_nth( $count, 5, $row, $end );
?>
    <div class="clients-logo span2">
        <?php echo $logo; ?>
    </div><!-- .client-logo -->

<?php
        $count++;
        endwhile;
        wp_reset_query();
*/

function wrap_every_nth( $count, $number, $open, $close ) {
    if ( $count === 0 ) {
        echo $open;
    }

    if ( !( $count % $number ) && ( $count !== 0 ) ) {
        echo $close;
        echo $open;
    }
    return;
}

function ldm_skip_link( $url ) {
	// This function outputs a skip link with the last part of the url passed
	// e.g. $url = http://www.example.com/go-here
	// will spit out an anchor tag with the name="go-here"
	$skip_link = '';
	$skip_link .= '<a name="';
	// Split the url @ the / and group them in an array
	$group = explode('/', $url);
	$count = count($group);
	// Get the count and subtract 1 to give you the name for the a tag
	$cut = $count - 1; 
	// Get it out of the array
	$skip_link .= $group[$cut];
	$skip_link .= '" style="left:-100000px; position:absolute; width: 1px; height: 1px; overflow: hidden;"></a>';

	return $skip_link;
}

function ldm_build_dropdown( $output, $selected, $ID ) {
    $dropdown = '';
    if ( $selected ) {
        $dropdown .= '<option selected value="' . $ID . '">';
    } else {
        $dropdown .= '<option value="' . $ID . '">';
    }

    $dropdown .= $output;
    $dropdown .= '</option>';
    return $dropdown;
}

function ldm_wrap_content_block_data( $thumbnail, $title, $content, $read_more_url, $read_more_text ){
    global $ldm_kos_widget_read_more_color_counter;

    if ( !isset( $ldm_kos_widget_read_more_color_counter ) ) {
        $ldm_kos_widget_read_more_color_counter = 0;
    } else {
        $ldm_kos_widget_read_more_color_counter++;
    }

    $block = '';
    $block .= '<div class="span4 content-block content-block-' . $ldm_kos_widget_read_more_color_counter % 3 . '">';
        $block .= '<div class="content-block-thumbnail">' . $thumbnail . '</div>';
        $block .= '<h3 class="content-block-heading">' . $title .'</h3>';
        $block .= '<p class="content-block-content">' . $content . '</p>';
        $block .= '<div class="content-block-button ldm-button"><div class="triangle-bottom"></div><div class="triangle-top"></div>';
        $block .= '<a class="read-more-link" href="' . $read_more_url . '">' . $read_more_text . '</a></div>';
    $block .= '</div><!-- .content-block -->';

    return $block;
}