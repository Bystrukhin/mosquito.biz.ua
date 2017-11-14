<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Comments;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function getSignup()
    {
        return view('user.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'date' => $request->input('data'),
        ]);
        $user->save();

        Auth::login($user);

        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }
        return redirect()->route('user.profile');
    }

    public function getSignin()
    {
        return view('user.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $email = $request->input('email');
        $password  = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('user.profile');
        }
        return redirect()->back();
    }

    public function getProfile() {
        return view('user.profile');
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('user.signin');
    }

    public function getComments(Request $request, $user_id)
    {
        $user = DB::table('users')
            ->where('users.id', '=', $user_id)
            ->get();

        $comments = DB::table('comments')
            ->where('comments.user_id', '=', $user_id)
            ->paginate(5);

        return view('comments', ['comments' => $comments, 'user' => $user]);
    }

    public function getCommentPage($category_id, $article_id)
    {
        $article = DB::table('articles')
            ->select('*')
            ->where('articles.id', '=', $article_id)
            ->get();

        $category = DB::table('categories')
            ->select('*')
            ->where('categories.id', '=', $category_id)
            ->get();

        return view('comment', ['category'=>$category,'article'=>$article]);
    }

    public function postComment()
    {
        $text = Input::get('comment', '');
        $article = Input::get('article', '');
        $category = Input::get('category', '');
        $user = Auth::id();
        $date = date("Y-m-d H:i:s");
        if($category == 1) {
            $visible = 0;
        } else {
            $visible = 1;
        }

        $comment = new Comments([
            'article_id' => $article,
            'user_id' => $user,
            'text' => $text,
            'date' => $date,
            'Visible'=>$visible,
        ]);

        $comment->save();

        return redirect()->route('article.index', ['category_id'=>$category,'article_id' => $article]);
    }

    public function getAdmin() {
        return view('admin');
    }
}
