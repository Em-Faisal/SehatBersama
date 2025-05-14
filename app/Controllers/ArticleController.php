<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfileModel;
use App\Models\KategoriModel;
use App\Models\ArticleModel;

class ArticleController extends BaseController
{
    public function articles()
    {
        // Check login
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Initialize models
        $profileModel = new ProfileModel();
        $articleModel = new ArticleModel();
        $kategoriModel = new KategoriModel();

        // Set entries per page
        $entriesPerPage = 2;

        // Get current page from query string
        $currentPage = $this->request->getVar('page_articles') ?? 1;

        // Get articles with pagination and ordering
        $data['articles'] = $articleModel->orderBy('created_at', 'DESC')
                                       ->paginate($entriesPerPage, 'articles');
        
        // Get pager
        $data['pager'] = $articleModel->pager;
        
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

        $data['profiles'] = $profileModel->find($user_id);
        $data['total'] = $articleModel->countAllResults();

        // Return view with data
        return view('admin/dashboard/articles', $data);
    }

    public function articles_create()
    {
        $model = new ProfileModel();
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('errors', 'Silakan login terlebih dahulu.');
        }
        $kategoriModel = new KategoriModel();
        $categories = $kategoriModel->findAll(); // Mengambil semua data kategori

        return view('admin/dashboard/articles-create', [
            'categories' => $categories,
        ]);

        $profiles = $model->find($user_id);
        if ($profiles) {
            // Kirim data profile ke view
            return view('admin/dashboard/articles-create', ['profiles' => $profiles]);
        } else {
            return redirect()->back()->with('errors', 'Profil tidak ditemukan.');
        }
    }
    
    public function proses_menambahkan_artikel()
    {
        // Load Models
        $articleModel = new ArticleModel();

        // Get user_id from session
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi Input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|max_length[255]',
            'categories_id' => 'required|integer',
            'isi' => 'required',
            'image' => 'uploaded[image]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Upload Gambar
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            $newImageName = $image->getRandomName();
            $image->move('images', $newImageName);
        }

        // Prepare article data
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'categories_id' => $this->request->getPost('categories_id'),
            'isi' => $this->request->getPost('isi'),
            'image' => $newImageName ?? null,
            'slug' => url_title($this->request->getPost('judul'), '-', true),
            'profiles_id' => $user_id  // Add this line to associate article with user
        ];

        // Simpan ke Database
        if (!$articleModel->insert($data)) {
            return redirect()->back()->with('error', 'Gagal menambahkan artikel.');
        }

        return redirect()->to('/dashboard-articles')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function articles_details($id)
    {
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);
        return view('admin/dashboard/articles-details', ['article' => $article]);
    }

    public function articles_edit($id)
    {
        // Check login
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Initialize models
        $articleModel = new ArticleModel();
        $kategoriModel = new KategoriModel();

        // Get article and categories
        $article = $articleModel->find($id);
        $categories = $kategoriModel->findAll();

        if (!$article) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        // Check if the article belongs to the logged-in user
        if ($article['profiles_id'] != $user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke artikel ini.');
        }

        return view('admin/dashboard/articles-edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function proses_edit_artikel($id)
    {
        // Load Models
        $articleModel = new ArticleModel();

        // Get user_id from session
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Get existing article
        $article = $articleModel->find($id);
        if (!$article) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        // Check if the article belongs to the logged-in user
        if ($article['profiles_id'] != $user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke artikel ini.');
        }

        // Validasi Input
        $validation = \Config\Services::validation();
        $rules = [
            'judul' => 'required|max_length[255]',
            'categories_id' => 'required|integer',
            'isi' => 'required'
        ];

        // Add image validation only if a new image is uploaded
        if ($this->request->getFile('image')->isValid()) {
            $rules['image'] = 'uploaded[image]|is_image[image]';
        }

        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Prepare update data
        $data = [
            'judul' => $this->request->getPost('judul'),
            'categories_id' => $this->request->getPost('categories_id'),
            'isi' => $this->request->getPost('isi'),
            'slug' => url_title($this->request->getPost('judul'), '-', true)
        ];

        // Handle image upload if a new image is provided
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            $newImageName = $image->getRandomName();
            $image->move('images', $newImageName);
            $data['image'] = $newImageName;

            // Delete old image if exists
            if ($article['image'] && file_exists('images/' . $article['image'])) {
                unlink('images/' . $article['image']);
            }
        }

        // Update artikel
        if (!$articleModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Gagal mengupdate artikel.');
        }

        return redirect()->to('/dashboard-articles')->with('success', 'Artikel berhasil diupdate.');
    }

    public function articles_delete($id)
    {
        $articleModel = new ArticleModel();
        $articleModel->delete($id);
        return redirect()->to('/dashboard-articles')->with('success', 'Artikel berhasil dihapus.');
    }
}
