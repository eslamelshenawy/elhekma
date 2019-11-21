<?php
namespace App\Http\lib;


use Illuminate\Support\Facades\URL;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;


class Helper
{
    private static $_instance;

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function upload($files, $dir, $method = false, $old_media_id = false)
    {
        try {
            if ($method == 'edit' && $old_media_id != 0) {
                $current_media = Media::findFirst(['id' => $old_media_id]);
                if ($current_media) {
                    $file = public_path('imageLibrary/products/' . $current_media->media_path);
                    if (file_exists($file))
                        unlink($file);
                    $current_media->delete();
                }
            }
            $file = $files[0];
            $media_title = $file->getClientOriginalName();
            $file_name = substr(md5(time()), 0, 15);
            $extension = $file->getClientOriginalExtension();
            $fileName = $file_name . "." . $extension;
            $destinationPath = public_path('imageLibrary/' . $dir . '/');
            $file->move($destinationPath, $fileName);
            $sizes = getimagesize(URL::to('imageLibrary/' . $dir . '/' . $fileName));
            $media = Media::add(['media_path' => $fileName, 'media_title' => $media_title, 'media_width' => $sizes[0], 'media_height' => $sizes[1], 'media_type' => $sizes['mime']]);
            return $media->id;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public static function role($role_name)
    {
        $roles = [
            'super-admin' => 1,
            'shop' => 2,
        ];
        return $roles[$role_name];
    }

    public static function imageFromUrl($url)
    {
        $media_title = pathinfo($url)['filename'];
        $extension = pathinfo($url)['extension'];
        $filename = $media_title . '_' . time() . '_' . $extension;

        $destinationPath = storage_path('app/public/admin/images');
        //$media_path = public_path('imageLibrary/avatar/' . $filename);
        $media_path = $destinationPath . $filename;
        \Image::make($url)->save($media_path);
        ///$media = Media::add(['media_path' => $filename, 'media_title' => $media_title, 'media_type' => 'image/' . $extension]);
        return 'images/'.$filename;
    }

    public static function GetOrderName($vendor, $count)
    {
        $words = preg_split("/[\s,_-]+/", $vendor);
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= $w[0];
        }
        return strtoupper($acronym) . ($count ? 1 : $count + 1);
    }


    public static function ArrayToString($array)
    {
        return implode (', ', $array );
    }


    public static function SendPushNotificationToSingleUser($title, $message, $token)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        // $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        /*
        $user = UserDeviceToken::first();

        $token = $user->device_token;
        */

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        //dd($downstreamResponse->numberSuccess(),$downstreamResponse->numberFailure(),$downstreamResponse->numberModification());

        //return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        //return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

        //return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();
    }

    public static function SendPushNotificationToMultiUser($title, $message , $tokens)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // You must change it to get your tokens
       // $tokens = UserDeviceToken::pluck('device_token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        //return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        //return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

        //return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array
        $downstreamResponse->tokensWithError();
    }

}