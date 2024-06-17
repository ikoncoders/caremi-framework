<?php 
namespace App\Http\Controllers;

use App\Widget\Widget;
use Caremi\Http\Response;

class HomeController 
{
    public function __construct(private Widget $widget)
    {
    }
    
    public function index(): Response
    {
        $content = "<h1>Hello {$this->widget->name}</h1>";

        return new Response($content);
    }

    public function show(int $id): Response
    {
        $content = "This is post $id";

        return new Response($content);
    }
}