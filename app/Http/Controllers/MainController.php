<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\Menus\MenuService;
use App\Http\Services\Publishers\PublisherService;
use App\Http\Services\Authors\AuthorService;
use App\Http\Services\Books\BookService;

class MainController extends Controller
{
    protected $menuService;
    protected $publisherService;
    protected $authorService;
    protected $bookService;

    public function __construct(MenuService $menuService, PublisherService $publisherService, AuthorService $authorService, BookService $bookService)
    {
        $this->menuService = $menuService;
        $this->publisherService = $publisherService;
        $this->authorService = $authorService;
        $this->bookService = $bookService;
    }

    public function index()
    {
        return view('user.home', [
            'title' => 'Book Website',
            'menus' => $this->menuService->show(),
            'menus_parent_id' => $this->menuService->showParentId(),
            'publishers' => $this->publisherService->show(),
            'authors' => $this->authorService->show(),
            'books' => $this->bookService->getAll()
        ]);
    }

    public function contact()
    {
        return view('user.contact', [
            'title' => 'Liên hệ',
            'menus' => $this->menuService->show(),
            'publishers' => $this->publisherService->show()
        ]);
    }

    public function about()
    {
        return view('user.about', [
            'title' => 'Giới thiệu',
            'menus' => $this->menuService->show(),
            'publishers' => $this->publisherService->show()
        ]);
    }
}
