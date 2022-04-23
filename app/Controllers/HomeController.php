<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\UserRepository;
use MamadouAlySy\SimpleFramework\Controller;
use MamadouAlySy\SimpleFramework\FormBuilder\FormBuilder;
use MamadouAlySy\SimpleFramework\FormBuilder\Type\TextType;
use MamadouAlySy\SimpleFramework\Http\Response;

class HomeController extends Controller
{
    public function index(UserRepository $repo): Response
    {
        return $this->render('home.index');
    }
}