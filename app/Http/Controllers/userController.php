<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Song;
use App\Models\Album;
use App\Models\Artist;
class userController extends Controller
{
    public function home(){
        

        $artists = Artist::all();
        $artists6 = Artist::take(7)->get();
        $songs = Song::all();
        $videos = Song::all();
        $songs12 = Song::take(12)->get();
        $videos12 = Song::take(12)->get();
        $songs6 = Song::take(6)->get();
        $songs4 = Song::take(4)->get();
        $albumsid = Album::all();
        $albums = Album::all()
        ->join('artists','albums.artist_id','=','artists.id');
        $albums6= Album::take(6)
        ->join('artists','albums.artist_id','=','artists.id')
        ->get();

       
        

        // return $songs;
        return view('user.home',
         [
        'songs' => $songs,
        'songs12' => $songs12,
        'videos12' => $videos12,
        'songs6' => $songs6,
        // 'albums' => $albums,
        'albumsid' => $albumsid,
        'albums6' => $albums6,
        'artists' => $artists,
        'artists6' => $artists6
        ]);


    }

    public function song(){
        $songs = Song::all();
        return view('user.song' , ['songs' => $songs]);
    }

    public function video(){
        $videos = Song::all();
        return view('user.video' , [ 'videos' => $videos,]);
    }

    public function album(){
        $albums = Album::all();
        $songs4 = Song::take(4)->get();
        $albums4= Album::take(4)
        ->join('artists','albums.artist_id','=','artists.id')
        ->get();
        return view('user.album' , [ 'albums' => $albums, 'songs4' => $songs4, 'albums4' => $albums4]);
    }

    public function event(){
        return view('user.event');
    }
    public function news(){
        return view('user.news');
    }

    public function contact(){
        return view('user.contact');
    }

    public function elements(){
        return view('user.elements');
    }

    public function login(){
        return view('user.login');
    }
    public function  register(){
        return view('user.register');
    }



}
