<?php

namespace App\Repositories;

use League\Flysystem\Dropbox\DropboxAdapter;
use League\Flysystem\Filesystem;
use Dropbox\Client;
use DB;

class DropboxStorageRepository{

    protected $client;
    protected $adapter;
    public function __construct()
    {
        $user = DB::table('users')->where('id', 1)->get();
        
        $this->client = new Client($user[0]->dropbox_token, 'devartisans_testapp', null);

        $this->adapter = new DropboxAdapter($this->client);
    }
    public function getConnection()
    {
        return new Filesystem($this->adapter);
    }
}
