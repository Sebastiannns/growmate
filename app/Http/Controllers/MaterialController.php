<?php

// Controller: MaterialController — handle materi belajar (Materi belajar.png)
namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Tampilkan daftar materi
    public function index()
    {
        $materials = Material::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $categories = Material::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('material.index', compact('materials', 'categories'));
    }

    // Filter materi berdasarkan kategori
    public function category(string $category)
    {
        $materials = Material::with('user')
            ->where('category', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $categories = Material::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('material.index', compact('materials', 'categories', 'category'));
    }
}
