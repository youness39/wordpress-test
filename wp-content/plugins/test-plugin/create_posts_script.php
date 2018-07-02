<?php

if (isset($_POST["btn_submit"])) {

    // Retreive categories from DB
    $categories = get_categories(
        [
            'hide_empty' => 0,
            'orderby'    => 'id',
            'order'      => 'ASC',
        ]
    );

    foreach($categories as $category) {
        //Skip first/default category
        if($category->term_id == 1) continue;
        //Get category children to check if it's 'marque' or 'modele'
        $children = get_term_children($category->term_id, "category");
        if(count($children) == 0) {
            //Insert associated post in DB
            $post = [
                "post_title" => get_category($category->parent)->name . " - " . $category->name,
                "post_content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam purus neque, vestibulum eu efficitur vitae, egestas ac justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dignissim varius ipsum eget tempus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce quis lorem a justo vulputate vulputate non non magna. Ut at justo aliquam, varius lacus at, ullamcorper purus. Etiam tempor, mi non ultricies porttitor, lacus augue mattis diam, sed pellentesque diam ex eu nulla. Etiam vitae consectetur magna. Vivamus at diam arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In elementum ac turpis ac accumsan",
                "post_category" => [$category->term_id, get_category($category->parent)->term_id],
                "post_status" => "publish",
            ];
            if(!post_exists($post["post_title"])) {
                wp_insert_post($post);
            }
        }
    }
    //Update category count field
    $categories = get_categories(["hide_empty" => 0, "taxonomy" => "category", "fields" => "ids"]);
    wp_update_term_count_now($categories, "category");

    echo "<div class='notice-success notice is-dismissible' style='margin-left: 0;'><p>Articles créés avec succès.</p></div>";
}
