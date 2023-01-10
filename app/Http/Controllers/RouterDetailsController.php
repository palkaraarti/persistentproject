<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RouterDetailsImport;
use Maatwebsite\Excel\Facades\Excel;
Use App\Models\ExcelUploadedData;
use App\Models\RouterDetails;
use DB;

class RouterDetailsController extends Controller
{
    protected $_routerdetails;

    public function __construct(){
        $this->_routerdetails = new RouterDetails();
    }
    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */

    public function index(){
        return view('router_details.index');
    }
    /**
     * Upload excel file.
     *
     * return \Illuminate\Http\Response
     */

    public function uploadExcel(Request $request){

        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);
        $data = Excel::toArray(new RouterDetailsImport, $request->file('excel_file'));
        $finalData = collect(head($data));
        return view('router_details.router-details-list', compact('finalData'))->with('success', 'Router Details Uploaded Successfully!');
    }

    public function saveRouterDetails(Request $request){

       $input = $request->all();
       try {
        //  Transacciones
        DB::beginTransaction();                              

        $sapid    = $request->sapid;
        $hostname   = $request->hostname;
        $loopback = $request->loopback;
        $macaddress     = $request->macaddress;                 

        for($count = 0; $count < count($sapid); $count++)
        {
            $insert = array(                        
                'sapid' => $sapid[$count],
                'hostname' => $hostname[$count],
                'loopback' => $loopback[$count],
                'macaddress' => $macaddress[$count]
            );
            $insert_data[] = $insert; 
        }
        RouterDetails::insert($insert_data);
        DB::commit();

    } catch (Exception $e) {
        DB::rollBack();
    }
    return redirect('/upload-route-details')->with('success', 'Router Details Uploaded Successfully!');
    }
}
