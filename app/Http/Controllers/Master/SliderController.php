<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index() {
        $sliders = slider::orderBy('id', 'ASC')->get();

        return view('master.slider.index', compact('sliders'));
    }

    public function create() {
        return view('master.slider.create');
    }

    public function createAction(Request $r) {
        $r->validate([
            'title' => 'required',
            'note' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $image = $r->file('image');
        $upload_location = null;
        if ($image->isValid()) {
            $filename = Str::random(10) . '.' . $image->extension();
            $image->storeAs('public/images', $filename);
            $upload_location = '/storage/images/' . $filename;
        } else {
            return redirect('/master-slider')->with('danger', 'Gagal mengupload image.');
        }

        $slider = new Slider;
        $slider->title = $r->title;
        $slider->note = $r->note;
        $slider->image_path = $upload_location;
        $slider->save();

        return redirect('/master-slider')->with('success', 'Data Master Slider berhasil ditambahkan.');
    }

    public function update($id) {
        $slider = Slider::where('id', $id)->first();
        if (!$slider) {
            return redirect('/master-slider')->with('danger', 'Data Master Slider dengan ID #' . $id . ' tidak ditemukan.');
        }

        return view('master.slider.update', compact('slider'));
    }

    public function updateAction(Request $r, $id) {
        $slider = slider::find($id);
        if (!$slider) {
            return redirect('/master-slider')->with('danger', 'Data Master Slider dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            $r->validate([
                'title' => 'required',
                'note' => 'required'
            ]);

            if ($r->hasFile('image')) {
                $r->validate(['image' => 'mimes:jpeg,jpg,png']);

                $image = $r->file('image');
                if ($image->isValid()) {
                    $filename = Str::random(10) . '.' . $image->extension();
                    $image->storeAs('public/images', $filename);
                    $upload_location = '/storage/images/' . $filename;
                } else {
                    return redirect('/master-slider')->with('danger', 'Gagal mengupload image.');
                }
            }

            $slider->title = $r->title;
            $slider->note = $r->note;
            $slider->image_path = $upload_location ?? $slider->image_path;
            $slider->save();

            return redirect('/master-slider')->with('success', 'Data Master Slider dengan ID #' . $id . ' berhasil diubah.');
        }
    }

    public function delete($id) {
        $slider = Slider::where('id', $id)->first();
        if (!$slider) {
            return redirect('/master-slider')->with('danger', 'Data Master Slider dengan ID #' . $id . ' tidak ditemukan.');
        }
        
        return view('master.slider.delete', compact('slider'));
    }

    public function deleteAction($id) {
        $slider = Slider::where('id', $id)->first();
        if (!$slider) {
            return redirect('/master-slider')->with('danger', 'Data Master Slider dengan ID #' . $id . ' tidak ditemukan.');
        } else {
            Slider::where('id', $id)->delete();

            return redirect('/master-slider')->with('success', 'Data Master Slider dengan ID #' . $id . ' berhasil dihapus.');
        }
    }
}
