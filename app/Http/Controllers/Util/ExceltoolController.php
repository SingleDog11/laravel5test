<?php

namespace App\Http\Controllers\Util;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel ;
use App\Qrcode ;
use App\Client ; 

class ExceltoolController extends Controller
{
    //
    public function outface()
    {
        // Client::where('id','>=','0')->delete();
        // Qrcode::where('id','>=','0')->delete();
        // $this->toolimport();
        
        // $this->change();
    }
   
   private function change()
   {
    //    $client1 = Client::where('factory_id','=','133000100008007497614')->get();
    //    $client2 = Client::find($client1[0]['id']);
    //    $client2->factory_id = $client2->factory_id.'4';
    //    if($client2->save())
    //    {
    //         echo "the data is success!";
    //         echo "</br>";
    //    }

       $client1 = Client::where('factory_id','=','133000100008000923931')->get();
       
       $client2 = Client::find($client1[0]['id']);
       $client2->factory_id = $client2->factory_id.'3'; 
       if($client2->save())
       {
            echo "the data is success!";
            echo "</br>";
       }
    //    $client1 = Client::where('factory_id','=','133000100008007458997')->get();

    //    $client2 = Client::find($client1[0]['id']);
    //    $client2->factory_id = $client2->factory_id.'9';
    // //    $client1[0]['factory_id'] = $client1[0]['factory_id'] . '9';
    //    if($client2->save())
    //    {
    //         echo "the data is success!";
    //         echo "</br>";
    //    }
   }

    private function toolimport()
    {
        $filePath = '/storage/excel/'.iconv('UTF-8','GBK','dataexcel').'.xlsx';
        Excel::load($filePath,function($reader){
        $data = $reader->get()->toArray();
 
 
        $length = count($data);
        for($i = 0 ;$i < $length ;$i ++)
        {
            // Client::destroy($i);
            // Qrcode::destroy($i);

            $qrclient = new Qrcode ;
            $qrclient->client_id   = $data[$i]['client_number'];
            $qrclient->qrcode         = md5(uniqid());
            if($qrclient->save())
            {
                echo "the data is success!";
                echo "</br>";
            }
            else {
                echo "the data is wrong!";
                echo "</br>";
            }

            $client = new Client ; 
            $client->client_number      = $data[$i]['client_number'];
            $client->name               = $data[$i]['name'];
            $client->address            = $data[$i]['address'];
            $str = '1330001'.$data[$i]['factory_id'];
            // echo $data[$i]['factory_id'];
            echo "<br/>";
            echo $str;
            $client->factory_id         = $str;
            
            $client->elec_scale         = $data[$i]['elec_scale'];
            $client->elec_name          = $data[$i]['elec_name'];
            $client->elec_source        = $data[$i]['elec_source'];
            $client->elec_type          = $data[$i]['elec_type'];
            $client->elec_lastmonth_num = $data[$i]['elec_lastmonth_num'];
            $client->elec_currmonth_num = $data[$i]['elec_currmonth_num'];
            $client->elec_copy_num      = $data[$i]['elec_copy_num'];
            $client->elec_cost          = $data[$i]['elec_cost'];

            if($client->save())
            {
                echo "it's ".$i."successful !";
                echo "</br>";
            }
            else
            {
                echo "it's ".$i."wrong !";
                echo "</br>";
            }
        }
    });
    }
}
