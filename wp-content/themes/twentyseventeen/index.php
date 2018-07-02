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
                $first_cat_id = get_cat_ID("Marques auto");
                $categories_id = get_term_children($first_cat_id, "category");
                foreach ($categories_id as $category_id) {
                    $children = get_term_children($category_id, "category");
                    if (count($children)) {
                        $category = get_category($category_id);
                        ?>
                        <h2><?= $category->name; ?></h2><hr/>
                        <div class="row">
                            <?php
                            query_posts(["cat" => $category->term_id, "posts_per_page" => 4, "orderby" => "ID", "order" => "DESC"]);
                            if (have_posts()) : while (have_posts()) : the_post();
                                ?>
                                <div class="col-sm-6">
                                    <h3><?php the_title(); ?></h3>
                                    <small><?= get_the_date( 'd-m-Y' ) ;?></small>
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
            </div>
            <div class="col-xs-12 col-sm-4"></div>
        </div>
    </div>

<?php get_footer();
