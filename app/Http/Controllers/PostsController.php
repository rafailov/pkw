<?php

namespace App\Http\Controllers;

use Mail;
use App\Posts;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{

    public function index()
    {

        return view('posts');

    }

    public function adminIndex()
    {

        $postsData = Posts::orderBy('post_id', 'DESC')->paginate(10);

        return view('admin.list.posts', [
            'postsData' => $postsData
        ]);

    }

    public function store(Request $request)
    {

        $inputData = $request->all();
//        return dump($inputData);

        $tryCreatePost = Posts::sendPosts($inputData);

        switch ($tryCreatePost[0]) {
            case 'validationError':
                return back()->withInput()->withErrors($tryCreatePost[1]);
            case 'creatingError':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':

                $data = $request->only('post_name', 'post_email', 'post_text');
                if (!empty($data['post_email'])) {
                    $data['messageLines'] = explode("\n", $request->get('post_text'));

                    Mail::send('emails.posts', $data, function ($message) use ($data) {
//                    $message->from($data['send_email'], $data['send_name']);
//                        $message->to('pekave85@abv.bg', 'Info')->subject('Оставено мнение от клиент в сайта PKW.bg');
                        $message->bcc('boqnognqnov@gmail.com', 'Info')->subject('Оставено мнение от клиент в сайта PKW.bg');
                        $message->bcc('alarma7a@gmail.com', 'Info')->subject('Оставено мнение от клиент в сайта PKW.bg');
                    });
                }

                return redirect()->back()->with('successMessage', 'Вашето мнение е добавено успешно! Моля изчакайте то да бъде одобрено от администратор.');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }

    }

    public function approve(Request $request)
    {

        $inputData = $request->get('post_id');

        $tryApprovePost = Posts::approvePost($inputData);

        switch ($tryApprovePost) {
            case 'errorMessage':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':
                return redirect()->back()->with('successMessage', 'Данните са променени успешно!');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }

    }

    public function reject(Request $request)
    {

        $inputData = $request->get('post_id');

        $tryRejectPost = Posts::rejectPost($inputData);

        switch ($tryRejectPost) {
            case 'errorMessage':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':
                return redirect()->back()->with('successMessage', 'Данните са променени успешно!');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }

    }

    public function destroy(Request $request)
    {

        $inputData = $request->get('post_id');

        $tryDeletePost = Posts::deletePost($inputData);

        switch ($tryDeletePost) {
            case 'errorMessage':
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
            case 'successMessage':
                return redirect()->back()->with('successMessage', 'Данните са изтрити успешно!');
            default:
                return back()->withInput()->withErrors('Проблем, моля опитай те по късно!');
        }

    }

}
