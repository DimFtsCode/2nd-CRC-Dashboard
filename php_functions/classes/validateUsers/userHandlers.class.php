<?php

class UserHandlers {

    private $name;
    private $am;
    private $surname;
    private $password;
    private $rePassword;
    private $address;
    private $city;
    private $telephone;
    private $mobile;
    private $rank_id;
    private $ep_id;
    private $s_id;
    private $post = '$_POST';
    
    

   public function post($p) {
       $this->{$p} = $_POST[$p];
   }


   public function getName() {
        return $this->name;
    }

    public function getRePassword() {
        return $this->rePassword;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
    }

    public function getRank_id() {
        return $this->rank_id;
    }

    public function getEp_id() {
        return $this->ep_id;
    }

    public function getS_id() {
        return $this->s_id;
    }

    public function getAm() {
        return $this->am;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAm($am) {
        $this->am = $am;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }
    public function setRePassword($rePassword) {
        $this->rePassword = $rePassword;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setRank_id($rank_id) {
        $this->rank_id = $rank_id;
    }

    public function setEp_id($ep_id) {
        $this->ep_id = $ep_id;
    }

    public function setS_id($s_id) {
        $this->s_id = $s_id;
    }

    public function setPost($post) {
        $this->post = $post;
    }

        public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

