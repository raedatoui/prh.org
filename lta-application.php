<?php
/**
 * Template name: LTA Application
 */

get_header(); ?>

<?php $post_type = get_post_type();
$pt_object = get_post_type_object($post_type);
$pt_label = $pt_object->labels->singular_name;
$date_format = get_option( 'date_format' );
the_post();
?>

    <section class="hero article-hero module" id="hero">

        <div class="content">
            <div class="row">
                <header class="col-xs-12 col-md-8">

                    <footer class="post-meta">
                        <time class="post-date utility-copy"><?php the_date( $date_format ); ?></time>
                    </footer>

                    <h1><?php the_title(); ?></h1>

                    <?php
                    $intro = get_the_excerpt();
                    if ( !is_generated( $intro ) ) {
                        echo '<p>' . sanitize_text_field($intro) . '</p>';
                    } ?>
                </header>
            </div>
        </div>

    </section>

    <main class="module" id="main">
        <div class="content">
            <div class="row row-top">
                <article class="main-content post-content col-xs-12">

                    <div class="post-body">
                        <?php the_content(); ?>
                    </div>


                    <?php
                    $byline_enabled = get_field( 'article_details_enabled');
                    if ( $byline_enabled ) : ?>

                        <footer class="post-byline">
                            <?php the_field( 'post_byline' ); ?>
                        </footer>

                    <?php endif; ?>

                </article>


            </div>

        </div>
    </main>


<?php
get_footer();
