<?php

class Entry{

    private $id;
    private $author_id;
    private $title;
    private $content;
    private $fecha;
    private $active;

    public function __construct($id, $author_id, $title, $content, $fecha, $active){
        $this->id = $id;
        $this->author_id = $author_id;
        $this->title = $title;
        $this->content = $content;
        $this->fecha = $fecha;
        $this->active = $active;
    }

    public function get_id(){
        return $this->id;
    }
    public function get_author_id(){
        return $this->author_id;
    }
    public function get_title(){
        return $this->title;
    }
    public function get_content(){
        return $this->content;
    }
    public function get_fecha(){
        return $this->fecha;
    }
    public function get_active(){
        return $this->active;
    }

    public function set_title($value){
        $this->title = $value;
    }
    public function set_content($value){
        $this->content = $value;
    }
    public function set_fecha($value){
        $this->fecha = $value;
    }
    public function set_active($value){
        $this->active = $value;
    }
}