<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function getCategories()
    {
        $categories = DB::table('categories')
            ->select('*')
            ->get();

        return view('admin.categories', ['categories' => $categories]);
    }

    public function getAddCategory()
    {
        return view('admin.add-category');
    }

    public function postAddCategory()
    {
        $name = Input::get('category_name', '');
        $url = Input::get('category_url', '');

        $orderRaw = DB::table('mid_menu')
            ->orderBy('order', 'desc')
            ->get();
        $order = [];
        $order = collect($order);
        foreach ($orderRaw as $item) {
            $order->push($item->order);
        }

        DB::table('categories')
            ->insert(['name' => $name, 'url' => $url]);

        DB::table('mid_menu')
            ->insert(['name' => $name, 'url' => $url, 'top_id' => 2, 'order' => $order->first() + 1, 'visible' => 1]);

        $categories = DB::table('categories')
            ->select('*')
            ->get();

        return redirect()->route('admin.categories', ['categories' => $categories]);
    }

    public function getEditCategory($category_id)
    {
        $categories = DB::table('categories')
            ->select('*')
            ->where('categories.id', '=', $category_id)
            ->get();

        return view('admin.edit-category', ['categories' => $categories]);
    }

    public function postEditCategory()
    {
        $id = Input::get('category_id', '');
        $name = Input::get('category_name', '');
        $url = Input::get('category_url', '');

        DB::table('categories')
            ->where('categories.id', '=', $id)
            ->update(['name' => $name, 'url' => $url]);

        $categories = DB::table('categories')
            ->select('*')
            ->get();

        return redirect()->route('admin.categories', ['categories' => $categories]);
    }

    public function getCategory($category_id)
    {
        $articles = DB::table('articles')
            ->select('*')
            ->where('articles.category_id', '=', $category_id)
            ->paginate(5);

        return view('admin.category', ['articles' => $articles]);
    }

    public function getEditArticle($article_id)
    {
        $articles = DB::table('articles')
            ->select('*')
            ->where('articles.id', '=', $article_id)
            ->get();

        $tags = DB::table('tags')
            ->select('*')
            ->get();

        $categories = DB::table('categories')
            ->select('*')
            ->get();
        $checked = [];
        $checked = collect($checked);

        $checkedTags = DB::table('article_tag')
            ->where('article_tag.article_id', '=', $article_id)
            ->get();

        foreach ($checkedTags as $checkedTag) {
            $checked->push($checkedTag->tag_id);
        }
        $checked->toArray();

        return view('admin.edit-article', ['categories'=>$categories, 'articles' => $articles, 'tags'=>$tags, 'checked'=>$checked]);
    }

    public function postEditArticle(Request $request)
    {
        $id = Input::get('article_id', '');
        $title = Input::get('article_title', '');
        $category_id = Input::get('article_category_id', '');
        $author = Input::get('article_author', '');
        $content = Input::get('article_content', '');
        $oldCategory = Input::get('article_old_category', '');

        $tags = [];
        $tags = collect($tags);
        $inputTags = Input::get('tags');
        if(!empty($inputTags)) {
            foreach($inputTags as $value){
                $tags->push($value);
            }
        }

        if ($request->hasFile('article_image')) {
            $image = $request->file('article_image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path() .'/images';
            $image->move($destinationPath, $input['imagename']);
            $imagePath = 'images/' . $input['imagename'];
        } else {
            $imagePath = Input::get('article_old_image', '');
        }

        DB::table('articles')
            ->where('articles.id', '=', $id)
            ->update(['title' => $title, 'category_id' => $category_id,
                'author' => $author, 'content'=>$content, 'image' =>$imagePath]);

        DB::table('article_tag')
            ->where('article_tag.article_id', '=', $id)
            ->delete();

        $tags = array_filter($tags->toArray());

        if(!empty($tags)) {
            foreach($tags as $tag){
                DB::table('article_tag')
                    ->insert(['article_id' => $id, 'tag_id' => $tag]);
            }
        }

        return redirect()->route('admin.getCategory', ['category_id' => $category_id]);
    }

    public function getAddArticle()
    {
        $tags = DB::table('tags')
            ->select('*')
            ->get();

        $categories = DB::table('categories')
            ->select('*')
            ->get();

        return view('admin.add-article', ['tags'=>$tags, 'categories'=>$categories]);
    }

    public function postAddArticle(Request $request)
    {

        $title = Input::get('article_title', '');
        $category_id = Input::get('category', '');
        $author = Input::get('article_author', '');
        $content = Input::get('article_content', '');
        $tags = [];
        $tags = collect($tags);
        $inputTags = Input::get('tags');
        foreach($inputTags as $value){
            $tags->push($value);
        }

        $date = date("Y-m-d H:i:s");

        if ($request->hasFile('article_image')) {
            $image = $request->file('article_image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path().'/images/';
            $image->move($destinationPath, $input['imagename']);
            $imagePath = $destinationPath . $input['imagename'];
        } else {
            $imagePath = null;
        }

        DB::table('articles')
            ->insert(['title' => $title, 'category_id' => $category_id,
                'author' => $author, 'content'=>$content, 'image' =>$imagePath, 'date'=>$date]);

        $orderRaw = DB::table('mid_menu')
            ->orderBy('order', 'desc')
            ->get();
        $order = [];
        $order = collect($order);
        foreach ($orderRaw as $item) {
            $order->push($item->order);
        }

        $article_idRaw = DB::table('articles')
            ->orderBy('id', 'desc')
            ->get();
        $article_id = [];
        $article_id = collect($article_id);
        foreach ($article_idRaw as $item) {
            $article_id->push($item->id);
        }

        foreach($tags as $tag){
            DB::table('article_tag')
                ->insert(['article_id' => $article_id->first(), 'tag_id' => $tag]);
        }

        return redirect()->route('admin.getCategory', ['category_id' => $category_id]);
    }

    public function deleteArticle($article_id)
    {

        DB::table('articles')
            ->where('articles.id', '=', $article_id)
            ->delete();

        DB::table('article_tag')
            ->where('article_tag.article_id', '=', $article_id)
            ->delete();

        return redirect()->route('admin.categories');
    }

    public function getComments($article_id)
    {
        $comments = DB::table('comments')
            ->select('*')
            ->where('comments.article_id', '=', $article_id)
            ->orderBy('vote', 'DESC')
            ->get();

        $users = DB::table('users')
            ->select('*')
            ->get();

        return view('admin.comments', ['comments'=>$comments, 'users'=>$users, 'article_id'=>$article_id]);
    }

    public function getPendingComments()
    {
        $comments = DB::table('comments')
            ->select('*')
            ->where('comments.Visible', '=', 0)
            ->get();

        $users = DB::table('users')
            ->select('*')
            ->get();

        return view('admin.pending-comments', ['comments'=>$comments, 'users'=>$users]);
    }

    public function getEditComment($article_id, $comment_id)
    {
        $comments = DB::table('comments')
            ->select('*')
            ->where('comments.id', '=', $comment_id)
            ->get();

        return view('admin.edit-comments', ['comments'=>$comments, 'article_id'=>$article_id]);
    }

    public function postEditComment($article_id)
    {
        $id = Input::get('comment_id', '');
        $text = Input::get('comment_text', '');
        $visible = Input::get('comment_visible', '');

        DB::table('comments')
            ->where('comments.id', '=', $id)
            ->update(['text' => $text, 'Visible' => $visible]);

        $comments = DB::table('comments')
            ->select('*')
            ->where('comments.article_id', '=', $article_id)
            ->orderBy('vote', 'DESC')
            ->get();

        $users = DB::table('users')
            ->select('*')
            ->get();

        return redirect()->route('admin.comments', ['comments'=>$comments, 'users'=>$users, 'article_id'=>$article_id]);
    }

    public function deleteComment($article_id, $comment_id)
    {

        DB::table('comments')
            ->where('comments.id', '=', $comment_id)
            ->delete();

        $comments = DB::table('comments')
            ->select('*')
            ->where('comments.article_id', '=', $article_id)
            ->orderBy('vote', 'DESC')
            ->get();

        $users = DB::table('users')
            ->select('*')
            ->get();

        return view('admin.comments', ['comments'=>$comments, 'users'=>$users, 'article_id'=>$article_id]);
    }

    public function getTags()
    {
        $tags = DB::table('tags')
            ->select('*')
            ->get();

        return view('admin.tags', ['tags' => $tags]);
    }

    public function deleteTag($tag)
    {
        DB::table('tags')
            ->where('tags.id', '=', $tag)
            ->delete();

        DB::table('article_tag')
            ->where('article_tag.tag_id', '=', $tag)
            ->delete();

        $tags = DB::table('tags')
            ->select('*')
            ->get();

        return redirect()->route('admin.tags', ['tags' => $tags]);
    }

    public function addTag()
    {
        return view('admin.add-tag');
    }

    public function postAddTag()
    {
        $name = Input::get('tag_name', '');
        $date = date("Y-m-d H:i:s");

        DB::table('tags')
            ->insert(['name' => $name, 'date' => $date]);

        $tags = DB::table('categories')
            ->select('*')
            ->get();

        return redirect()->route('admin.tags', ['tags' => $tags]);
    }

    public function getMenu()
    {
        $menu = DB::table('top_menu')
            ->select('*')
            ->get();

        return view('admin.menu', ['menu' => $menu]);
    }

    public function getSubMenu($name,$parent_id)
    {
        $subMenu = DB::table('mid_menu')
            ->where('mid_menu.top_id', '=', $parent_id)
            ->get();

        return view('admin.sub-menu', ['name'=>$name,'subMenu' => $subMenu, 'parent_id'=>$parent_id]);
    }

    public function getSubSubMenu($name, $subName, $grandparent_id, $parent_id)
    {
        $subSubMenu = DB::table('bot_menu')
            ->where('bot_menu.mid_id', '=', $parent_id)
            ->get();

        return view('admin.sub-sub-menu', ['name'=>$name, 'subName'=>$subName, 'grandparent_id'=>$grandparent_id,
            'parent_id'=>$parent_id,'subSubMenu' => $subSubMenu]);
    }

    public function getEditMenu($name)
    {
        $menu = DB::table('top_menu')
            ->where('top_menu.name', '=', $name)
            ->get();

        return view('admin.edit-menu', ['menu' => $menu]);
    }

    public function postEditMenu($name)
    {
        $id = Input::get('menu_id', '');
        $name = Input::get('menu_name', '');
        $url = Input::get('menu_url', '');
        $visible = Input::get('menu_visibility', '');

        DB::table('top_menu')
            ->where('top_menu.id', '=', $id)
            ->update(['name' => $name, 'url' => $url, 'visible'=>$visible]);

        return redirect()->route('admin.menu');
    }

    public function getEditSubMenu($name, $subName)
    {
        $menu = DB::table('mid_menu')
            ->where('mid_menu.name', '=', $subName)
            ->get();

        return view('admin.edit-sub-menu', ['menu' => $menu, 'name'=>$name]);
    }

    public function postEditSubMenu($name)
    {
        $id = Input::get('menu_id', '');
        $name = Input::get('menu_name', '');
        $url = Input::get('menu_url', '');
        $visible = Input::get('menu_visibility', '');

        DB::table('mid_menu')
            ->where('mid_menu.id', '=', $id)
            ->update(['name' => $name, 'url' => $url, 'visible'=>$visible]);

        return redirect()->route('admin.menu');
    }

    public function getEditSubSubMenu($name, $subName, $subSubName)
    {
        $menu = DB::table('bot_menu')
            ->where('bot_menu.name', '=', $subSubName)
            ->get();

        return view('admin.edit-sub-sub-menu', ['menu' => $menu, 'name'=>$name, 'subName'=> $subName]);
    }

    public function postEditSubSubMenu($name, $subName)
    {
        $id = Input::get('menu_id', '');
        $name = Input::get('menu_name', '');
        $url = Input::get('menu_url', '');
        $visible = Input::get('menu_visibility', '');

        DB::table('bot_menu')
            ->where('bot_menu.id', '=', $id)
            ->update(['name' => $name, 'url' => $url, 'visible'=>$visible]);

        return redirect()->route('admin.menu');
    }

    public function getAddMenu()
    {
        return view('admin.add-menu');
    }

    public function postAddMenu()
    {
        $name = Input::get('menu_name', '');
        $url = Input::get('menu_url', '');
        $visible = Input::get('menu_visibility', '');

        $orderRaw = DB::table('top_menu')
            ->orderBy('order', 'desc')
            ->get();
        $order = [];
        $order = collect($order);
        foreach ($orderRaw as $item) {
            $order->push($item->order);
        }

        DB::table('top_menu')
            ->insert(['name' => $name, 'url' => $url, 'order' => $order->first() + 1, 'visible' => $visible]);


//        Route::addRoute('{url}', array('as' => '{url}', function()
//        {
//            return View::make('{url}');
//        }));

        return redirect()->route('admin.menu');
    }

    public function getAddSubMenu()
    {
        $menu = DB::table('top_menu')
            ->select('*')
            ->get();

        return view('admin.add-sub-menu', ['menu'=>$menu]);
    }

    public function postAddSubMenu()
    {
        $name = Input::get('menu_name', '');
        $url = Input::get('menu_url', '');
        $visible = Input::get('menu_visibility', '');
        $top_id = Input::get('top_name', '');

        $orderRaw = DB::table('mid_menu')
            ->orderBy('order', 'desc')
            ->get();
        $order = [];
        $order = collect($order);
        foreach ($orderRaw as $item) {
            $order->push($item->order);
        }

        DB::table('top_menu')
            ->where('top_menu.id', '=', $top_id)
            ->update(['child' => 1]);

        DB::table('mid_menu')
            ->insert(['name' => $name, 'url' => $url, 'top_id'=>$top_id, 'order' => $order->first() + 1, 'visible' => $visible]);

        return redirect()->route('admin.menu');
    }

    public function getAddSubSubMenu()
    {
        $menu = DB::table('top_menu')
            ->select('*')
            ->get();
        $subMenu = DB::table('mid_menu')
            ->select('*')
            ->get();

        return view('admin.add-sub-sub-menu', ['menu'=>$menu, 'subMenu'=>$subMenu]);
    }

    public function postAddSubSubMenu()
    {
        $name = Input::get('menu_name', '');
        $url = Input::get('menu_url', '');
        $visible = Input::get('menu_visibility', '');
        $top_id = Input::get('top_name', '');
        $mid_id = Input::get('mid_name', '');

        $orderRaw = DB::table('bot_menu')
            ->orderBy('order', 'desc')
            ->get();
        $order = [];
        $order = collect($order);
        foreach ($orderRaw as $item) {
            $order->push($item->order);
        }

        DB::table('top_menu')
            ->where('top_menu.id', '=', $top_id)
            ->update(['child' => 1]);

        DB::table('mid_menu')
            ->where('mid_menu.id', '=', $mid_id)
            ->update(['child' => 1]);

        DB::table('bot_menu')
            ->insert(['name' => $name, 'url' => $url, 'top_id'=>$top_id, 'mid_id'=>$mid_id, 'order' => $order->first() + 1, 'visible' => $visible]);

        return redirect()->route('admin.menu');
    }

    public function deleteMenu($menu_id)
    {

        DB::table('top_menu')
            ->where('top_menu.id', '=', $menu_id)
            ->delete();

        return redirect()->route('admin.menu');
    }

    public function deleteSubMenu($name, $parent_id, $subName, $subMenu_id)
    {

        DB::table('mid_menu')
            ->where('mid_menu.id', '=', $subMenu_id)
            ->delete();

        $result = DB::table('mid_menu')
            ->where('mid_menu.top_id', '=', $parent_id)
            ->get();

        if(!count($result)){
            DB::table('top_menu')
                ->where('top_menu.id', '=', $parent_id)
                ->update(['child' => null]);
        }

        return redirect()->route('admin.menu');
    }

    public function deleteSubSubMenu($name, $grandparent_id, $subName, $parent_id, $subSubName, $subSubMenu_id)
    {

        DB::table('bot_menu')
            ->where('bot_menu.id', '=', $subSubMenu_id)
            ->delete();

        $result = DB::table('bot_menu')
            ->where('bot_menu.mid_id', '=', $parent_id)
            ->get();

        $grandparent_result = DB::table('mid_menu')
            ->where('mid_menu.top_id', '=', $grandparent_id)
            ->get();

        if(!count($result)){
            DB::table('mid_menu')
                ->where('mid_menu.id', '=', $parent_id)
                ->update(['child' => null]);
        }

        if(!count($grandparent_result)){
            DB::table('top_menu')
                ->where('top_menu.id', '=', $grandparent_id)
                ->update(['child' => null]);
        }

        return redirect()->route('admin.menu');
    }

    public function setColor()
    {
        return view('admin.color');
    }

    public function postSetColor()
    {
        $colorName = Input::get('bg_color', '');
        $_SESSION['colorName'] = $colorName;

        return redirect()->back();
    }

}
