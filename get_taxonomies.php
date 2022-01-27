 <?php 
 
// Get custom taxonomies and posts 
// Get terms -> parent terms 
// Get terms_parent -> child terms
// Get posts of child terms  
 ?>
<?php    
    $taxonomy = 'staff_categories';
    $postType = 'staff';
    $terms = get_terms(['taxonomy' => $taxonomy, 'orderby' => 'term_id', 'parent' => 0, 'hide_empty' => false]);
?>
<div class="">
<?php
    foreach($terms as $term){
        echo '<h3 style="color:green">' . $term->name . '</h3>';
        $childTerms = get_terms(['taxonomy' => $taxonomy, 'orderby' => 'term_id', 'parent' => $term->term_id, 'hide_empty' => false]);

        foreach($childTerms as $childTerm)
        {
            $posts = get_posts(
                array('post_status' =>'publish','post_type' => $postType,
                    
                    'tax_query' => array(
                        array(
                        'taxonomy' => 'staff_categories',
                        'field' => 'term_id',
                        'terms' =>$childTerm->term_id,
                            )
                        )
                ));
            ?>
            <div class=" ">
                <h3 style="color:red"><?php echo $childTerm->name ?></h3>
                <div class=" ">
                    <?php foreach($posts as $post){ ?>
                        <h5 style="color:yellow"><?php echo $post->post_title ?></h5>
                        <div class="">
                            <?php echo get_the_content($post->ID) ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }
?>
</div>  
 