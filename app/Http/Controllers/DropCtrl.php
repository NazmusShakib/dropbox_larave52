<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Laravel\Socialite\Facades\Socialite;

use Dropbox as Drop;

use DB;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Repositories\DropboxStorageRepository;
use League\Flysystem\Filesystem;


class DropCtrl extends Controller
{
    protected $client;

    public function allowForm($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function redirectToProvider($provider)
    {
        $data = array();
        $user = DB::table('users')->where('id', 1)->get();
        if($user[0]->dropbox_token !=null){
            $this->client = new Drop\Client($user[0]->dropbox_token, 'Knowmadic/1.0', 'UTF-8');
            try {
/*              echo "<pre>";
                print_r ($this->client->getMetadataWithChildren('/'));
                echo "</pre>";*/

                //$info = $this->client->getMetaData('/1816.jpg', true);
                //dd($info);

                $fd = fopen("./dropFiles/18sadfasd.jpg", "wb");
                //$metadata = $this->client->getFile("/1816.jpg", $fd);
                //$metadata = $this->client->delete("/photo.jpg");
                //$metadata = $this->client->createFolder("/foo");
                $metadata = $this->client->getMetadataWithChildren('/');
                echo "<pre>";
                    print_r($metadata['contents']);
                echo "</pre>";
                //fclose($fd);
                dd($metadata);
                exit();

                $data['files'] = $this->client->getMetadataWithChildren('/');
                return view('dropbox', ['data' => $data]);

            }catch (Drop\Exception_InvalidAccessToken $e){
                return $this->allowForm($provider);
                exit();
            }

        } else {
            return $this->allowForm($provider);
            exit();
        }
    }


    public function upload_to_dropbox(DropboxStorageRepository $connection)
    {
        $filesystem = $connection->getConnection();
        $file = Input::file('image');
        $filesystem->put($file->getClientOriginalName(), File::get($file));

        // Calling to controller file method and redirect to form view page
        // After redirection user getting acknowledgment of success message
        return Redirect::to('/')->with('success', 'Upload successfully');
    }

    public function  view_details(){

        $user = Socialite::driver('dropbox')->user();

        DB::table('users')
            ->where('id', 1)
            ->update(['dropbox_token' => $user->token]);

        //dd($user);
        $client = new Drop\Client($user->token, 'Knowmadic/1.0', 'UTF-8');

        echo $token = $user->token;
        echo "<br/>";
        echo $user->getEmail();

        echo "<pre>";
        print_r ($client->getMetadataWithChildren('/'));
        echo "</pre>";
    }


}
