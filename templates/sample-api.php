<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Cache-Control: max-age=0, no-cache, no-store');
header('Content-Type: application/json; charset=utf-8');

global $post;

$postID = $_GET['id'];
$getPostBySlugName = false;

if (strpos($postID, ',')) {
  $postID = explode(',', $postID);
} elseif (strpos($postID, '-')) {
  $getPostBySlugName = true;
}

$jsonData          = array();
$queryArgs         = array(
  'post_type'      => 'cpt-special',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC'
);

$query = new WP_Query($queryArgs);
if ($query->have_posts()) {
  while ($query->have_posts()) : $query->the_post();
    $id             = $post->ID;
    $slug           = $post->post_name;
    $fields         = get_fields();
    $fields['id']   = $id;
    $fields['slug'] = $slug;

    if (isset($postID) && gettype($postID) != 'array' && $id == $postID && !$getPostBySlugName) {
      $jsonData = $fields;
    } elseif (isset($postID) && gettype($postID) == 'array' && in_array($id, $postID) && !$getPostBySlugName) {
      $jsonData['specials'][] = $fields;
    } elseif (isset($postID) && $getPostBySlugName && $slug == $postID) {
      $jsonData = $fields;
    } elseif (!isset($postID)) {
      $jsonData['specials'][] = $fields;
    }
  endwhile;
}
wp_reset_query();

if (!isset($postID)) {
  $jsonData['page'] = get_fields();
}

echo json_encode($jsonData);
?>