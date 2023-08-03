<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulskillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $skill = Skill::all();

      return view('admin.skill.index', [
        'folder' => 'modulskill',
        'menu' => 'modulskill',
        'skill' => $skill
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skill = Skill::all();

        return view('admin.skill.create', [
          'folder' => 'modulskill',
          'menu' => 'modulskill',
          'skill' => $skill
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$post = Post::create($request->all());
      //  $skill = Skill::all();
        $this->validate($request,[
          'keahlian' => 'required',
          'value' => 'required'
        ]);

        $skill = Skill::create([
          'keahlian' => $request->keahlian,
          'value' => $request->value
        ]);

        return redirect()->route('modulskill.index')->with('success','Skill berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $skill = Skill::findorfail($id);

      return view('admin.skill.edit', [
        'folder' => 'modulskill',
        'menu' => 'modulskill',
        'skill' => $skill
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $this->validate($request,[
        'keahlian' => 'required',
        'value' => 'required'
      ]);

      $skill = Skill::findorfail($id);

      $skill_data = [
        'keahlian' => $request->keahlian,
        'value' => $request->value
      ];

      $skill->update($skill_data);

      return redirect()->route('modulskill.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $skill = Skill::findorfail($id);
      $skill->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
