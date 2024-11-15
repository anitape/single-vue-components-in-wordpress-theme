    <?php get_header();?>


    <div class="rectangle"></div>
    <div class="team-container">
        <div class="row main-recipes-container d-flex flex-md-nowrap">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12">
                <div class="row d-flex flex-row flex-wrap align-content-stretch row-gap">
                    <?php
                        $current_category = get_queried_object(); ////getting current category
                        $args = array(
                            'post_type' => 'food_recipes',
                            'posts_per_page' => 2,
                            'offset' => 1,
                            'orderby' => 'post_date',
                            'order' => 'DESC'
                        );
                        $the_query = new WP_Query($args);
                        if($the_query->have_posts()):
                            while($the_query->have_posts()): $the_query->the_post();
                                $intro_text = get_field('intro_text');
                    ?>

                    <div class="col-md-12 col-sm-12">
                        <a href="<?php the_permalink(); ?>" class="recipe-card">
                            <img class="img-fluid recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">
                            <div class="my-3">
                                <p class="highlight-text"><?php the_field('recipe_label'); ?>
                                    <span class="line-separator"></span><?php echo get_the_date( 'F j, Y' ); ?>
                                </p>
                                <h4><?php the_title(); ?></h4>
                            </div>
                        </a>
                    </div>

                    <?php
                        endwhile;
                        endif;
                    ?>
                </div>
            </div>
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-12 d-flex align-items-stretch">
                <div class="row">
                    <?php
                $current_category = get_queried_object(); ////getting current category
                $args = array(
                    'post_type' => 'food_recipes', // post type,
                    'posts_per_page' => 1, 
                    'orderby' => 'post_date',
                    'order' => 'DESC'
                );
                $the_query = new WP_Query($args);
                if($the_query->have_posts()):
                    while($the_query->have_posts()): $the_query->the_post();
                        $intro_text = get_field('intro_text');
                ?>
                    <a href="<?php the_permalink(); ?>" class="recipe-card">
                        <img class="img-fluid main-recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">
                        <div class="my-3">
                            <p class="highlight-text main-recipe-highlight-text">
                                <?php the_field('recipe_label'); ?>
                                <span
                                    class="line-separator line-separator-xl"></span><?php echo get_the_date( 'F j, Y' ); ?>
                            </p>
                            <h3 class="main-recipe-title "><?php the_title(); ?></h3>
                            <p class="front-intro-text"><?php the_field('intro_text'); ?></p>
                        </div>
                    </a>
                <?php
                    endwhile;
                    endif;
                ?>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12">
                <div class="row d-flex flex-row flex-wrap align-content-stretch row-gap">
                    <?php
                        $current_category = get_queried_object(); ////getting current category
                        $args = array(
                            'post_type' => 'food_recipes',
                            'posts_per_page' => 2,
                            'offset' => 3,
                            'orderby' => 'post_date',
                            'order' => 'DESC'
                        );
                        $the_query = new WP_Query($args);
                        if($the_query->have_posts()):
                            while($the_query->have_posts()): $the_query->the_post();
                                $intro_text = get_field('intro_text');
                    ?>

                    <div class="col-md-12 col-sm-12">
                        <a href="<?php the_permalink(); ?>" class="recipe-card">
                            <img class="img-fluid recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">
                            <div class="my-3">
                                <p class="highlight-text"><?php the_field('recipe_label'); ?>
                                    <span class="line-separator"></span><?php echo get_the_date( 'F j, Y' ); ?>
                                </p>
                                <h4><?php the_title(); ?></h4>
                            </div>
                        </a>
                    </div>

                    <?php
                        endwhile;
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>

            <?php wp_footer(); ?>
            <?php get_footer(); ?>