<?php

namespace App\Http\Controllers\Util;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Qrcode ;
use App\Replaceqr;
use App\Clienterror; 
class AndroidtoolController extends Controller
{
    public function test()
    {
        return "123";
    }
        // 获取start开始之后得20段信息
    public function getpieceinfo($start)
    {
        if(!is_numeric($start))
        {
            return "Exception:the para is not number !";
        }
        $count = Client::all()->count();
        // echo $count ; 
        if($start < 0 || $start >= $count)
        {
            return "Exception:the para is not get rule !";
        }
        if($start + 20 > $count)
        {
            $clientinfo = Client::where('id','>',$start)->get();
        }
        else
        {
            $clientinfo = Client::where('id','>',$start)->take(20)->get();
        }
        
        foreach($clientinfo as $client)
        {
            $client['qr_text'] = Qrcode::where('client_id' ,'=' ,$client['client_number'])->get()[0]['qrcode'];
        }
        $result["type"] = "getpieceinfo";
        $result["list"] = $clientinfo;
        return $result;
    }
    public function getinfofromname($name)
    {

        $client = Client::where('name','=',$name)->get();
        if(count($client) == 0)
        {
            return "Exception:not the client !";
        }
        
        $client[0]['qr_text'] = Qrcode::where('client_id' ,'=' ,$client[0]['client_number'])->get()[0]['qrcode'];
        $result['type'] ="getinfofromname";
        $result['list'] = $client ; 
        return $result;
    }
    public function getinfofromfactoryid($id)
    {

        $client = Client::where('factory_id','=',$id)->get();
        if(count($client) == 0)
        {
            return "Exception:not the client !";
        }
        
        $client[0]['qr_text'] = Qrcode::where('client_id' ,'=' ,$client[0]['client_number'])->get()[0]['qrcode'];
        $result['type'] ="getinfofromfactoryid";
        $result['list'] = $client ; 
        return $result;
    }
    public function getinfofromqr($qr)
    {

        $client = Qrcode::where('qrcode','=',$qr)->get();
        if(count($client) == 0)
        {
            return "Exception:not the qr !";
        }
        // echo $client ; 
        $clientinfo = Client::where('client_number','=',$client[0]['client_id'])->get();
        // echo $clientinfo;
        $clientinfo[0]['qr_text'] = $client[0]['qrcode'];
        $result['type'] ="getinfofromqr";
        $result['list'] = $clientinfo;
        return $result;
    }

    // 更换二维码数据
    public function replaceqr($qrid)
    {
        $myqr = Qrcode::find($qrid);
        if(count($myqr) == 0)
        {
            return "Exception:not the client !";
        }
        $myqr->qrcode = md5(uniqid());
        if($myqrid->save())
        {
            $myqrid['type'] = "replaceqr";
            return $myqrid;
        }
        else
        {
            return "Exception : can't to replace qrtext !";
        }
    }
    //请求更换二维码
    public function requestreplaceqr($clientnum)
    {
        $myqr = Qrcode::where('client_id','=',$clientnum)->get();
        if(count($myqr) == 0)
        {
            return "Exception:not the client !";
        }
        $depulicate = Replaceqr::where('qrcode_id','=',$myqr[0]['id'])->where('state','=','0')->get();
        if(count($depulicate) > 0)
        {
            return "Exception : it has been contain the repaceinfo";
        }
        $replace = new Replaceqr ; 
        $replace->qrcode_id = $myqr[0]['id'];
        $replace->electrician_id = "achang";
        $replace->state = 0;
        if($replace->save())
        {
            $result['type'] = "requestreplaceqr";
            return $result ;
        }
        else
        {
            return "Exception : can't request to replace the qr!";
        }
    }
    //通知已经更换二维码的信息
    public function informreplaceinfo($electrician)
    {
        $rep = Replaceqr::where('state','=','1')->where('electrician_id','=',$electrician);
        $replace = $rep->get();
        if(count($replace) == 0)
        {
            return "Exception : nothing!";
        }
        for($i = 0 ;$i < count($replace) ; $i++)
        {
            $clientqrcode = Qrcode::where('id','=',$replace[$i]['qrcode_id'])->get();
            $client[$i] = Client::where('client_number','=',$clientqrcode[0]['client_id'])->get()[0];
            $client[$i]['qr_text'] = $clientqrcode[0]['qrcode'];
        }
        $result['type'] = "informReplaceInfo";
        $result['list'] = $client ; 

        $rep->delete();
        
        return $result ; 
    }    
    public function getreplaceqr()
    {
        // $replace = Replaceqr::all();
        $replace = Replaceqr::where('state','=','0')->get();
        if(count($replace) == 0)
        {
            return "Exception : nothing !";
        }
        for($i = 0 ;$i < count($replace); $i ++)
        {
            $qrcode = Qrcode::where('id','=',$replace[$i]['qrcode_id'])->get();
            $client = Client::where('client_number','=',$qrcode[0]['client_id'])->get();
            $replace[$i]['client_name'] = $client[0]['name'];
        }
        return $replace ; 
    }
    // 供稽查员使用,确认更改二维码
    public function confirmqr($replaceid)
    {
        $replace = Replaceqr::find($replaceid);
        
        $replace->state = 1;// 表示确定查看。

        if($replace->save())
        {
            return "it's successful";
        }
        else
        {
            return "Exception : wrong!";
        }
    }
      // 供稽查员使用,确认更改二维码
    public function cancelqr($replaceid)
    {
        $replace = Replaceqr::find($replaceid);
        
        $replace->state = 0;// 表示确定查看。
        if($replace->save())
        {
            return "it's successful";
        }
        else
        {
            return "Exception : wrong!";
        }
    }

    // 稽查员设置错误信息
    public function setClienterror($clientid,$info,$inspactorid)
    {
        $newError = new Clienterror ; 
        $newError->client_id  = $clientid ; 
        $newError->inspactor_id = $inspactorid ; 
        $newError->information_error = $info ;
        if($newError->save ())
        {
            return "It's successful !";
        }
        else
        {
            return "It's wrong !";
        }
    }
    // 返回所有错误信息
    public function getClienterrors()
    {
        $count = Clienterror::all()->count();
    
        $errors = Clienterror::all();
        for($i = 0 ;$i < $count ; $i++)
        {
            $client = Client::where('id','=',$errors[$i]['client_id'])->get()[0];
            $errors[$i]['client_name'] = $client->name;
        }
        return $errors ;
    }
    
    public function deleteClienterror()
    {
        $client = Clienterror::where('id','>=','0'); 
        $client->delete();
    }
}
