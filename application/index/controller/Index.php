<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        $books = Db::name('book')->field('name,book_id')->select();
        $this->assign('books',$books);
        return $this->fetch();
    }
    public function book()
    {
        $book_id = input('book_id');
        $book = Db::name('chapter')->where('book_id',$book_id)->field('page_id,title')->order('page_id asc')->select();
        $this->assign('book',$book);
        return $this->fetch();
    }
    public function page()
    {
        $page = input('page_id');
        $chapter = Db::name('chapter')->where('page_id',$page)->find();
        $content = file_get_contents($chapter['file_path']);
        $this->assign('content',$content);
        $this->assign('chapter',$chapter);
        return $this->fetch();
    }

}
