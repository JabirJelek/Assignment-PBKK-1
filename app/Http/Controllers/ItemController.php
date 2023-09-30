<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    //

    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string',
            'age' => ['required', 'numeric', 'between:2.5,99'],
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if (!$this->isValidImage($image)) {
                return redirect()->back()->withErrors(['image' => 'Unsupported image format. Please choose a PNG, JPG, or JPEG image.']);
            }

            if (!$this->isImageSizeValid($image)) {
                return redirect()->back()->withErrors(['image' => 'File size exceeds the maximum allowed limit of 2MB.']);
            }

            $imagePath = $image->store('images', 'public');
        }

        $item = new Item([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('content'),
            'age' => $request->input('age'),
            'image_path' => isset($imagePath) ? $imagePath : null,
        ]);

        $item->save();

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }


    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function destroy(Item $item)
    {
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

    private function isValidImage($image)
    {
        $imageExtensions = ['png', 'jpg', 'jpeg'];
        $extension = $image->getClientOriginalExtension();

        return in_array($extension, $imageExtensions);
    }
    private function isImageSizeValid($image)
    {
        $maxSize = 2 * 1024 * 1024;

        return $image->getSize() <= $maxSize;
    }
    public function update(Request $request, Item $item)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
            'age' => 'required|numeric|between:2.5,99',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if (!$this->isValidImage($image)) {
                return redirect()->back()->withErrors(['image' => 'Unsupported image format. Please choose a PNG, JPG, or JPEG image.']);
            }

            if (!$this->isImageSizeValid($image)) {
                return redirect()->back()->withErrors(['image' => 'File size exceeds the maximum allowed limit of 2MB.']);
            }


            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }

            $validatedData['image_path'] = $image->store('images', 'public');
        }

        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    // ...
}
