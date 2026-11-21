<?php
function get_project_by_id(int $id): array {
    //-->collect data
    $title = get_the_title($id);
    $image_id = carbon_get_post_meta($id, 'image');
    $image = get_media_by_id($image_id);
    $hide_detail_image = (bool) carbon_get_post_meta($id, 'hide_detail_image');
    $lead = carbon_get_post_meta($id, 'lead');
    $description = carbon_get_post_meta($id, 'description');
    $text = carbon_get_post_meta($id, 'text');
    $context = carbon_get_post_meta($id, 'context');
    $role = carbon_get_post_meta($id, 'role');
    $special = carbon_get_post_meta($id, 'special');
    $link = get_permalink($id);

    //-->load project_category
    $project_categories = array_map(function($item) {
        return $item->name;
    }, get_the_terms($id, 'project_category'));


    //-->return data
    return [
        'title' => $title,
        'image' => $image,
        'hide_detail_image' => $hide_detail_image,
        'lead' => $lead,
        'description' => $description,
        'text' => $text,
        'context' => $context,
        'role' => $role,
        'special' => $special,
        'project_categories' => $project_categories,
        'link' => $link

    ];
}