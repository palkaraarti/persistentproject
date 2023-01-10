<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouterDetails extends Model
{
    use HasFactory;

    protected $table = "router_details";
    protected $fillable = [
        'sapid','hostname','loopback','macaddress'
    ];

    public function validateRouterData($insert_data){
        
        foreach($insert_data as $key => $val){
            if(empty($val['sap_id']) && empty($val['sap_id']) && empty($val['sap_id']) && empty($val['sap_id'])){
               return false;
               break;
            }    
        }
    }
}
