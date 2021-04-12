<?php
namespace Mde\Blog\Model;

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this -> dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this -> dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function comment()
    {
        $db = $this->dbConnect();
        $getComment = $db->prepare('SELECT * FROM comments WHERE id = ?');
        $getComment->execute(array($_GET['id']));
        return $getComment;
    }
    public function editComment()
    {
        $db = $this->dbConnect();
        $affectedComment = $db->prepare('UPDATE comments SET comment = ? WHERE id = ?');
        $affectedComment->execute(array($_POST['comment'],$_GET['id']));
        return $affectedComment;
    }

}