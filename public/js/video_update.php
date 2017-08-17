<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class video_update extends Controller
{
    //



    public function create(Request $request)
    {
        //


        $user_email=\Auth::user()->email;
        $video_id = $_POST['video_id'];





        $ch=\DB::table('UserVideoData')->where('user_email', $user_email )->update(['video'.$video_id => true]);
        $uvd = \DB::table('uservideodata')->select('updated_at')
            ->where('user_email',$user_email)->first();


        //$uvd = \DB::table('uservideodata')->select('video1','video2','video3','video4','video5','video6','video7','video8','video9','video10','video11','video12')
          //  ->where('user_email',$user_email)->first();


        header('Content-type: image/jpeg');


        $jpg_image = imagecreatefromjpeg('certificate.jpg');


        $color = imagecolorallocate($jpg_image, 10, 10, 10);

        $date=date('M j Y ', strtotime($uvd->updated_at));
        $name = \Auth::user()->name;
        $license=\Auth::user()->license_number;


        $font_path = 'fonts/font2.TTF';


        $text = "This is a sunset!";
        $fontSize=10;

        imagettftext($jpg_image, 20, 0, 275, 315, $color, $font_path, $name);
        imagettftext($jpg_image, 20, 0, 355, 315, $color, $font_path, "on ");
        imagettftext($jpg_image, 20, 0, 400, 315, $color, $font_path, $date);
        imagettftext($jpg_image, 20, 0, 450, 360, $color, $font_path, $license);



        imagejpeg($jpg_image,'images/certi/'.Auth::user()->id.'.jpg');


        //imagedestroy($jpg_image);
        //imagejpeg($jpg_image,'test.jpg');






        if ($ch > 0) {
            //$msg = 'done adding';

            $next="dashboard/video/".$video_id+1;

            //return \Redirect::to($next);


            header('Location: https://ecertifyeducation.com/'.$next);


        }

        if($video_id==12 && $uvd->video1 && $uvd->video2 && $uvd->video3 && $uvd->video4 && $uvd->video5 && $uvd->video6 &&
            $uvd->video7 && $uvd->video8 && $uvd->video9 && $uvd->video10 && $uvd->video11 ){


            header('Location: https://ecertifyeducation.com/dashboard');
        }



    }

}
