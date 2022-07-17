<?php
namespace App\Http\Services\Books;

use App\Models\Book;
use App\Models\Menu;
use App\Models\Publisher;
use App\Models\Author;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class BookService
{
    // Hỗ trợ hàm create
    public function getMenu()
    {
        // return Menu::where('menu_active', 1)->where('menu_parent_id', '!=', 0)->get();

        return Menu::where('menu_active', 1)->get();
    }

    public function getPublisher()
    {
        return Publisher::where('publisher_active', 1)->get();
    }

    public function getAuthor()
    {
        return Author::where('author_active', 1)->get();
    }

    // Hàm kiểm tra giá gốc >= giá giảm
    protected function isValidPrice($request) {
        if ($request->input('book_price') != 0 && $request->input('book_price_sale') != 0 
        && $request->input('book_price_sale') >= $request->input('book_price')) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('book_price_sale') != 0 && (int)$request->input('book_price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $data = array();
            $data['book_name'] = $request->book_name;
            $data['book_description'] = $request->book_description;
            
            $data['book_format'] = $request->book_format;
            $data['book_pages'] = $request->book_pages;
            $data['book_weight'] = $request->book_weight;
            $data['book_publishing_year'] = $request->book_publishing_year;
    
            $data['book_price'] = $request->book_price;
            $data['book_price_sale'] = $request->book_price_sale;
    
            $data['menu_id'] = $request->menu_id;
            $data['publisher_id'] = $request->publisher_id;
            $data['author_id'] = $request->author_id;
    
            $data['book_active'] = $request->book_active;
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $get_thumb = $request->file('book_thumb');
    
            $get_name_thumb = $get_thumb->getClientOriginalName();
            $name_thumb = current(explode('.', $get_name_thumb));
            $new_thumb = $name_thumb . '_' . strtotime(date('Y-m-d H:i:s')) . '.' . $get_thumb->getClientOriginalExtension();
            $get_thumb->move('storage\app\public\uploads-book', $new_thumb);
            $data['book_thumb'] = $new_thumb;
    
            DB::table('books')
                ->insert($data);

            Session::flash('success', 'Thêm Sách thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            // Ghi log (ghi lỗi)
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    // Lấy tất cả Sách
    public function get()
    {
        return Book::with('menu')->with('publisher')->with('author')
            ->orderByDesc('book_id')->paginate(8);
    }

    public function update($request, $book): bool
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $data = array();
            $data['book_name'] = $request->book_name;
            $data['book_description'] = $request->book_description;
            
            $data['book_format'] = $request->book_format;
            $data['book_pages'] = $request->book_pages;
            $data['book_weight'] = $request->book_weight;
            $data['book_publishing_year'] = $request->book_publishing_year;
    
            $data['book_price'] = $request->book_price;
            $data['book_price_sale'] = $request->book_price_sale;
    
            $data['menu_id'] = $request->menu_id;
            $data['publisher_id'] = $request->publisher_id;
            $data['author_id'] = $request->author_id;
    
            $data['book_active'] = $request->book_active;
            $data['updated_at'] = Carbon::now();
            $get_thumb = $request->file('book_thumb');

            $destinationPath = 'storage/app/public/uploads-book/' . $book->book_thumb;
            if (file_exists($destinationPath)) {
                unlink($destinationPath);
            }
    
            $get_name_thumb = $get_thumb->getClientOriginalName();
            $name_thumb = current(explode('.', $get_name_thumb));
            $new_thumb = $name_thumb . '_' . strtotime(date('Y-m-d H:i:s')) . '.' . $get_thumb->getClientOriginalExtension();
            $get_thumb->move('storage\app\public\uploads-book', $new_thumb);
            $data['book_thumb'] = $new_thumb;
    
            DB::table('books')
                ->where('book_id', $book->book_id)
                ->update($data);

            Session::flash('success', 'Cập nhật Sách thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($book)
    {
        try {
            $destinationPath = 'storage/app/public/uploads-book/' . $book->book_thumb;
            if (file_exists($destinationPath)) {
                unlink($destinationPath);
            }

            DB::table('books')
                ->where('book_id', $book->book_id)
                ->delete();

            Session::flash('success', 'Xóa Sách thành công');

        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            // Ghi log (ghi lỗi)
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    // User Page
    const LIMIT = 4;

    public function getAll()
    {
        return Book::select('book_id', 'book_name', 'book_price_sale', 'book_thumb')
        ->where('book_active', 1)
        ->orderbyDesc('book_id')
        ->paginate(8);
    }

    public function show($id)
    {
        return Book::where('book_id', $id)
        ->where('book_active', 1)
        ->with('menu')
        ->with('publisher')
        ->with('author')
        ->firstOrFail();
    }

    public function showBookRelated($id, $menu_id) {
        return Book::select('book_id', 'book_name', 'book_price_sale', 'book_thumb')
        ->where('menu_id', $menu_id)
        ->where('book_id', '!=', $id)
        ->where('book_active', 1)
        ->orderbyDesc('book_id')
        ->get();
    }

    public function search($keyword) {
        return Book::select('book_id', 'book_name', 'book_price_sale', 'book_thumb')
        ->where('book_name', 'LIKE', '%' . $keyword . '%')
        ->where('book_active', 1)
        ->paginate(8);
    }

    // public function showBookAjax($data) {
    //     return Book::where('book_active', 1)
    //     ->where('book_name', 'LIKE', '%' . $data['query'] . '%')
    //     ->where('book_name', 1)
    //     ->get();
    // }
}
