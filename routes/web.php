<?php

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
    return redirect()->route('employee.list');
});
$router->group(['prefix' => 'employee', 'as' => 'employee.'], function ($router){
    $router->get('/', ['uses' => 'EmployeeController@get'])->name('list');
    $router->post('/', ['uses' => 'EmployeeController@create'])->name('create');
    $router->get('{id}', ['uses' => 'EmployeeController@show'])->name('show');
    $router->put('{id}', ['uses' => 'EmployeeController@update'])->name('update');
    $router->delete('{id}', ['uses' => 'EmployeeController@delete'])->name('delete');
    $router->post('{id}/new-position', ['uses' => 'EmployeeController@newPosition'])->name('new-position');
});
$router->group(['prefix' => 'position', 'as' => 'position.'], function ($router){
    $router->get('/', ['uses' => 'PositionController@get'])->name('list');
    $router->post('/', ['uses' => 'PositionController@create'])->name('create');
    $router->get('{id}', ['uses' => 'PositionController@show'])->name('show');
    $router->put('{id}', ['uses' => 'PositionController@update'])->name('update');
    $router->delete('{id}', ['uses' => 'PositionController@delete'])->name('delete');
    $router->post('{id}/add-manager', ['uses' => 'PositionController@addManager'])->name('add-manager');
});
$router->group(['prefix' => 'employee-position', 'as' => 'employee-position.'], function ($router){
    $router->get('/', ['uses' => 'EmployeeController@EmployeePosition'])->name('list');
});
$router->group(['prefix' => 'approval', 'as' => 'approval.'], function ($router){
    $router->get('/', ['uses' => 'PositionController@ApprovalList'])->name('list');
});

$router->get('/email', ['uses' => 'MailController@mail'])->name('mail');