<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
   public function index()
    {
        if(Auth::Check()){
        $employees = Employee::with('company')->paginate(10); // Add pagination
        return view('employees.index', compact('employees'));
        }else{
            return redirect()->route('showLoginForm')->with('warning','Please Login the Id');
        }
    }

    public function create()
    {
        $companies = Company::all(); // Get companies for the dropdown
        return view('employees.create', compact('companies'));
    }

   
    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'company_id' => 'required|exists:companies,id',
    //         'email' => 'nullable|email',
    //         'phone' => 'nullable|string|max:15',
    //         'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    //     ]);
    //     $path = null;
    //     // Handle profile picture upload if it exists
    //     if ($request->hasFile('profile_picture')) {
    //         // Get the uploaded file
    //         $file = $request->file('profile_picture');

    //         // Generate a unique name for the image file
    //         $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

    //         // Store the file in the 'public/profile_pictures' folder
    //         $path = $file->storeAs('profile_pictures', $fileName, 'public');
           
    //         // Add the path to the employee data array
    //         $request->replace(array_merge($request->all(), ['profile_picture' => $path]));
            
    //         }
            
       

    //     return $path;
    //     // Create a new employee record with the request data
    //     // Employee::create($request->all());

    //     // // Redirect to the employees index page with a success message
    //     // return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    // }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Custom method to handle the profile picture upload and modify the request data
        $profilePicturePath = $this->handleProfilePicture($request);

        // Prepare data
        $employeeData = $request->only(['first_name', 'last_name', 'company_id', 'email', 'phone']);

        if ($profilePicturePath) {
            $employeeData['profile_picture'] = $profilePicturePath;
        }
       
        Employee::create($employeeData);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    // Profile_image 
    private function handleProfilePicture(Request $request)
    {
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            return $file->storeAs('profile_pictures', $fileName, 'public');
        }
        return null;
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(Request $request, Employee $employee)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Custom method to handle the profile picture upload
        $profilePicturePath = $this->handleProfilePicture($request);

        // Prepare data for updating
        $employeeData = $request->only(['first_name', 'last_name', 'company_id', 'email', 'phone']);

        // Update the profile picture if a new one was uploaded
        if ($profilePicturePath) {
            // If the employee already has a profile picture, delete the old one
            if ($employee->profile_picture) {
                Storage::disk('public')->delete($employee->profile_picture);
            }

            $employeeData['profile_picture'] = $profilePicturePath;
        }

        // Update the employee record with new data
        $employee->update($employeeData);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
   
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}