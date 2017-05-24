<?php
namespace app\admin\Controller;
use\think\Controller;

header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求
header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With');

class Admin extends Controller
{
    public function index()
    {
      echo"hahahaha";
    }
    public function hello()
    {
      echo"hello";
    }
    //创建参数(包括签名的处理)
    public function createParam () {
      date_default_timezone_set("PRC");
      $showapi_appid = '38264';  //替换此值,在官网的"我的应用"中找到相关值
      $showapi_secret = '0889a9d432f14c0db0d044c8d0c28978';  //替换此值,在官网的"我的应用"中找到相关值
      $paramArr = array(
           'showapi_appid'=> $showapi_appid,
           'page'=> '1',
           'maxResult'=> '1'
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
        return json_encode($res[0]);
    }
}
