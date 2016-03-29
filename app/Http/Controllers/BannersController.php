<?php

namespace App\Http\Controllers;

use App\Banner;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BannersController extends Controller {

    protected $baseDir = 'photos/banners';

    /**
     * Adds an image to a banner.
     *
     * @param Request $request
     */
    public function addBanner(Request $request)
    {
        $name = $request->get('name');
        $path = $this->makePhoto($request->file('file'), $name);

        Banner::findByName($name)->update(['path' => $path]);
    }

    /**
     * Remove the image from a banner.
     *
     * @param Request $request
     */
    public function removeBanner(Request $request)
    {
        $name = $request->get('name');
        Banner::findByName($name)->update(['path' => ""]);
    }

    /**
     * Make the photo and move it to the proper directory.
     *
     * @param UploadedFile $file
     * @param $name
     * @return string
     */
    protected function makePhoto(UploadedFile $file, $name)
    {
        try
        {
            $file->move($this->baseDir, $name . '.' . $file->getClientOriginalExtension());
        } catch (Exception $e)
        {
            return "Cannot move file";
        }
        $path = sprintf("%s/%s", $this->baseDir, $name . '.' . $file->getClientOriginalExtension());

        return $path;
    }
}
