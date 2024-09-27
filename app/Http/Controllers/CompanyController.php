<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        if(Auth::Check()){
            $companies = Company::paginate(10); // Add pagination
            return view('companies.index', compact('companies'));
        }else{
            return redirect()->route('showLoginForm')->with('warning','Please Login the Id');
        }
       
    }

    public function create()
    {
        return view('companies.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'nullable|email',
    //         'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
    //         'website' => 'nullable|url',
    //     ]);

    //     // Handle logo upload if exists
    //     if ($request->hasFile('logo')) {
    //         // $path = $request->file('logo')->store('logos', 'public');
    //         // $request->merge(['logo' => $path]);

    //          // Get the uploaded file
    //          $file = $request->file('logo');

    //          // Generate a unique filename using time() and uniqid()
    //          $uniqueName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
 
    //          // Store the image in the 'public/images' folder
    //          $path = $file->storeAs('logos', $uniqueName, 'public');
    //     }
    //     return $request->all();

    //     // Company::create($request->all());

    //     // return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    // }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
           'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ]);

        // Custom method to handle the profile picture upload and modify the request data
        $logoPath = $this->handleLogo($request);

        // Prepare data
        $companyData = $request->only(['name', 'email', 'website']);

        if ($logoPath) {
            $companyData['logo'] = $logoPath;
        }
       
        Company::create($companyData);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

     // Profile_image 
     private function handleLogo(Request $request)
     {
         if ($request->hasFile('logo')) {
             $file = $request->file('logo');
             $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
             return $file->storeAs('logo', $fileName, 'public');
         }
         return null;
     }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ]);

        $company = Company::findOrFail($id);

         // Custom method to handle the profile picture upload
         $LogoPath = $this->handleLogo($request);

         // Prepare data for updating
         $companyData = $request->only(['name', 'email', 'website']);
 
         // Update the profile picture if a new one was uploaded
         if ($LogoPath) {
             // If the employee already has a profile picture, delete the old one
             if ($company->logo) {
                 Storage::disk('public')->delete($company->logo);
             }
 
             $companyData['logo'] = $LogoPath;
         }
 

        $company->update($companyData);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}