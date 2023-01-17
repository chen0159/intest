<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Carbon;
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
use App\Models\Role;

Route::get('/read_datamodel',function(){
    //$readall = Post::all();
    //foreach($readall as $post){
    //    echo $post->title123;
    //}

    $readone = Post::findOrFail(2);
    //$readone = Post::find(3);     //與上面那一行差別:上面當找不到時會顯示404 not found
    return $readone;//->title123;
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

////////////////////////////////
//DELETE
Route::get('/delete_datamodel', function(){
    //$delete123 = Post::find(3);
    //$delete123->delete();

//DELETE (another method)
    //Post::destroy(3);
    //Post::destroy([3,4,5]);   //一次摧毀多個
    //Post::where('is_admin', '1')->forceDelete();
});
//把models/Post裡的use softDeletes註解掉可直接刪除
////////////////////////////////




//SOFTDELETE    (顯示刪除時間，實際上data仍然在)
Route::get('/softdelete_datamodel/{id}', function($id){
    Post::find($id)->delete();
});
//READ SOFTDELETE
Route::get('/readsoftdelete_datamodel', function(){
    //$readsftdele = Post::withTrashed()->where('id', 2)->get();
    $readsftdele = Post::onlyTrashed()->where('is_admin', 0)->get();
    //withTrashed:包含softdelete掉的全部顯示
    //onlyTrashed:僅顯示softdelete掉的
    return $readsftdele;
});
//RESTORE SOFTDELETE    (原先被softdelete的data，顯示delete時間回復為原本的null)
Route::get('/restoresoftdelete_datamodel', function(){
    Post::withTrashed()->where('is_admin', 0)->restore();
});

//FORCEDELETE   (真正的刪除data)
Route::get('/forcedelete_datamodel', function(){
    Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});

//hasone belongsto
use App\Models\User;

//one to one
Route::get('/user/{id}/post', function($id){
    return User::find($id)->pfunpost->title123;
});

Route::get('/post/{id}/user', function($id){
    return Post::find($id)->pfunuser->name;
});

//one to many
Route::get('/user/{id}/posts', function($id){
    $user = User::find($id);
    foreach ($user->pFunPosts as $post) {
        echo $post->title123 . "<br>";
        //return只能一個string，echo多個
    }
});

//many to many
Route::get('/users/{id}/roles', function($id){
    $user = User::find($id);
    foreach ($user->pFunRoles as $role) {
        echo $role->name . "<br>";
    }
});

//many to many querying intermediate table(獲取中間table資訊)
Route::get('/users/{id}/roles/pivot', function($id){
    $user = User::find($id);
    foreach ($user->pFunRoles as $role) {
        return $role->pivot->created_at;
    }
});

use App\Models\Country;
//manythrough
Route::get('/countryToPost/{id}', function($id){
    $country = Country::find($id);
    foreach ($country->countryToPost as $post) {
        return $post->title123;
    }
});




use App\Models\Photo;
//polymorphic method
Route::get('/userPhoto/{id}', function($id){
    $yours = User::find($id);
    //return $yours->yoursPhoto;
    foreach ($yours->yoursPhoto as $your) {
        echo $your;
    }
});
Route::get('/postPhoto/{id}', function($id){
    $yours = Post::find($id);
    foreach ($yours->yoursPhoto as $your) {
        echo $your;
    }
});

Route::get('/inversePhoto/{id}', function($id){
    $results = Photo::find($id);
    return $results->inversePhoto;
});

use App\Models\Tag;
use App\Models\Video;
//polymorphic methods many to many
Route::get('/postToTag/{id}', function($id){
    $results = Post::find($id);
    return $results->postToTag;
});

Route::get('/videoToTag/{id}', function($id){
    $results = Video::find($id);
    return $results->videoToTag;
});

Route::get('/tagToPost/{id}', function($id){
    $results = Tag::find($id);
    return $results->tagToPost;
});
Route::get('/tagToVideo/{id}', function($id){
    $results = Tag::find($id);
    return $results->tagToVideo;
});




//13
//INSERT
Route::get('/insert_from_userToPost/{id}', function($id){
    $user = User::findOrFail($id);  //user_id
    $post = new Post(['title123' => 'new 13 title one to one','testtest123' => 'new 13 text one to one']);
    $user->pFunPost()->save($post);
});

//UPDATE
Route::get('/update_from_userToPost', function(){
    $post = Post::whereUserId(1)->first();
    $post->title123 = 'new update 13 title one to one';
    $post->save();
});

//read
Route::get('/read_from_userToPost', function(){
    $user = User::findOrFail(1);
    return $user->pFunPost->title123;
    // foreach ($user->pfunposts as $post){
    //     echo $post->title123 ."<br>";
    // }
});

//delete
Route::get('/delete_from_userToPost', function(){
    $user = User::findOrFail(1);
    $user->pFunPost()->delete();
});




//14
//INSERT    //同
Route::get('/insert_from_userToPosts/{id}', function($id){
    $user = User::findOrFail($id);  //user_id
    $post = new Post(['title123' => 'new 14 title one to many','testtest123' => 'new 14 text one to many']);
    $user->pFunPosts()->save($post);
});

//read
Route::get('/read_from_userToPosts/{id}', function($id){
    $user = User::findOrFail($id);
    foreach ($user->pFunPosts as $post){
        echo $post->title123 ."<br>";
    }
});

//UPDATE
Route::get('/update_from_userToPosts/{id}', function($id){
    $user = User::findOrFail($id);
    $user->pFunPosts()->update(['title123' => "new 14 title one to many $id",'testtest123' => "new 14 text one to many $id"]);
});

//delete    //同
Route::get('/delete_from_userToPost', function(){
    $user = User::findOrFail(1);
    $user->pFunPosts()->delete();
});




//15
//insert    //role輸入資料&pivot自動建立關系
Route::get('/insert_from_usersToRoles/{id}', function($id){
    $user = User::findOrFail($id);
    $role = new Role(["name" => "pname from users $id"]);   //$role = new Role();   //$role->name = "pname to users $id";
    $user->pfunroles()->save($role);
    //$user->pfunroles()->save(new Role(["name" => "pname from users $id"]));   //340+341
    //$user->pfunroles()->create(['name' => "create pname from users $id"]);
});

//read
Route::get('/read_from_usersToRoles/{id}', function($id){
    $user = User::findOrFail($id);
    foreach ($user->pfunroles as $role){
        echo $role ."<br>";
    }
    //collections：$user->pfunroles;    //object：$role;
});

//update
Route::get('/update_from_usersToRoles/{id}', function($id){
    $user = User::findOrFail($id);
    if($user->has('pfunroles')){
        foreach ($user->pfunroles as $role){
            if($role->name == "pname from users $id"){
                $role->name = "update pname to users $id";
                $role->save();
            }
        }
    }
});

//delete
Route::get('/delete_from_usersToRoles/{id}', function($id){
    $user = User::findOrFail($id);
    $user->pfunroles()->delete();
    // foreach ($user->pfunroles as $role) {
    //     $role->whereId(3)->delete();    //where('id' ,3);
    // }
});

//attach    //新增對應關係(在pivot新增)
Route::get('/attachRoleUser/{id}', function($id){
    $user = User::findOrFail($id);
    $user->pfunroles()->attach($id);
});

//detach    //刪除對應關係(在pivot刪除)
Route::get('/detachRoleUser/{id}', function($id){
    $user = User::findOrFail($id);
    $user->pfunroles()->detach($id);
    //$user->pfunroles()->detach(); //刪除user_id = $id 對應的所有關係
});

//sync
Route::get('/syncRoleUser/{id}', function($id){
    $user = User::findOrFail($id);
    $user->pfunroles()->sync([$id]);    //->sync([5,6,7]);
    //新增(or保留)user,role = $id 的pivot，刪除user_id = $id 對應的所有關係
});




//
//insert
Route::get('/createPhotoFromPost/{id}', function($id){
    $post = Post::findOrFail($id);
    $post->yoursphoto()->create(['name' => "create_from_post_$id.jpg"]);
    //$user = User::findOrFail($id);
    //$user->yoursphoto()->create(['name' => "create_from_user_$id.jpg"]);
});

//read
Route::get('/readPhotoFromPost/{id}', function($id){
    $post = Post::findOrFail($id);
    foreach ($post->yoursphoto as $photo){
        echo $photo->name ."<br>";
    }
});

//update
Route::get('/updatePhotoFromPost/{id}', function($id){
    $post = Post::findOrFail($id);
    $photo = $post->yoursphoto()->first();
    $photo->name = "update_from_post_$id.png";
    $photo->save();      //save()只能存物件
    // $post->yoursphoto()->first()->update(['name' => "update_from_post_$id.jpg"]);    //update()可以是集合或物件(，變數也是);
});

//delete
Route::get('/deletePhotoFromPost/{id}', function($id){
    $post = Post::findOrFail($id);
    $post->yoursphoto()->delete();
});

//assign
Route::get('/assignPhotoFromPost/{id}/{id2}', function($id,$id2){
    $post = Post::findOrFail($id);
    $photo = Photo::findOrFail($id2);
    //$photo = Photo::where('imageable_id', 0)->first();
    $post->yoursphoto()->save($photo);
});

//unassign
Route::get('/unassignPhotoFromPost/{id}', function($id){
    $post = Post::findOrFail($id);
    $post->yoursphoto()/*->where('id', 4)*/->update(["imageable_id" => "0", "imageable_type" => ""]);
});




Route::resource('/postsForm', 'App\Http\Controllers\PostsController');




// dates  //要use Illuminate\Support\Carbon;
Route::get('/dates', function(){

    $date = new DateTime('+1 week');
    
    echo $date->format('m-d-Y H:i:s') .'<br>';

    echo Carbon::now()->addDays(18)->diffForHumans() .'<br>';   //diffForHumans()變為距今多久前
    echo Carbon::now()->addMonths(18)->diffForHumans() .'<br>';
    echo Carbon::now()->yesterday()->diffForHumans() .'<br>';
    echo Carbon::now() .'<br>';

    


    echo User::findOrFail(1)->name .'<br>'; //顯示大寫(在user model)
    User::create(['name' => 'james', 'email' => 'james@', 'password' => 'james123', 'country_id' => '1']);  //insert進來的資料改成大寫
});
//
//test
