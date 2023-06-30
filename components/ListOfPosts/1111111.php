In WordPress, I have written the following php code that writes the list of posts and writes its category at the top of each category of posts:

<!-- sidebar.php -->
<div class="side-widget m-3">
    <h3>Post title</h3>
    <hr style="height: 3px">
</div>

<?php
$current_id = get_the_ID();
$args3 = array(
// 'p' => 6685,
    'post_type' => 'post',
    'orderby' => 'ID',
    'order' => 'DESC',
    'post_status' => 'publish',
    'posts_per_page' => -1 // this will retrieve all the posts that are published
);

// The Query
$query = new WP_Query($args3);
$rt_all = [];
// The Loop
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();


        $rt_post = [];
        foreach (get_the_category() as $fff) {
            $rt_post[] = $fff->name;
        }
        $rt_new = array_diff($rt_post, $rt_all);

        $rt_all = array_merge($rt_all, $rt_new);


        if (empty($rt_post)) {

            ?>

            <li style=" margin-top: 5px; list-style-type: none; ">
                <a id="alltitle"
                   href="<?php the_permalink() ?>"
                    <?php
                    $post = get_post();
                    echo($post->ID == $current_id && is_single() ?
                        'class="list-group"'
                        : '');
                    ?>
                >
                    <?php the_title(); ?>
                </a>
            </li>

            <?php
        }
        ?>
        <?php // start accordion div. saeed doc.
        foreach ($rt_new as $term) {
// echo $term->name;

            $args1 = array(
                'orderby' => 'ID',
                'order' => 'ASC',
                'posts_per_page' => -1, //show all posts
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $term,

                    )
                )

            );

// The Query
            $posts1 = new WP_Query($args1);

// The Loop
            if ($posts1->have_posts()) {
                ?>

                <h5 class="cat-title bg-info"><?php echo $term; ?></h5>


                <div class="cat-content"><?php
                    while ($posts1->have_posts()) {
                        $posts1->the_post();

                        ?>
                        <li style=" margin-top: 5px; list-style-type: none; ">
                            <a id="alltitle"
                               href="<?php the_permalink() ?>"
                                <?php
                                $post = get_post();
                                echo($post->ID == $current_id && is_single() ?
                                    'class="list-group"'
                                    : '');
                                ?>
                            >
                                <?php the_title(); ?>
                            </a>
                        </li>
                        <?php

                    }
                    ?></div>

                <?php
            }

            // Restore original post data
            wp_reset_postdata();
        }
        ?>

        <?php // end of accordion div. saeed doc.
    }
}
// Restore original post data
wp_reset_postdata();

?>

Now I have written a program with nuxt 3 that takes the content from the wordpress api and I want to have the list of posts along with their categories like the code above.
Please convert the above code to nuxt 3 code.