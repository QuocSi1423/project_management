<?php

namespace Storage;

use PDOException;
use Exception;
use PDO;

class MailSenderStorage implements IMailSenderStorage{
  private PDOManager $db;
  public function __construct(PDOManager $db = null){

    if(isset($db)){
      $this->db = $db;
    }else{
      $this->db = new PDOManager(null);
    }

  }
  public function insertOTP(int $otp, string $email): void
  {
    try{
      $query = "insert into otp (email, otp) values (?, ?)";
      $stmt = $this->db->getConn()->prepare($query);
      $stmt->execute([$email, $otp]);
    }catch(PDOException $e){
      throw new Exception($e->getMessage(), 500);
    }
  }
  public function getOtp(String $email){
    try{
      $query = "select * from otp where email = ?";
      $stmt = $this->db->getConn()->prepare($query);
      $stmt->execute([$email]);
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      if($data == false){
        throw new Exception("No Otp Found 0".$data, 404);
      }else{
        return $data['otp'];
      }
    }catch(Exception $e){
      if($e->getCode() == 404){
        throw new Exception("No Otp Found 0", 404);
      }else{
        throw new Exception($e->getMessage(), 500);
      }

    }
  }
}