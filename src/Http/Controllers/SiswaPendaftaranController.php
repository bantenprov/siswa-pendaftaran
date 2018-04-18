<?php namespace Bantenprov\SiswaPendaftaran\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\SiswaPendaftaran\Facades\SiswaPendaftaran;
use Bantenprov\SiswaPendaftaran\Models\SiswaPendaftaranModel;

/**
 * The SiswaPendaftaranController class.
 *
 * @package Bantenprov\SiswaPendaftaran
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SiswaPendaftaranController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = [];
        $kegiatan = $this->kegiatanModel->all();
        $users_special = $this->user->all();
        $users_standar = $this->user->find(\Auth::User()->id);
        $current_user = \Auth::User();
        $role_check = \Auth::User()->hasRole(['superadministrator','administrator']);
        if($role_check){
            $response['user_special'] = true;
            foreach($users_special as $user){
                array_set($user, 'label', $user->name);
            }
            $response['user'] = $users_special;
        }else{
            $response['user_special'] = false;
            array_set($users_standar, 'label', $users_standar->name);
            $response['user'] = $users_standar;
        }
        array_set($current_user, 'label', $current_user->name);
        $response['current_user'] = $current_user;
        $response['kegiatan'] = $kegiatan;
        $response['status'] = true;
        return response()->json($response);
    }
}
