<?php $title = 'Modification du Commentaires'; ?>
 <?php ob_start(); ?>
<?php $comment = $comment->fetch(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php?action=post&amp;id=<?= $comment['post_id'] ?>">Retour à la liste des billets</a></p>
    <h2>Editer le commentaire</h2>
    <form method="post" action="index.php?action=editComment&amp;id=<?= $comment['id'] ?>"><br/>
        <label for="comment">Editer le commentaires</label><br/>
        <textarea name="comment"><?= $comment['comment'] ?></textarea><br/></br>
        <button type="submit">Valider!</button>
    </form>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>