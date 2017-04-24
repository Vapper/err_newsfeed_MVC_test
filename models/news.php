<?php
class Post {
    
    public $id;
    public $title;
    public $description;
    public $link;
    public $published;
    

    public function __construct($id, $title, $description,$link,$published) {
        $this->id      = $id;
        $this->title  = $title;
        $this->description = $description;
        $this->link = $link;
        $this->published = $published;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM news LIMIT 10');
        
        foreach($req->fetchAll() as $post) {
            $list[] = new Post($post['id'], $post['title'], $post['description'],$post['link'],$post['published']);
        }

        return $list;
    }

    public static function find($id) {
        $db = Db::getInstance();
        
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM news WHERE id = :id');
        $req->execute(array('id' => $id));
        $post = $req->fetch();
        if(!$post){
            //Siia peaks parema lõpplahenduse lisama
            die();
        }

        return new Post($post['id'], $post['title'], $post['description'],$post['link'],$post['published']);
    }
    
    public static function fetchRSS()
    {

        require("caching.php");
        
        
        $arrFeeds = array();
        foreach ($doc->getElementsByTagName('item') as $node) {
            $itemRSS = array(
                'title' => $node->getElementsByTagName('title')
                    ->item(0)->childNodes->item(0)->nodeValue,
                'description' => $node->getElementsByTagName('description')
                    ->item(0)->childNodes->item(0)->nodeValue,
                'link' => $node->getElementsByTagName('link')
                    ->item(0)->childNodes->item(0)->nodeValue,
                'published' => $node->getElementsByTagName('pubDate')
                    ->item(0)->childNodes->item(0)->nodeValue
            );
            array_push($arrFeeds, $itemRSS);
        }

        return $arrFeeds;
    }
        
    public static function saveToDB($arrayFeed){   

        $db = Db::getInstance();

        $req = $db->prepare('TRUNCATE TABLE news');
        $req->execute();

        $req = $db->prepare('INSERT INTO news (title, description, link, published) VALUES (:title, :description, :link, :published)');
        $req->bindParam(":title",$title);
        $req->bindParam(":description",$description);
        $req->bindParam(":link",$link);
        $req->bindParam(":published",$published);
        
        foreach( $arrayFeed as $RssItem){
            $title = $RssItem["title"];
            $description = $RssItem["description"];
            $link = $RssItem["link"];
            $published = $RssItem["published"];

            $req->execute();
        }
    }
}
?>