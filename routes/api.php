<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//	 return $request->user();
// });





Route::group(['prefix' => 'admin', 'middleware' => 'api'], function () {
	Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api\Admin\User'], function ($router) {
		Route::post('login', 'AuthController@login');
		Route::post('logout', 'AuthController@logout');
		Route::post('refresh', 'AuthController@refresh');
		Route::group(['middleware' => 'jwt.auth'], function ($router) {
			Route::post('me', 'AuthController@me');
			Route::post('status', 'AuthController@status');
		});
	});

	Route::group(['namespace' => 'App\Http\Controllers\Api\Admin'], function () {
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'settings', 'namespace' => 'Setting'], function () {
			Route::post('/editpassword', EditPasswordController::class);
			Route::post('/editemail', EditEmailController::class);
		});
		Route::group(['prefix' => 'users', 'namespace' => 'User'], function () {
			Route::post('/registration', StoreController::class);
			Route::post('/resetpassword', ResetPasswordController::class);
			Route::post('/count', UsersCountController::class);
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'app', 'namespace' => 'App'], function ($router) {
			Route::get('/', IndexController::class);
			Route::group(['prefix' => 'logo', 'namespace' => 'Logo'], function ($router) {
				Route::post('/', UpdateController::class);
			});
			Route::group(['prefix' => 'adresses', 'namespace' => 'Adress'], function ($router) {
				Route::post('/', StoreController::class);
				Route::patch('/', UpdateController::class);
				Route::delete('/{adress}', DestroyController::class);
			});
			Route::group(['prefix' => 'emails', 'namespace' => 'Email'], function ($router) {
				Route::post('/', StoreController::class);
				Route::patch('/', UpdateController::class);
				Route::delete('/{email}', DestroyController::class);
			});
			Route::group(['prefix' => 'telephones', 'namespace' => 'Telephone'], function ($router) {
				Route::post('/', StoreController::class);
				Route::patch('/', UpdateController::class);
				Route::delete('/{telephone}', DestroyController::class);
			});
			Route::group(['prefix' => 'socs', 'namespace' => 'Soc'], function ($router) {
				Route::post('/', StoreController::class);
				Route::patch('/', UpdateController::class);
				Route::delete('/{soc}', DestroyController::class);
			});
			Route::group(['prefix' => 'plan_works', 'namespace' => 'PlanWork'], function ($router) {
				Route::patch('/', UpdateController::class);
			});
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'categories', 'namespace' => 'Category'], function () {
			Route::get('/deletes', DeletesController::class);
			Route::post('/', StoreController::class);
			Route::patch('/', UpdateController::class);
			Route::delete('/{category}', DestroyController::class);
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'specifications', 'namespace' => 'Specification'], function () {
			Route::get('/', IndexController::class);
			Route::get('/deletes', DeletesController::class);
			Route::get('/childrens', ChildrenController::class);
			Route::get('/{id}', ShowController::class);
			Route::post('/', StoreController::class);
			Route::patch('/', UpdateController::class);
			Route::delete('/{category}', DestroyController::class);
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'tags', 'namespace' => 'Tag'], function () {
			Route::get('/', IndexController::class);
			Route::get('/deletes', DeletesController::class);
			Route::post('/', StoreController::class);
			Route::patch('/', UpdateController::class);
			Route::delete('/{tag}', DestroyController::class);
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'category_specifications', 'namespace' => 'CategorySpecification'], function () {
			Route::post('/', StoreController::class);
			Route::get('/{id}', LinkController::class);
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'searchhints', 'namespace' => 'SearchHint'], function ($router) {
			Route::get('/', IndexController::class);
			Route::post('/', StoreController::class);
			Route::patch('/', UpdateController::class);
			Route::delete('/{id}', DestroyController::class);
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'products', 'namespace' => 'Product'], function ($router) {
			Route::get('/', IndexController::class);
			Route::post('/', StoreController::class);
			Route::patch('/', UpdateController::class);
			Route::delete('/{product}', DestroyController::class);
			Route::get('/{id}', ShowController::class);
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'commentaries', 'namespace' => 'Commentary'], function ($router) {
			Route::get('/', IndexController::class);
			Route::delete('/{commentary}', DestroyController::class);
		});
		Route::group(['middleware' => 'jwt.auth', 'prefix' => 'abouts', 'namespace' => 'About'], function ($router) {
			Route::patch('/', UpdateController::class);
		});
	});
});



Route::group(['middleware' => 'api', 'namespace' => 'App\Http\Controllers\Api\Project'], function () {
	Route::group(['prefix' => 'categories', 'namespace' => 'Category'], function ($router) {
		Route::get('/', IndexController::class);
		Route::get('/{category}/name', NameController::class);
		Route::get('/{category}/products', CategoryProductController::class);
		Route::get('/{category}/recomendations', RecController::class);
		Route::get('/{category}', ShowController::class);
	});
	Route::group(['prefix' => 'tags', 'namespace' => 'Tag'], function ($router) {
		Route::get('/', IndexController::class);
		Route::get('/{tag}', ShowController::class);
	});
	Route::group(['prefix' => 'specifications', 'namespace' => 'Specification'], function ($router) {
		Route::get('/', IndexController::class);
		Route::get('/{id}', ShowController::class);
	});
	Route::group(['prefix' => 'products', 'namespace' => 'Product'], function ($router) {
		Route::get('/', IndexController::class);
		Route::get('/search', SearchController::class);
		Route::post('/favorites', FavoriteController::class);
		Route::post('/histories', HistoryController::class);
		Route::post('/trash', TrashController::class);
		Route::get('/newproducts', NewproductController::class);
		Route::get('/discounts', DiscountController::class);
		Route::get('/hits', HitController::class);
		Route::get('/{id}/description', DescriptionController::class);
		Route::get('/{id}', ShowController::class);
	});
	Route::group(['prefix' => 'commentaries', 'namespace' => 'Commentary'], function ($router) {
		Route::post('/', StoreController::class);
		Route::get('/{id}', CommentaryController::class);
	});
	Route::group(['namespace' => 'Search'], function ($router) {
		Route::get('/search', IndexController::class);
		Route::group(['namespace' => 'Hint'], function ($router) {
			Route::get('/searchhints', IndexController::class);
			Route::get('/searchhints/{id}', ShowController::class);
		});
	});
	Route::group(['prefix' => 'app', 'namespace' => 'App'], function ($router) {
		Route::get('/', IndexController::class);
	});
	Route::group(['prefix' => 'abouts', 'namespace' => 'About'], function ($router) {
		Route::get('/', IndexController::class);
	});
});