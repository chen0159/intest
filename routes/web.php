<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
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
    return view('welcome');
});

Route::get('/chicken', function () {
    return view('chickentest');
});

//app/Http/Controllers/controllertest.php
//Route::get('/ttctr/{id}', 'App\Http\Controllers\controllertest@index');
Route::resource('/ttctr', 'App\Http\Controllers\controllertest');
//controller測試，附加指令式路徑去指定function

Route::get('/contact', 'App\Http\Controllers\controllertest@contacttest');
//controllertest的contacttest function

Route::get('/cttidtt/{id}', 'App\Http\Controllers\controllertest@cttidtt');
//網頁顯示id

Route::get('/layapp', 'App\Http\Controllers\controllertest@layapp');
//布局、id array測試





//DATA  //(不經過MODEL，可能較不正式?)
//INSERT
Route::get('/insert_postsdata/{id}',function($id){
    DB::insert('insert into posts (id,title123,testtest123) values ( ?, ?, ?)', [$id, 'php with laravel '. $id,'laravel is the best thing '. $id]);
});//插入data("posts"Browse插入一列)

//READ
Route::get('/read_postsdata/{id}', function($id){
    $result = DB::select('select * from posts where id = ?', [$id]);
    
    return $result;
    //return var_dump($result);
    //顯示整列data在網頁上;var_dump顯示每個table屬於甚麼變數
    
    //foreach ($result as $post){
    //    return $post->title123;
    //}
    //顯示"posts"title123的字串
});

//UPDATE
Route::get('/update_postsdata/{id}',function($id){
    $update = DB::update('update posts set title123 = "Update title '.$id.'" where id = ?', [$id]);
    DB::update('update posts set testtest123 = "update text '.$id.'" where id =?', [$id]);
    
    return $update;//確保成功執行
    //此值可以利用在if else裡，當等於1時表示執行過不必再執行等等
});

//delete
Route::get('/delete_postsdata/{id}',function($id){
    $delete = DB::delete('delete from posts where id =?', [$id]);

    return $delete;//確保成功執行
    //此值可以利用在if else裡，當等於1時表示執行過不必再執行等等
});




//DATA WITH MODEL
//READ
use App\Models\Post;    //新增的路徑

Route::get('/read_datamodel',function(){
    //$readall = Post::all();
    //foreach($readall as $post){
    //    echo $post->title123;
    //}

    $readone = Post::findOrFail(2);
    //$readone = Post::find(3);     //與上面那一行差別:上面當找不到時會顯示404 not found
    return $readone->title123;
    //**find method is available in the model**

    //$findwhere = Post::where('id', 3)->orderby('id', 'DESC')->take(1)->get();
    //return $findwhere;
    //->orderby('id', 'DESC')   //由id排序,desc下降方式排序
    //->take(1)
});

//INSERT
Route::get('/insert_datamodel/{num}', function($num){
    $insert = new Post;
    $insert->title123 = 'new eloquent title insert '.$num;
    $insert->testtest123 = "new eloquent text insert $num";
    $insert->save();
});    
//UPDATE
Route::get('/update_datamodel/{num}', function($num){
    $insert = Post::find($num);  //指定id例如3，即可update成下面的文字
    $insert->title123 = 'new eloquent title insert update'." $num";
    $insert->testtest123 = 'new eloquent text insert update'." $num";
    $insert->save();
});

//INSERT (another method)
Route::get('/create_datamodel/{num}', function($num){
    Post::create(['title123'=>'create new title insert'." $num", 'testtest123'=>"create new text insert $num"]);
});//注意是=>不是->
//此方法需要allow mass assignment 到創建的models "Post"去允許

//UPDATE (another method)
Route::get('/update2_datamodel/{num}', function($num){
    Post::where('id', $num)->where('is_admin', 0)->update(['title123'=>'update new title insert '. "$num", 'testtest123'=>"update new text insert $num"]);
});

//DELETE
Route::get('/delete_datamodel/{num}', function($num){
    $delete123 = Post::find($num);
    $delete123->delete();
});

//from lab