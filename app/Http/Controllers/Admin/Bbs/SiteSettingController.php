<?php

namespace App\Http\Controllers\Admin\Bbs;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class SiteSettingController extends Controller
{
    public function index(Request $request)
    {
        $filename = '/site.json';
        $dir = storage_path('administrator_settings');
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $folder = $dir . $filename;

        if ($request->getMethod() === 'POST') {
            $data = $request->all();

            $_data = [
                'site_name' => $data['site_name'],
                'contact_email' => $data['contact_email'],
                'seo_description' => $data['seo_description'],
                'seo_keyword' => $data['seo_keyword']
            ];

            $result = file_put_contents($folder, json_encode($_data), LOCK_EX);
            if (false === $result) {
                return $this->returnJson(2, '', '论坛站点信息设置失败！');
            }
            return $this->returnJson(1, route('admin.bbs.site'), '论坛站点信息设置成功！');
        } else {
            if (file_exists($folder)) {
                $data = file_get_contents($folder);
                $data = json_decode($data);

                return view('admin.bbs.setting.site', compact('data'));
            }
        }
    }
}
