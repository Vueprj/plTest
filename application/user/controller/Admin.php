<?php
/**
 * @Author: Marte
 * @Date:   2017-05-29 10:09:36
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-05-29 10:26:45
 */
namespace app\user\controller;

use think\Db;
/**
*
*/
class Admin extends Controller
{

    function select()
    {
        $data=Db::query('select * from tb_laught');
        var_dump($data);
    }
}