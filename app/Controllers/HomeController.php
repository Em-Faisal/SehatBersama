<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfileModel;
use App\Models\ArticleModel;
use App\Models\KategoriModel;
use App\Models\CommentModel;

class HomeController extends BaseController
{
    public function index()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('errors', 'Silakan login terlebih dahulu.');
        }

        // Initialize models
        $profileModel = new ProfileModel();
        $articleModel = new ArticleModel();
        $kategoriModel = new KategoriModel();

        // Set entries per page
        $entriesPerPage = 5;

        // Get search query and current page
        $search = $this->request->getGet('search');
        $currentPage = $this->request->getVar('page_articles') ?? 1;

        // Apply search if exists
        if ($search) {
            $articles = $articleModel->like('judul', $search)
                                   ->orLike('isi', $search)
                                   ->orderBy('created_at', 'DESC')
                                   ->paginate($entriesPerPage, 'articles');
        } else {
            $articles = $articleModel->orderBy('created_at', 'DESC')
                                   ->paginate($entriesPerPage, 'articles');
        }

        // Get categories and create lookup array
        $categories = $kategoriModel->findAll();
        $categoryLookup = [];
        foreach ($categories as $category) {
            $categoryLookup[$category['id']] = $category['name'];
        }
        
        // Add category names to articles
        foreach ($articles as &$article) {
            $article['category_name'] = $categoryLookup[$article['categories_id']] ?? 'Tidak ada kategori';
        }

        $data['profiles'] = $profileModel->find($user_id);
        $data['articles'] = $articles;
        $data['pager'] = $articleModel->pager;
        $data['search'] = $search;
        $data['total'] = $articleModel->countAllResults();

        return view('home/index', $data);
    }

    public function details($slug)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('errors', 'Silakan login terlebih dahulu.');
        }

        // Initialize models
        $profileModel = new ProfileModel();
        $articleModel = new ArticleModel();
        $kategoriModel = new KategoriModel();
        $commentModel = new CommentModel();

        // Get article by slug
        $article = $articleModel->where('slug', $slug)->first();
        
        if (!$article) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        // Get category name
        $category = $kategoriModel->find($article['categories_id']);
        $article['category_name'] = $category ? $category['name'] : 'Tidak ada kategori';

        // Get comments with user information
        $comments = $commentModel->select('comments.*, profiles.nama_lengkap, profiles.photo')
                               ->join('profiles', 'profiles.id = comments.user_id')
                               ->where('article_id', $article['id'])
                               ->orderBy('created_at', 'DESC')
                               ->findAll();

        $data = [
            'profiles' => $profileModel->find($user_id),
            'article' => $article,
            'comments' => $comments
        ];

        return view('home/details', $data);
    }

    public function kategori()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('errors', 'Silakan login terlebih dahulu untuk menggunakan fitur ini.');
        }

        // Initialize models
        $profileModel = new ProfileModel();
        $kategoriModel = new KategoriModel();

        $data = [
            'profiles' => $profileModel->find($user_id),
            'categories' => $kategoriModel->findAll()
        ];

        return view('home/kategori', $data);
    }

    public function kategori_details($slug)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('errors', 'Silakan login terlebih dahulu untuk menggunakan fitur ini.');
        }

        // Initialize models
        $profileModel = new ProfileModel();
        $articleModel = new ArticleModel();
        $kategoriModel = new KategoriModel();

        // Get category by slug
        $category = $kategoriModel->where('slug', $slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }
        

        // Get search query and entries per page
        $search = $this->request->getGet('search');
        $page = $this->request->getGet('page_articles') ?? 1;
        $entriesPerPage = 6; // Default entries per page

        // Build base query with ordering
        $articlesQuery = $articleModel->where('categories_id', $category['id'])
                                    ->orderBy('created_at', 'DESC');
        
        // Apply search if exists
        if ($search) {
            $articlesQuery->groupStart()
                         ->like('judul', $search)
                         ->orLike('isi', $search)
                         ->groupEnd();
        }

        // Get total before pagination
        $total = $articlesQuery->countAllResults(false);

        // Get paginated articles
        $articles = $articlesQuery->paginate($entriesPerPage, 'articles');

        // Prepare data for view
        $data = [
            'profiles' => $profileModel->find($user_id),
            'category' => $category,
            'articles' => $articles,
            'pager' => $articleModel->pager,
            'search' => $search,
            'total' => $total,
            'current_page' => $page
        ];
        // Get categories and create lookup array
        $categories = $kategoriModel->findAll();
        $categoryLookup = [];
        foreach ($categories as $category) {
            $categoryLookup[$category['id']] = $category['name'];
        }
        
        // Add category names to articles
        foreach ($data['articles'] as &$article) {
            $article['category_name'] = $categoryLookup[$article['categories_id']] ?? 'Tidak ada kategori';
        }

        return view('home/kategori_details', $data);
    }

    public function add_comment()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('errors', 'Silakan login terlebih dahulu.');
        }

        $commentModel = new CommentModel();
        $data = [
            'article_id' => $this->request->getPost('article_id'),
            'user_id' => $user_id,
            'comment' => $this->request->getPost('comment')
        ];

        if ($commentModel->insert($data)) {
            return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan komentar');
    }
}
