<?php

namespace MVC\Http\Response;

use MVC\Http\HTTPStatus;

class JsonResponse extends Response
{

	public function __construct(string $content = "", ?string $uri = null, array $headers = [], $status = HTTPStatus::OK)
	{
		parent::__construct($content, $uri, $status, $headers);
		$this->headers->set('Content-Type', 'application/json');
	}

	public function setContent(array|string $content): Response
	{
		if(is_array($content)) $this->content = json_encode($content);
		if(is_string($content)) $this->content = $content;
		return $this;
	}

}