<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Bicycle;
use App\Type;
use App\News;

class HomeController extends Controller
{
    public function index()
    {
        return view('content.home' ,['carousel' => $this->carousel(), 'company_news' => News::where('type', '2')->take(2)->orderBy('id', 'desc')->get(), 'bicycle_news' => News::where('type', '1')->take(2)->orderBy('id', 'desc')->get()]);
    }

    public function all()
    {
        return view('content.type', ['bikes' => Bicycle::get()->sortByDesc('wheel_size')]);
    }

    public function types($type)
    {
        if (!Type::where('name_en', $type)->first()) {
            return view('errors.404');
        }
        return view('content.type', ['bikes' => Type::where('name_en', $type)->first()->description()->get()->sortByDesc('wheel_size')]);
    }

    public function bike($type, $name, $size)
    {
        return view('content.bike', ['bike' => Bicycle::where(['name' => $name, 'wheel_size' => $size])->with('colors')->with('attributes')->first(), 'type' => Type::where('name_en', $type)->first()]);
    }

    public function about()
    {
        return view('content.about', ['carousel' => $this->carousel()]);
    }

    public function news()
    {
        return view('content.all_news', ['company_news' => News::where('type', '2')->take(8)->orderBy('id', 'desc')->get(), 'bicycle_news' => News::where('type', '1')->take(8)->orderBy('id', 'desc')->get()]);
    }

    public function newsOne($name)
    {
        return view('content.one_news', ['news' => News::where('name_en', $name)->first()]);
    }

    protected function carousel()
    {
        $path = base_path('public/img/carousel');
        $files = array_diff(scandir($path), array('.','..'));
        foreach ($files as $file) {
            if (preg_match('/^(image)(.*)/', mime_content_type($path . '/' . $file))) {
                $carousel[] = $file;
            }
        }
        return $carousel;
    }

}
