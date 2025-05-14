<?php

namespace App\Controllers;
use App\Models\ProfileModel;
use App\Models\ArticleModel;
use App\Models\KategoriModel;
use App\Models\CommentModel;

class Home extends BaseController
{
    public function index()
    {
        // Initialize models
        $profileModel = new ProfileModel();
        $articleModel = new ArticleModel();
        $kategoriModel = new KategoriModel();

        // Set entries per page
        $entriesPerPage = 5;

        // Get search query and current page
        $search = $this->request->getGet('search');
        $currentPage = $this->request->getVar('page_articles') ?? 1;

        // Build query
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

        $data = [
            'profiles' => $profileModel->findAll(),
            'articles' => $articles,
            'pager' => $articleModel->pager,
            'search' => $search,
            'total' => $articleModel->countAllResults()
        ];

        return view('index', $data);
    }

    public function details($slug)
    {
        // Initialize models
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

        return view('details', [
            'article' => $article,
            'comments' => $comments,
            'is_logged_in' => session()->get('user_id') ? true : false,
            'search' => $this->request->getGet('search')
        ]);
    }
}
