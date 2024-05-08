<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Catalogue,
    Repositories\Back\CatalogueRepository,
    Http\Requests\CatalogueRequest,
    Http\Controllers\Controller
};

class CatalogueController extends Controller
{
    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\CatalogueRepository $repository
     *
     */
    public function __construct(CatalogueRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.catalogue.index',[
            'datas' => Catalogue::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.catalogue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogueRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('back.catalogue.index')->withSuccess(__('New Catalogue Added Successfully.'));
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status($id,$status,$type)
    {
        Catalogue::find($id)->update([$type => $status]);
        return redirect()->route('back.catalogue.index')->withSuccess(__('Status Updated Successfully.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalogue $catalogue)
    {
        return view('back.catalogue.edit',compact('catalogue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogueRequest $request, Catalogue $catalogue)
    {
        $this->repository->update($catalogue, $request);
        return redirect()->route('back.catalogue.index')->withSuccess(__('Catalogue Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalogue $catalogue)
    {
        $this->repository->delete($catalogue);
        return redirect()->route('back.catalogue.index')->withSuccess(__('Catalogue Deleted Successfully.'));
    }
}