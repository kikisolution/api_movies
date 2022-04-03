<?php

namespace Source\Api\Controllers;

use Source\Api\Controllers\AuthController;
use Source\Api\Models\FavoritMovie;

class FavoritController
{

    public function __construct()
    {
        //Check Validate Access
        if (!AuthController::checkAuth()) {
            $arrResponse = ["status" => "error", "message" => "Acesso Negado!"];
            toJson($arrResponse);
        }
    }

    public function list(array $data): void
    {

        $favorite = new FavoritMovie();
        $favorits = $favorite->find("user_hash = :user_hash", "user_hash={$data['hashUser']}")->fetch(true);

        if($favorits){

            $arrFavorits = [];
            foreach($favorits as $favoriteItem){
                array_push($arrFavorits, $favoriteItem->data());
            }

            $arrResponse = [
                "status" => "success",
                "results" => $arrFavorits,
            ];

        }else{

            $arrResponse = [
                "status" => "error",
                "message" => " <h2>Oooops, </h2>
                               <p>Parece que voce ainda não tem favoritos salvos!.</p>
                               <p>Faça uma pesquisa e começe a favoritar.</p>",
            ];

        }

        toJson($arrResponse);

    }

    public function delete(array $data): void
    {

        $favorite = (new FavoritMovie())->findById($data['id']);
        if($favorite->destroy()){
            $arrResponse = [
                "status" => "success",
                "message" => "Favorito Removido!",
            ];
        }else{
            $arrResponse = [
                "status" => "error",
                "message" => "Oooops, algo deu errado...",
            ];
        }

        toJson($arrResponse);

    }

    public function add(array $data): void
    {

        //Check if id movie exists
        if((new FavoritMovie())->find("id_movie = :id_movie AND user_hash = :user_hash", "id_movie={$data['id']}&user_hash={$data['user_hash']}")->fetch(true)){

            $arrResponse = [
                "status" => "error",
                "message" => "Você já favoritou essa mídia",
            ];

            toJson($arrResponse);

        }

        $favorite = new FavoritMovie();

        $favorite->id_movie = $_POST['id'];
        $favorite->user_hash = $_POST['user_hash'];
        $favorite->title = $_POST['title'];
        $favorite->adult = $_POST['adult'];
        $favorite->poster_path = $_POST['poster_path'];
        $favorite->backdrop_path = $_POST['backdrop_path'];
        $favorite->original_language = $_POST['original_language'];
        $favorite->original_title = $_POST['original_title'];
        $favorite->popularity = $_POST['popularity'];
        $favorite->release_date = $_POST['release_date'];
        $favorite->video = $_POST['video'];
        $favorite->vote_average = $_POST['vote_average'];
        $favorite->vote_count = $_POST['vote_count'];
        $favorite->save();

        if(!$favorite->fail()){

            $arrResponse = [
                "status" => "success",
                "message" => "Adicionado aos favoritos!",
            ];

        }else{

            $arrResponse = [
                "status" => "error",
                "message" => "Ooops, algo deu errado, tente novamente mais tarde.",
            ];

        }

        toJson($arrResponse);

    }

}