<?php
/**
 * @Author: Marte
 * @Date:   2017-05-29 10:38:22
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-05-29 19:25:43
 */
namespace app\user\Controller;
use\think\Controller;
use think\Db;
use app\user\model\tb_laught;

class User extends Controller
{
    public function select() {
        $row = tb_laught::all([1,2,3]);
        dump($row);
        foreach($row as $key=>$user){
        echo $user->title;
}
    }
    public function laught() {
        return view('table_basic');
    }
}