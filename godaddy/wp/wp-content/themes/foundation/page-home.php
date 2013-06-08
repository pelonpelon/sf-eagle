<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package foundation
 */

get_header( 'home' ); ?>

<div id="mast">

        <div id="logo" class="logo"><img src="/godaddy/pics/logo-lite.gif" alt="Eagle logo" /></div>

        <nav id="site-navigation" class="navigation-main" role="navigation">
                <h1 class="menu-toggle"><?php _e( 'Menu', 'foundation' ); ?></h1>
                <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'foundation' ); ?>"><?php _e( 'Skip to content', 'foundation' ); ?></a></div>
                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav><!-- #site-navigation -->

        <?php get_sidebar(); ?>

</div> 

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'page' ); ?>

            <?php endwhile; // end of the loop. ?>
    </div><!-- #content -->
</div><!-- #primary -->
       
<div id="tertiary" class="info-area">
    <h1>Hello! How are you doing, my dudies?</h1>
</div><!-- tertiary -->

<?php get_footer(); ?>
