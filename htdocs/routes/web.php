<?php

use Illuminate\Support\Facades\Route;

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
    if(App\Garden::all()->count() === 0){
        $json = json_decode(file_get_contents('./json/garden.json'));
        foreach ($json as $data){
           foreach ($data as $item){
                $input = [];
                $input['name'] = $item->name;
                $input['introduce'] = $item->introduce;
                $input['address'] = $item->address;
                $input['phone'] = $item->phone;
                $input['management'] = $item->management;
                $input['score'] = $item->score;
                $input['user_id'] = $item->manager_id;
                $user = [];
                $user['id'] = $item->manager_id;
                $user['password'] = '1234';
                $user['name'] = $item->name.'의 관리자';
                \App\Garden::create($input);
                \App\User::create($user);
           }
        }
    }
    return view('index');
});

Route::get('login','UserController@loginPage')->name('login');
Route::get('guide/{type?}','GardenController@guidePage')->name('guide');
Route::get('garden/{id}','GardenController@viewPage')->name('garden');
Route::get('calendar/{id}','GardenController@calendarPage')->name('calendar');
Route::get('sign','UserController@signPage')->name('sign');
Route::get('logout','UserController@logout')->name('logout');

Route::post('login','UserController@login')->name('login');
Route::post('check','GardenController@check')->name('check');
Route::post('calendar','GardenController@calendar')->name('calendar');
Route::post('sign','UserController@sign')->name('sign');
