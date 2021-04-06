<?php

namespace controller;

use models\PostModel;
use core\DBConnector;
use core\DBDriver;
use core\Validator;

class PostController extends BaseController
{
    public function indexAction()
    {
        $this->title .= '->allPosts();';

        $mPost = new PostModel(
            new DBDriver(DBConnector::getConnect()),
            new Validator()
        );

        $posts = $mPost->getAll();

        $this->content = $this->build(__DIR__ . '/../views/posts.html.php', ['posts' => $posts]);
    }

    public function oneAction()
    {
        $id = $this->request->get('id');

        $mPost = new PostModel(
            new DBDriver(DBConnector::getConnect()),
            new Validator()
        );

        $post = $mPost->getById($id);

        $this->title .= sprintf('->get(%s);', $post['id']);

        $this->content = $this->build(
            __DIR__ . '/../views/post.html.php',
            [
                'title' => $post['title'],
                'content' => $post['text'],
                'lastUpd' => $post['updated_at']
            ]
        );
    }

    public function addAction()
    {
        $this->title .= '::добавить пост';
        if ($this->request->isPost()) {
            $mPost = new PostModel(
                new DBDriver(DBConnector::getConnect()),
                new Validator()
            );
            
            $id = $mPost->add([
                'title' => $this->request->post('title'),
                'preview' => $this->request->post('preview'),
                'text' => $this->request->post('text')
            ]);

            $this->redirect(sprintf('/post/%s', $id));
        }

        $this->content = 'Форма ввода полей для статьи';
    }
}