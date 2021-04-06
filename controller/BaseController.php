<?php
namespace controller;
use core\Request;

class BaseController
{
    protected $title;
    protected $content;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->title = 'Php2';
		$this->content = '';
    }

    public function render()
    {
        echo $this->build(
            __DIR__ . '/../views/main.html.php',
            [
                'title' => $this->title,
                'content' => $this->content
            ]
        );
    }

    protected function redirect($uri)
	{
		header(sprintf('Location: %s', $uri));
		die();
	}

    protected function build($template, array $params = [])
	{
		ob_start();
		extract($params);
		include_once $template;

		return ob_get_clean();
	}
}