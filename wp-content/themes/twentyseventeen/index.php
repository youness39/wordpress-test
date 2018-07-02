<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <?php
                //Get the page number
                if (get_query_var('paged')) {
                    $paged = get_query_var('paged');
                } else if (get_query_var('page')) {
                    $paged = get_query_var('page');
                } else {
                    $paged = 1;
                }
                //Get the first category ID
                $first_cat_id = get_cat_ID("Marques auto");
                //Get all category children
                $args = [
                    "child_of" => $first_cat_id,
                    "parent" => 2,
                ];
                $all_categories = get_categories($args);
                //Parameters for pagination
                $per_page = 5;
                $max_num_pages = count($all_categories) % $per_page == 0 ? count($all_categories) / $per_page : (count($all_categories) / $per_page) + 1;
                $paged_offset = ($paged - 1) * $per_page;
                //Get category children per page
                $paginate = array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'number' => $per_page,
                    'paged' => $paged,
                    'offset' => $paged_offset,
                    'child_of' => $first_cat_id,
                    'parent' => 2,
                );
                $categories = get_categories($paginate);
                //List categories and the last associated posts
                foreach ($categories as $category) {
                    $children = get_term_children($category->term_id, "category");
                    if (count($children)) {
                        ?>
                        <h2><?= $category->name; ?></h2>
                        <hr/>
                        <div class="row">
                            <?php
                            query_posts(["cat" => $category->term_id, "posts_per_page" => 4, "orderby" => "date", "order" => "DESC"]);
                            if (have_posts()) : while (have_posts()) : the_post();
                                ?>
                                <div class="col-sm-6">
                                    <h3><?php the_title(); ?></h3>
                                    <small><?= get_the_date('d-m-Y'); ?></small>
                                    <p class="text-justify"><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Lire plus</a>
                                </div>
                            <?php
                            endwhile;
                            endif;
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
                <!-- Pagination links -->
                <div class="row">
                    <div class="alignleft"
                         style="margin-top: 30px;"><?php previous_posts_link('&laquo; Précedent') ?></div>
                    <div class="alignright"
                         style="margin-top: 30px;"><?php next_posts_link('Suivant &raquo;', $max_num_pages) ?></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4"><?php get_sidebar(); ?></div>
        </div>
    </div>

<?php get_footer();
