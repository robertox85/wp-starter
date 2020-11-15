<?php

/**
 * ************* FRONTEND HOOK *****************
 */

// Remove Admin bar
function remove_admin_bar()
{
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        if (in_array('subscriber', (array) $user->roles)) {
            return false;
        }
        return true;
    }
}



// wraps every iframe up with a specific class 'embed-container'
function add_iframe_wrapper($html, $url, $attr, $post_ID)
{
    if (
        strpos($url, 'youtube.com') !== false ||
        strpos($url, 'youtu.be') !== false ||
        strpos($url, 'facebook.com') !== false ||
        strpos($url, 'twitter.com') !== false ||
        strpos($url, 'imgur.com') !== false ||
        strpos($url, 'vimeo.com') !== false
    ) {
        /*  YOU CAN CHANGE RESULT HTML CODE HERE */
        $html = '<div class="embed-container">' . $html . '</div>';
    }
    return $html;
}



// wraps every iframe up with a specific class 'embed-container'
function remove_attachment_captions($content)
{
    // Removes wp-caption
    preg_match_all('/\[caption id="attachment_.*?" align=".*" width=".*?"\]<img (.*?)>(.*?)\[\/caption\]/', $content, $matches);

    foreach ($matches[0] as $key => $snippet) {
        $replace = '<img ' . $matches[1][$key] . '><div class="img-caption">' . $matches[2][$key] . '</div>';
        $content = str_replace($snippet, $replace, $content);
    }

    return $content;
}


// Remove 'text/css' from our enqueued stylesheet
function style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}


// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', '', $html);

    return $html;
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;

    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? [] : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}



/**
 * ************* BACKEND HOOK *****************
 */

// Function to change email address
function wpb_sender_email($original_email_address)
{
    return WP_EMAIL;
}
// Function to change sender name
function wpb_sender_name($original_email_from)
{
    return 'Newstreet';
}
// email notification filter
function set_content_type($content_type)
{
    return 'text/html';
}

function add_image_responsive_class($content)
{
    global $post;
    $pattern = "/<img(.*?)class=\"(.*?)\"(.*?)>/i";
    $replacement = '<img$1class="$2 img-responsive content-image"$3>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}