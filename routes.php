<?php
function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
        case 'pages':
            $controller = new PagesController();
            break;
        case 'news':
            require_once('models/news.php');
            $controller = new NewsController();
            break;
    }

    $controller->{ $action }();
}

$controllers = array('pages' => ['home', 'error'],
    'news' => ['index', 'show']);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}
?>