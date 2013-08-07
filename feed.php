<?php

// This is the composer autoloader. Used by
// the markdown parser and RSS feed builder.
require 'blog/vendor/autoload.php';

// Explicitly including the dispatch framework,
// and our functions.php file
require 'blog/app/includes/dispatch.php';
// Load the configuration file
config('source', 'blog/app/config.ini');


// Return an array of posts.
// Can return a subset of the results
function get_posts($page = 1, $perpage = 0){

    if($perpage == 0){
        $perpage = config('posts.perpage');
    }

    $posts = get_post_names();

    // Extract a specific page with results
    $posts = array_slice($posts, ($page-1) * $perpage, $perpage);

    $tmp = array();

    // Create a new instance of the markdown parser
    $md = new MarkdownParser();

    foreach($posts as $k=>$v){

        $post = new stdClass;

        // Extract the date
        $arr = explode('_', $v);
        $post->date = strtotime(str_replace('blog/posts/','',$arr[0]));

        // The post URL
        $post->url = site_url().date('Y/m', $post->date).'/'.str_replace('.md','',$arr[1]);

        // Get the contents and convert it to HTML
        $content = $md->transformMarkdown(file_get_contents($v));

        // Extract the title and body
        $arr = explode('</h1>', $content);
        $post->title = str_replace('<h1>','',$arr[0]);
        $post->body = $arr[1];

        $tmp[] = $post;
    }

    return $tmp;
}

?>