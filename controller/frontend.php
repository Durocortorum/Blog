<?php
//chargement des classes

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new \Mde\Blog\Model\PostManager(); // création d'un objet
    $posts = $postManager->getPosts();// Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \Mde\Blog\Model\PostManager();
    $commentManager = new \Mde\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \Mde\Blog\Model\commentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function getComment()
{
    $commentManager = new Mde\Blog\Model\CommentManager();
    $comment = $commentManager->comment();

    require ('view/frontend/editCommentView.php');
}

function editComment()
{
    $commmentManager = new Mde\Blog\Model\CommentManager();

    $affectedComment = $commmentManager->editComment();
    if ($affectedComment == false)
    {
        throw new Exception('Impossible de modifier le commentaire !');
    }else{
        header('Location: index.php?action=comment&id=' . $_GET['id']);
    }
}
