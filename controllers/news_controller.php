<?php
class NewsController{
    public function index()
    {
        $list=Post::fetchRSS();
        Post::saveToDB($list);
        $posts = Post::all();
        require_once('views/news/index.php');
    }

    public function show() {
        // expected url of form ?controller=posts&action=show&id=x
        if (!isset($_GET['id']))
            return call('pages', 'error');
        
        $post = Post::find($_GET['id']);
        require_once('views/news/extra.php');
    }
}
?>