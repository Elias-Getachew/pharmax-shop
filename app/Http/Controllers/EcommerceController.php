<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index(Request $request)
    {
        
           $medicines = Medicine::where('expiry_date', '>', now())->paginate(6);
     
 $categories = Category::with(['medicines' => function($query) {
        $query->where('expiry_date', '>', now())->take(4); // Limit to 4 medicines per category
    }])->latest()->paginate(3);

        return view('ecommerce.index', compact('medicines', 'categories'));
    }

 public function show(Category $category)
    {
        return view('ecommerce.category.show', compact('category'));
    }
    

 public function shop(Request $request)
    {
        //   $categories = Category::latest()->paginate(3);
        $allCategories =Category::all();
          $query = Medicine::query();

    if ($request->query('category')) {
        $categoryId = $request->query('category');
        $query->where('category_id', $categoryId);
    }

    if ($request->query('sort')) {
        if ($request->query('sort') == 'ascPrice') {
            $query->orderBy('price', 'asc');
        } elseif ($request->query('sort') == 'descPrice') {
            $query->orderBy('price', 'desc');
        }
    }

    $medicines = $query->get(); // Paginate results

          if ($request->ajax()) {
            return view('ecommerce.partials.medicines', compact('medicines'))->render();
        }
        return view('ecommerce.shop.index',compact('medicines', 'allCategories'));
    }

 
 public function about(Category $category)
    {
        return view('ecommerce.components.aboutus');
    }

    
}