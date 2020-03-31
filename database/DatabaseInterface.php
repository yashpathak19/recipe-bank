<?php
interface DatabaseInterface{
    //my interface setting the rules for classes which will use crud functionality
    public function show($dbcon);
    public function create($dbcon,$desc);
    public function del($dbcon,$id);
    public function update($dbcon,$comment_desc,$id);

}