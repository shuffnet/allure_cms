<?php

namespace App\Http\Controllers;

use App\ShotList;
use App\ShotListShots;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Http\Request;

use App\Http\Requests;

class ShotListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shots = ShotList::all();


        return view('shotList.index')->withShots($shots);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxGetShot($id)
    {
//       $shots = ShotList::all();
        $shot = ShotlistShots::all();


        return ($shot);


    }
    public function ajaxGetShots($id)
    {




    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, array(

            'name' => 'required|unique:shot_lists|max:255',
            'time' => 'required|max:255',




        ));

        //Store in the database

        $shot = new ShotList();
        $shot->name = $request->name;

        $shot->time = $request->time;

        $shot->tips = $request->tips;




        $shot->save();
        if ($request->shots){
            foreach ($request->shots as $shotsB) {
                $shots  = new ShotListShots();
                $shots->shot = $shotsB;
                $shots->shot_list_id = $shot->id;
                $shots->save();


            }

    }





        Session::flash('success', 'The Shot was successfully saved!');

//        return redirect()->route('shotList.index');
        return Redirect::back();
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
        //
       $shot = ShotList::find($id);
       return view('shotList.edit')->withShot($shot);

//        return redirect()->route('shotList.edit');
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
        //
        $shot = ShotList::find($id);

        $shot->name = $request->name;

        $shot->time = $request->time;

        $shot->tips = $request->tips;




        $shot->save();
        if ($request->shots) {

            foreach ($request->shots as $shotsB) {
                $shots  = new ShotListShots();
                $shots->shot = $shotsB;
                $shots->shot_list_id = $shot->id;
                $shots->save();
            }

}









    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //


    }
    public function deleteShot($id)
    {
        $shot = ShotList::find($id);
        $shot->delete();
        $shot->get_shots()->delete(array());
        return Redirect::back();

    }
}
