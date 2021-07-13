<?php
    $author_url = get_author_posts_url(get_the_author_meta('ID'));
    $theme_path = get_template_directory_uri() . '/assets/images/tag.svg';
    $tag = '<img src="' . $theme_path . '" alt="" style="widht:20px; height:auto;">' . 'Stichwörter: ';
    $author = get_the_author_meta('display_name');
?>

<div class="blockquote">
    <div class="blockquote-footer">
        <?php
            echo '<a href="' . $author_url . '">';
            echo $author . '</a>';
            echo ' | ';
            the_date();

        ?>
    </div>
</div>

<?php
the_content();
?>

<div>
    <?php
        if(has_tag() ){
            the_tags($tag, ', ');
        }
        
    ?>
</div>

<div class="container bg-light">
    <?php
        comments_template();
    ?>
</div>