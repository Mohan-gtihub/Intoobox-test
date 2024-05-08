<?php

namespace App\Repositories\Back;

use App\{
    Models\Catalogue,
};
use App\Helpers\ImageHelper;
use App\Helpers\PdfHelper;

class CatalogueRepository
{

    /**
     * Store meal.
     *
     * @param  \App\Http\Requests\ImageStoreRequest  $request
     * @param  \App\Http\Requests\PdfStoreRequest  $request
     * @return void
     */

    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'assets/images');
        $input['pdf'] = PdfHelper::handleUploadedPdf($request->file('pdf'),'assets/pdf');
        Catalogue::create($input);
    }

    /**
     * Update Brand.
     *
     * @param  \App\Http\Requests\ImageUpdateRequest  $request
     * @param  \App\Http\Requests\PdfUpdateRequest  $request
     * @return void
     */

    public function update($catalogue, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images',$catalogue,'/assets/images/','photo');
        }
        
        if ($file = $request->file('pdf')) {
            $input['pdf'] = PdfHelper::handleUpdatedUploadedPdf($file,'/assets/pdf',$catalogue,'/assets/pdf/','pdf');
        }
        $catalogue->update($input);
    }

    /**
     * Delete brand.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($catalogue)
    {
        ImageHelper::handleDeletedImage($catalogue,'photo','assets/images/');
        PdfHelper::handleDeletedPdf($catalogue,'pdf','assets/pdf/');
        $catalogue->delete();
    }

}