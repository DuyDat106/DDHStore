<?php

Route::group(['namespace' => 'Backend','prefix' => 'admin'], function(){
    Route::group(['namespace' => 'Auth'], function(){
        Route::get('login','BackendLoginController@getLogin')->name('get_admin.login');
        Route::post('login','BackendLoginController@postLogin');
        Route::get('logout','BackendLoginController@logout')->name('get_admin.logout');
    });
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
//BACKEND
Route::group(['namespace' => 'Backend','prefix' => 'admin', 'middleware' => 'checkLoginAdmin'], function(){
	 // Trang chủ
	Route::get('','BackendHomeController@index')->name('get_backend.home');
	// Category
	Route::prefix('user')->group(function(){
		Route::get('','BackendUserController@index')->name('get_backend.user.index')->middleware('permission:full|user_index');;

//		Route::get('create','BackendUserController@create')->name('get_backend.user.create');
//		Route::post('create','BackendUserController@store');
//
//		Route::get('update/{id}','BackendUserController@edit')->name('get_backend.user.update');
//		Route::post('update/{id}','BackendUserController@update');

		Route::get('delete/{id}','BackendUserController@delete')->name('get_backend.user.delete')->middleware('permission:full|user_delete');;

	});
	Route::prefix('category')->group(function(){
		Route::get('','BackendCategoryController@index')->name('get_backend.category.index')->middleware('permission:full|category_index');

		Route::get('create','BackendCategoryController@create')->name('get_backend.category.create')->middleware('permission:full|category_create');
		Route::post('create','BackendCategoryController@store')->name('get_backend.category.store')->middleware('permission:full|category_create');

		Route::get('update/{id}','BackendCategoryController@edit')->name('get_backend.category.update')->middleware('permission:full|category_update');
		Route::post('update/{id}','BackendCategoryController@update')->middleware('permission:full|category_update');

		Route::get('delete/{id}','BackendCategoryController@delete')->name('get_backend.category.delete')->middleware('permission:full|category_delete');

	});

	Route::prefix('manufacturer')->group(function(){
		Route::get('','BackendManufacturerController@index')->name('get_backend.manufacturer.index')->middleware('permission:full|manufacturer_index');

		Route::get('create','BackendManufacturerController@create')->name('get_backend.manufacturer.create')->middleware('permission:full|manufacturer_create');
		Route::post('create','BackendManufacturerController@store')->name('get_backend.manufacturer.store')->middleware('permission:full|manufacturer_create');;

		Route::get('update/{id}','BackendManufacturerController@edit')->name('get_backend.manufacturer.update')->middleware('permission:full|manufacturer_update');
		Route::post('update/{id}','BackendManufacturerController@update')->middleware('permission:full|manufacturer_update');

		Route::get('delete/{id}','BackendManufacturerController@delete')->name('get_backend.manufacturer.delete')->middleware('permission:full|manufacturer_delete');

	});

	Route::prefix('keyword')->group(function(){
		Route::get('','BackendKeywordController@index')->name('get_backend.keyword.index')->middleware('permission:full|keyword_index');

		Route::get('create','BackendKeywordController@create')->name('get_backend.keyword.create')->middleware('permission:full|keyword_create');
		Route::post('create','BackendKeywordController@store')->name('get_backend.keyword.store')->middleware('permission:full|keyword_create');

		Route::get('update/{id}','BackendKeywordController@edit')->name('get_backend.keyword.update')->middleware('permission:full|keyword_update');
		Route::post('update/{id}','BackendKeywordController@update')->middleware('permission:full|keyword_update');

		Route::get('delete/{id}','BackendKeywordController@delete')->name('get_backend.keyword.delete')->middleware('permission:full|keyword_delete');

	});

	Route::prefix('product')->group(function(){
		Route::get('','BackendProductController@index')->name('get_backend.product.index')->middleware('permission:full|product_index');

		Route::get('create','BackendProductController@create')->name('get_backend.product.create')->middleware('permission:full|product_create');
		Route::post('create','BackendProductController@store')->middleware('permission:full|product_create');

		Route::get('update/{id}','BackendProductController@edit')->name('get_backend.product.update')->middleware('permission:full|product_update');
		Route::post('update/{id}','BackendProductController@update')->middleware('permission:full|product_update');

		Route::get('delete/{id}','BackendProductController@delete')->name('get_backend.product.delete')->middleware('permission:full|product_delete');
	});

	Route::prefix('menu')->group(function(){
		Route::get('','BackendMenuController@index')->name('get_backend.menu.index')->middleware('permission:full|menu_index');

		Route::get('create','BackendMenuController@create')->name('get_backend.menu.create')->middleware('permission:full|menu_create');
		Route::post('create','BackendMenuController@store')->name('get_backend.menu.store')->middleware('permission:full|menu_create');

		Route::get('update/{id}','BackendMenuController@edit')->name('get_backend.menu.update')->middleware('permission:full|menu_update');
		Route::post('update/{id}','BackendMenuController@update')->middleware('permission:full|menu_update');

		Route::get('delete/{id}','BackendMenuController@delete')->name('get_backend.menu.delete')->middleware('permission:full|menu_delete');

	});

	Route::prefix('tag')->group(function(){
		Route::get('','BackendTagController@index')->name('get_backend.tag.index')->middleware('permission:full|tag_index');

		Route::get('create','BackendTagController@create')->name('get_backend.tag.create')->middleware('permission:full|tag_index');
		Route::post('create','BackendTagController@store')->name('get_backend.tag.store')->middleware('permission:full|tag_index');

		Route::get('update/{id}','BackendTagController@edit')->name('get_backend.tag.update')->middleware('permission:full|tag_index');
		Route::post('update/{id}','BackendTagController@update')->middleware('permission:full|tag_index');

		Route::get('delete/{id}','BackendTagController@delete')->name('get_backend.tag.delete')->middleware('permission:full|tag_index');

	});

	Route::prefix('article')->group(function(){
		Route::get('','BackendArticleController@index')->name('get_backend.article.index')->middleware('permission:full|article_index');

		Route::get('create','BackendArticleController@create')->name('get_backend.article.create')->middleware('permission:full|article_create');
		Route::post('create','BackendArticleController@store')->middleware('permission:full|article_create');

		Route::get('update/{id}','BackendArticleController@edit')->name('get_backend.article.update')->middleware('permission:full|article_update');
		Route::post('update/{id}','BackendArticleController@update')->middleware('permission:full|article_update');

		Route::get('delete/{id}','BackendArticleController@delete')->name('get_backend.article.delete')->middleware('permission:full|article_delete');

	});

    Route::prefix('slide')->group(function(){
        Route::get('','BackendSlideController@index')->name('get_backend.slide.index')->middleware('permission:full|slide_index');

        Route::get('create','BackendSlideController@create')->name('get_backend.slide.create')->middleware('permission:full|slide_create');
        Route::post('create','BackendSlideController@store')->name('get_backend.slide.store')->middleware('permission:full|slide_create');

        Route::get('update/{id}','BackendSlideController@edit')->name('get_backend.slide.update')->middleware('permission:full|slide_update');
        Route::post('update/{id}','BackendSlideController@update')->middleware('permission:full|slide_update');

        Route::get('delete/{id}','BackendSlideController@delete')->name('get_backend.slide.delete')->middleware('permission:full|slide_delete');

    });
    Route::prefix('transaction')->group(function(){
        Route::get('','BackendTransactionController@index')->name('get_backend.transaction.index')->middleware('permission:full|transaction_index');
        Route::get('view/{id}','BackendTransactionController@view')->name('get_backend.transaction.view')->middleware('permission:full|transaction_view');
        Route::get('success/{id}','BackendTransactionController@success')->name('get_backend.transaction.success')->middleware('permission:full|transaction_success');
        Route::get('cancel/{id}','BackendTransactionController@cancel')->name('get_backend.transaction.cancel')->middleware('permission:full|transaction_cancel');
        Route::get('delete/{id}','BackendTransactionController@delete')->name('get_backend.transaction.delete')->middleware('permission:full|transaction_delete');
    });
    Route::prefix('order')->group(function(){
        Route::get('delete/{id}','BackendOrderController@delete')->name('get_backend.order.delete')->middleware('permission:full|order_delete');
    });

	Route::get('setting','BackendSettingController@index')->name('get_backend.setting');
	Route::post('setting','BackendSettingController@createOrUpdate')->name('get_backend.setting.store');

	Route::get('profile','BackendProfileController@index')->name('get_backend.profile');
	Route::post('profile','BackendProfileController@createOrUpdate')->name('get_backend.profile.store');

	Route::get('get-char-day','BackendHomeController@ajaxGetChars')->name('ajax_admin.get_dashboard_char');

    Route::group(['prefix' => 'permission'], function (){
        Route::get('','PermissionController@index')->name('get_admin.permission.index');
        Route::get('create','PermissionController@create')->name('get_admin.permission.create');
        Route::post('create','PermissionController@store')->name('get_admin.permission.store');

        Route::get('update/{id}','PermissionController@edit')->name('get_admin.permission.update');
        Route::post('update/{id}','PermissionController@update')->name('get_admin.permission.update');
        Route::get('delete/{id}','PermissionController@delete')->name('get_admin.permission.delete');
    });

    Route::group(['prefix' => 'role'], function (){
        Route::get('','RoleController@index')->name('get_admin.role.index');
        Route::get('create','RoleController@create')->name('get_admin.role.create');
        Route::post('create','RoleController@store')->name('get_admin.role.store');

        Route::get('update/{id}','RoleController@edit')->name('get_admin.role.update');
        Route::post('update/{id}','RoleController@update')->name('get_admin.role.update');
        Route::get('delete/{id}','RoleController@delete')->name('get_admin.role.delete');
    });
    Route::group(['prefix' => 'account'], function (){
        Route::get('','AdminAccountController@index')->name('get_admin.account_admin.index')->middleware('permission:full|account_admin_index');
        Route::get('create','AdminAccountController@create')->name('get_admin.account_admin.create')->middleware('permission:full|account_admin_create');
        Route::post('create','AdminAccountController@store')->name('get_admin.account_admin.store')->middleware('permission:full|account_admin_store');

        Route::get('update/{id}','AdminAccountController@edit')->name('get_admin.account_admin.update')->middleware('permission:full|account_admin_update');
        Route::post('update/{id}','AdminAccountController@update')->name('get_admin.account_admin.update')->middleware('permission:full|account_admin_update');
        Route::get('delete/{id}','AdminAccountController@delete')->name('get_admin.account_admin.delete')->middleware('permission:full|account_admin_delete');
    });
});
