<?php

namespace App\Http\Controllers\TrangChu;

use App\Http\Controllers\Controller;

use App\Models\CCCD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;


class TrangChuController extends Controller
{
    public function trangchu()
    {
        return view('trang-chu.trang-chu', [
            'title' => "Truy xuất thông tin",
        ]);
    }

    public function upload(Request $request){
        return view('trang-chu.upload-anh', [
            'title' => "Truy xuất thông tin",
        ]);
    }

    public function realtime(Request $request){
        return view('trang-chu.real-time', [
            'title' => "Truy xuất thông tin",
        ]);
    }
}


