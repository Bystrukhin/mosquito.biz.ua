<?php

Route::get('/', [
    'uses'=>'HomeController@index',
    'as'=>'home.index'
]);

Route::get('contacts', [
    'uses'=>'HomeController@getContacts',
    'as'=>'home.getContacts'
]);

Route::get('about', [
    'uses'=>'HomeController@getAbout',
    'as'=>'home.getAbout'
]);

Route::get('search', [
    'uses'=>'TagController@search',
    'as'=>'tag.search'
]);

Route::get('execute_search', [
    'uses'=>'TagController@executeSearch',
]);

Route::get('filter', [
    'uses'=>'ArticleController@search',
    'as'=>'article.filter'
]);

Route::get('category/{category_id}', [
    'uses'=> 'CategoryController@index',
    'as' => 'category.index'
]);

Route::get('category/{category_id}/{article_id}', [
    'uses'=> 'ArticleController@index',
    'as' => 'article.index'
]);

Route::get('tag/{tag_id}', [
    'uses'=> 'TagController@index',
    'as' => 'tag.index'
]);

Route::get('comments/{user_id}', [
    'uses'=> 'UserController@getComments',
    'as' => 'user.getComments'
]);

Route::get('comment/{category_id}/{article_id}', [
    'uses'=> 'UserController@getCommentPage',
    'as' => 'user.getCommentPage'
])->middleware('auth');

Route::get('comment/', [
    'uses'=> 'UserController@postComment',
    'as' => 'user.postComment'
])->middleware('auth');

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);

        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);

        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);

        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [
            'uses' => 'UserController@getProfile',
            'as' => 'user.profile'
        ]);

        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', [
            'uses' => 'UserController@getAdmin',
            'as' => 'user.admin'
        ]);
        Route::get('admin/categories', [
            'uses' => 'AdminController@getCategories',
            'as' => 'admin.categories'
        ]);
        Route::get('admin/category/{category_id}', [
            'uses' => 'AdminController@getCategory',
            'as' => 'admin.getCategory'
        ]);
        Route::get('admin/categories/add', [
            'uses' => 'AdminController@getAddCategory',
            'as' => 'admin.addCategory'
        ]);
        Route::post('admin/categories/add', [
            'uses' => 'AdminController@postAddCategory',
            'as' => 'admin.postAddCategory'
        ]);
        Route::get('admin/categories/edit/{category_id}', [
            'uses' => 'AdminController@getEditCategory',
            'as' => 'admin.editCategory'
        ]);
        Route::post('admin/categories/edit', [
            'uses' => 'AdminController@postEditCategory',
            'as' => 'admin.postEditCategory'
        ]);
        Route::get('admin/category/edit/{article_id}', [
            'uses' => 'AdminController@getEditArticle',
            'as' => 'admin.editArticle'
        ]);
        Route::post('admin/category/edit', [
            'uses' => 'AdminController@postEditArticle',
            'as' => 'admin.postEditArticle'
        ]);
        Route::get('admin/categories/add_article', [
            'uses' => 'AdminController@getAddArticle',
            'as' => 'admin.addArticle'
        ]);
        Route::post('admin/category/add_article', [
            'uses' => 'AdminController@postAddArticle',
            'as' => 'admin.postAddArticle'
        ]);
        Route::get('admin/category/delete/{article_id}', [
            'uses' => 'AdminController@deleteArticle',
            'as' => 'admin.deleteArticle'
        ]);
        Route::get('admin/category/{article_id}/comments', [
            'uses' => 'AdminController@getComments',
            'as' => 'admin.comments'
        ]);
        Route::get('admin/comments', [
            'uses' => 'AdminController@getPendingComments',
            'as' => 'admin.pendingComments'
        ]);
        Route::get('admin/category/{article_id}/comments/edit/{comment_id}', [
            'uses' => 'AdminController@getEditComment',
            'as' => 'admin.editComment'
        ]);
        Route::post('admin/category/{article_id}/comments/edit', [
            'uses' => 'AdminController@postEditComment',
            'as' => 'admin.postEditComment'
        ]);
        Route::get('admin/category/{article_id}/comments/delete/{comment_id}', [
            'uses' => 'AdminController@deleteComment',
            'as' => 'admin.deleteComment'
        ]);
        Route::get('admin/tags', [
            'uses' => 'AdminController@getTags',
            'as' => 'admin.tags'
        ]);
        Route::get('admin/tags/delete/{tag}', [
            'uses' => 'AdminController@deleteTag',
            'as' => 'admin.deleteTag'
        ]);
        Route::get('admin/tags/add', [
            'uses' => 'AdminController@addTag',
            'as' => 'admin.addTag'
        ]);
        Route::post('admin/tags/add', [
            'uses' => 'AdminController@postAddTag',
            'as' => 'admin.postAddTag'
        ]);
        });
    });
});

