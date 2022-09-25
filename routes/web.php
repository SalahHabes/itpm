<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware('auth');

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home',[
    'uses'=>'HomeController@index',
    'as'=>'home',
    'middleware'=>'roles',
    'roles'=>['Employee','Manager','Admin']
]);

//Route::get('/projects', 'ProjectsController@index');
Route::get('/projects',[
    'uses'=>'ProjectsController@index',
    'as'=>'projects.index',
    'middleware'=>'roles',
    'roles'=>['Manager']
]);

//Route::get('/projects/create', 'ProjectsController@create')->name('projects.create');
Route::get('/projects/create',[
    'uses'=>'ProjectsController@create',
    'as'=>'projects.create',
    'middleware'=>'roles',
    'roles'=>['Manager']
]);

//Route::post('/projects', 'ProjectsController@store');
Route::post('/projects',[
    'uses'=>'ProjectsController@store',
    'as'=>'projects.store',
    'middleware'=>'roles',
    'roles'=>['Manager']
]);

//Route::get('/projects/{id}', 'ProjectsController@show');
Route::get('/projects/{id}',[
    'uses'=>'ProjectsController@show',
    'as'=>'projects.show',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::get('/projects/edit/{id}', 'ProjectsController@edit');
Route::get('/projects/edit/{id}',[
    'uses'=>'ProjectsController@edit',
    'as'=>'projects.edit',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::post('/projects/update/{id}', 'ProjectsController@update');
Route::post('/projects/update/{id}',[
    'uses'=>'ProjectsController@update',
    'as'=>'projects.update',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::delete('/projects/{id}', 'ProjectsController@destroy');
Route::delete('/projects/{id}',[
    'uses'=>'ProjectsController@destroy',
    'as'=>'projects.destroy',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::post('/projects/{id}', 'TasksController@store');
Route::post('/projects/{id}',[
    'uses'=>'TasksController@store',
    'as'=>'tasks.store',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::get('/projects/tasks/{id}', 'TasksController@show');
Route::get('/projects/tasks/{id}',[
    'uses'=>'TasksController@show',
    'as'=>'tasks.show',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager','Employee']
]);
//Route::delete('/projects/{idp}/{idt}', 'TasksController@destroy');
Route::delete('/projects/{idp}/{idt}',[
    'uses'=>'TasksController@destroy',
    'as'=>'tasks.destroy',
    'middleware'=>'roles',
    'idp'=>'idp',
    'idt'=>'idt',
    'roles'=>['Manager']
]);

//Route::get('/mytasks', 'TasksController@mytasks');
Route::get('/mytasks',[
    'uses'=>'TasksController@mytasks',
    'as'=>'tasks.mytasks',
    'middleware'=>'roles',
    'roles'=>['Employee']
]);

//Route::post('/projects/tasks/{id}/mark', 'TasksController@markfinished');
Route::post('/projects/tasks/{id}/mark',[
    'uses'=>'TasksController@markfinished',
    'as'=>'tasks.markfinished',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Employee','Manager']
]);

//Route::post('/projects/tasks/{id}/unmark', 'TasksController@unmarkfinished');
Route::post('/projects/tasks/{id}/unmark',[
    'uses'=>'TasksController@unmarkfinished',
    'as'=>'tasks.unmarkfinished',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Employee','Manager']
]);

//Route::get('/projects/tasks/edit/{id}', 'TasksController@edit');
Route::get('/projects/tasks/edit/{id}',[
    'uses'=>'TasksController@edit',
    'as'=>'tasks.edit',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::post('/projects/tasks/update/{id}', 'TasksController@update');
Route::post('/projects/tasks/update/{id}',[
    'uses'=>'TasksController@update',
    'as'=>'tasks.update',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::get('/employees', 'EmployeesController@myemp');
Route::get('/employees',[
    'uses'=>'EmployeesController@myemp',
    'as'=>'employees.myemp',
    'middleware'=>'roles',
    'roles'=>['Manager']
]);

//Route::post('/employees/add/{id}', 'EmployeesController@add');
Route::post('/employees/add/{id}',[
    'uses'=>'EmployeesController@add',
    'as'=>'employees.add',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::post('/employees/remove/{id}', 'EmployeesController@remove');
Route::post('/employees/remove/{id}',[
    'uses'=>'EmployeesController@remove',
    'as'=>'employees.remove',
    'middleware'=>'roles',
    'id'=>'id',
    'roles'=>['Manager']
]);

//Route::get('/employees/global', 'EmployeesController@global');
Route::get('/employees/global',[
    'uses'=>'EmployeesController@global',
    'as'=>'employees.global',
    'middleware'=>'roles',
    'roles'=>['Manager']
]);

/*###########################################Admin######################################*/

//Route::get('/assign', 'HomeController@assign')->name('admin.assign');
Route::get('/assign',[
    'uses'=>'HomeController@assign',
    'as'=>'admin.assign',
    'middleware'=>'roles',
    'roles'=>['Admin']
]);

//Route::post('/assign','HomeController@changeAssign')->name('changeAssign');
Route::post('/assign',[
    'uses'=>'HomeController@changeAssign',
    'as'=>'changeAssign',
    'middleware'=>'roles',
    'roles'=>['Admin']
]);

//Route::get('/signup', 'HomeController@signup')->name('admin.signup');
Route::get('/signup',[
    'uses'=>'HomeController@signup',
    'as'=>'admin.signup',
    'middleware'=>'roles',
    'roles'=>['Admin']
]);

//Route::post('/signup', 'HomeController@register')->name('admin.register');
Route::post('/signup',[
    'uses'=>'HomeController@register',
    'as'=>'admin.register',
    'middleware'=>'roles',
    'roles'=>['Admin']
]);

Route::get('/Error',function () {
    return view('Error');
});

Auth::routes(
    ['register' => false]
);
