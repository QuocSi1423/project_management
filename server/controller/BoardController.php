<?php

namespace Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Service\BoardService;
use Exception;

class BoardController{
  private BoardService $service;
  public function __construct(BoardService $service)
  {
    $this->service = $service;
  }
  public function GetBoads(Request $req, Response $res){
    try{
      $boards = $this->service->GetBoardsOfProject($req->getAttribute('project_id'));
      $res = $res->withStatus(200);
      $res->getBody()->write(json_encode($boards));
      return $res;
    }catch(Exception $e){
      if($e->getCode() == 400){
        $res = $res->withStatus(400);
        $res->getBody()->write($e->getMessage());
      }else{
        $res = $res->withStatus(500);
        $res->getBody()->write($e->getMessage());
      }
      return $res;
    }
  }

  public function changeWorkflow(Request $req, Response $res){
    $body = $req->getBody()->getContents();
    $data = json_decode($body);
    try{
      $this->service->updatePreviuosBoard($req->getAttribute('board_id'), $data->previous_board_id);
      $res = $res->withStatus(200);
      $res->getBody()->write(json_encode(8));
    }catch(Exception $e){
      
      $res = $res->withStatus(500);
      $res->getBody()->write($e->getMessage());
    }
    return $res;
  }
}