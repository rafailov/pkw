<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NewsSubcrEntity;
use App\CommentSubcrEntity;
use Log;
use  Illuminate\Support\Str;


class CommentEntity extends Model
{
    protected $table = 'comments';

    /*
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function news()
    {
        return $this->belongsTo('App\NewsEntity');
    }

    /*
 * Return rules for laravel validator
 */
    public static function getRules()
    {
        return [
            'name' => 'required|min:3|max:60',

            'email' => 'required|email|max:60',
            'comment' => 'required|min:2',

            'news_id' => 'required|exists:news,id',
//            'subscribe_news' => 'boolean',
//            'subscribe_comments' => 'boolean'
        ];
    }

    /*
     * Return error messages for laravel validator
     */
    public static function getMessegess()
    {
        return [
            'name.required' => trans('comments.required_name'),
            'name.min' => trans('comments.short_name_length'),
            'name.max' => trans('comments.long_name_length'),

            'email.required' => trans('comments.required_email'),
            'email.email' => trans('comments.email_format'),
            'email.max' => trans('comments.long_email_length'),
            'comment.required' => trans('comments.required_comment'),

            'news_id.required' => trans('comments.required_news'),
            'news_id.exists' => trans('comments.news_dont_exits'),
            'subscribe_news.boolean' => trans('comments.format_subscribe_news'),
            'subscribe_comments.boolean' => trans('comments.format_subscribe_comments')
        ];
    }

    public static function add($data)
    {

        if (isset($data['subscribe_news'])) {
            $data['subscribe_news'] = true;
        } else {
            $data['subscribe_news'] = false;
        }
        if (isset($data['subscribe_comments'])) {
            $data['subscribe_comments'] = true;
        } else {
            $data['subscribe_comments'] = false;
        }


        $validator = \Validator::make($data, self::getRules(), self::getMessegess());

        if ($validator->fails()) {
            return array('validationError', $validator);
        }

        try {
            $comment = new CommentEntity();
            $comment->name = $data['name'];

            $comment->email = $data['email'];
            $comment->comment = $data['comment'];

            $comment->news_id = $data['news_id'];
            $key = Str::random(60);

            self::recordNewsSubscription($data['email'], $data['subscribe_news'], $key, $data['name']);

            self::recordCommentsSubscription($data['email'], $data['subscribe_comments'], $key, $data['news_id'], $data['name']);

            $comment->save();
        } catch (\Exception $ex) {
            \Log::error($ex);
            return array('creatingError', $ex);
        }

        return array('success', $comment);
    }

    private static function  recordNewsSubscription($email, $subscribe_news, $token, $name)
    {

        $newsS = NewsSubcrEntity::where('email', '=', $email)->first();
        if (empty($newsS)) {
            $newsS = new NewsSubcrEntity();
            $newsS->email = $email;
        }

        if ($subscribe_news == true) {
            $newsS->subscription = $subscribe_news;
        }
        $newsS->name = $name;
        $newsS->unsubscribe_key = $token;
        $newsS->save();


    }

    private static function  recordCommentsSubscription($email, $subscribe_comments, $token, $newsId, $name)
    {
        $commS = CommentSubcrEntity::where('email', '=', $email)->first();
        if (empty($commS)) {
            $commS = new CommentSubcrEntity();
            $commS->email = $email;
        }
        if ($subscribe_comments == true) {
            $commS->subscription = $subscribe_comments;
        }

        $commS->name = $name;
        $commS->unsubscribe_key = $token;
        $commS->news_id = $newsId;
        $commS->save();

    }

}
