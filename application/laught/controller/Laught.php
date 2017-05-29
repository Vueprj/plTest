<?php
namespace app\laught\Controller;
use\think\Controller;
use think\Db;

class Laught extends Controller
{
    //查找笑话
    public function find()
    {
      $data=Db::table('tb_laught')->where('id',1)->select();
      var_dump($data);
    }

     //获取笑话的页数
    public function insertLaught()
    {
      $i =119;
      for (; $i < 139; $i++) {
        $this->insertext($i);
      }
    }
    //查到的笑话插入数据库
     public function add($title,$imgUrl,$time,$type)
    {
      $data = ['title'=>$title,'imgUrl'=>$imgUrl,
               'type'=>$type,'time'=>$time];
      Db::table('tb_laught')->insert($data);
      $userId = Db::table('tb_laught')->getLastInsID();
    }
    //获取笑话
    public function insertext($page) {
        date_default_timezone_set("PRC");
        $showapi_appid = '38264';  //替换此值,在官网的"我的应用"中找到相关值
        $showapi_secret = '0889a9d432f14c0db0d044c8d0c28978';  //替换此值,在官网的"我的应用"中找到相关值
        $paramArr = array(
           'showapi_appid'=> $showapi_appid,
           'page'=> $page,
           'maxResult'=> '50',
           'allPages'=> '20'
           //添加其他参数
      );
        $paraStr = "";
        $signStr = "";
        ksort($paramArr);
         foreach ($paramArr as $key => $val) {
             if ($key != '' && $val != '') {
                 $signStr .= $key.$val;
                 $paraStr .= $key.'='.urlencode($val).'&';
             }
         }
         $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
         $sign = strtolower(md5($signStr));
         $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
         $url = 'http://route.showapi.com/341-3?'.$paraStr;
         $result = file_get_contents($url);
         $arr = json_decode($result,true);
         $res = $arr['showapi_res_body']['contentlist'];
         //var_dump($res[0]);
         //var_dump($res);
         for($i=0; $i<50; $i++) {
             var_dump($res[$i]);
             $title = $res[$i]['title'];
             $imgUrl = $res[$i]['img'];
             $time = $res[$i]['ct'];
             $type = $res[$i]['type'];
             $this->add($title,$imgUrl,$time,$type);
         }
    }
}
