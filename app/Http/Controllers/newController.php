<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;


class newController extends Controller
{
    /**
     * Отображает список статей
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        if ($articles == null) return view('articles.create');
        else return view('articles.index', compact('articles'));
    }

    /**
     * Выводит форму для создания новой статьи
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Помещает созданный статью в хранилище
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'header' => 'required|max:50',
            'short_text' => 'required|max:150',
            'article' => 'required|max:5000',
            'image' => 'required|image|mimetypes:image/jpeg,image/png',
        ]);

        $vals=$request->all();
        $vals['image'] = Str::replaceFirst('public', '/storage', $this->upload($request));
        Article::create($vals);

        return redirect()->route('articles.index')->with('success','Post created successfully.');
    }

    /**
     * Отображает указанную статью.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.newView',compact('article'));
    }

    /**
     * Выводит форму для редактирования указанного ресурса
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit',compact('article'));
    }

    /**
     * Обновляет указанный ресурс в хранилище
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'header' => 'required|max:50',
            'short_text' => 'required|max:150',
            'article' => 'required|max:5000',
            'image' => 'required|image|mimetypes:image/jpeg,image/png',
        ]);

        $vals=$request->all();
        $vals['image'] = Str::replaceFirst('public', '/storage', $this->upload($request));
        $article->update($vals);


        return redirect()->route('articles.index')->with('success','Post updated successfully');
    }

    /**
     * Удаляет указанный ресурс из хранилища
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success','Article deleted successfully');
    }

    /*
    * Загружает файл в хванилище, предварительно созданное командой
    * php artisan storage:link
    */
    public function upload(Request $request)
    {
        return  $request->file('image')->store('public/images');
    }


}
