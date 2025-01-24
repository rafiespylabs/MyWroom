<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EnquirytypeController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MembershiptypeController;
use App\Http\Controllers\BusinesscategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {return redirect(route('login'));});
Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/branches', [BranchController::class, 'index'])->name('branches');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::post('/branch/show', [BranchController::class, 'show'])->name('branch.show');
    Route::patch('/branch/update', [BranchController::class, 'update'])->name('branch.update');

    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::post('/department/show', [DepartmentController::class, 'show'])->name('department.show');
    Route::patch('/department/update', [DepartmentController::class, 'update'])->name('department.update');

    Route::get('/designations', [DesignationController::class, 'index'])->name('designations');
    Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store');
    Route::post('/designation/show', [DesignationController::class, 'show'])->name('designation.show');
    Route::patch('/designation/update', [DesignationController::class, 'update'])->name('designation.update');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::post('/role/show', [RoleController::class, 'show'])->name('role.show');
    Route::patch('/role/update', [RoleController::class, 'update'])->name('role.update');

    Route::get('/countries', [CountryController::class, 'index'])->name('countries');
    Route::post('/countries/store', [CountryController::class, 'store'])->name('countries.store');
    Route::post('/countries/edit', [CountryController::class, 'edit'])->name('countries.edit');
    Route::post('/countries/update', [CountryController::class, 'update'])->name('countries.update');
    Route::post('/countries/destroy', [CountryController::class, 'destroy'])->name('countries.destroy');
    Route::post('/countries/getStates', [CountryController::class, 'getStates'])->name('countries.getStates');

    Route::get('/states', [StateController::class, 'index'])->name('states');
    Route::post('/states/store', [StateController::class, 'store'])->name('states.store');
    Route::post('/states/edit', [StateController::class, 'edit'])->name('states.edit');
    Route::post('/states/update', [StateController::class, 'update'])->name('states.update');
    Route::post('/states/destroy', [StateController::class, 'destroy'])->name('states.destroy');    
    Route::post('/states/getDistricts', [StateController::class, 'getDistricts'])->name('states.getDistricts');    

    Route::get('/districts', [DistrictController::class, 'index'])->name('districts');
    Route::post('/districts/store', [DistrictController::class, 'store'])->name('districts.store');
    Route::post('/districts/edit', [DistrictController::class, 'edit'])->name('districts.edit');
    Route::post('/districts/update', [DistrictController::class, 'update'])->name('districts.update');
    Route::post('/districts/destroy', [DistrictController::class, 'destroy'])->name('districts.destroy'); 

    Route::get('/staffs', [StaffController::class, 'index'])->name('staffs');
    Route::get('/staff/list', [StaffController::class, 'list'])->name('staff.list');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
    Route::post('/staff/show', [StaffController::class, 'show'])->name('staff.show');
    Route::post('/staff/update', [StaffController::class, 'update'])->name('staff.update');
    Route::post('/staff/destroy/', [StaffController::class, 'destroy'])->name('staff.destroy');
    Route::post('/password_reset', [StaffController::class, 'password_reset'])->name('password_reset');

    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances');
    Route::get('/attendance/list', [AttendanceController::class, 'list'])->name('attendance.list');
    Route::post('/attendance/filter', [AttendanceController::class, 'filter'])->name('attendance.filter');

    Route::get('/cities', [CityController::class, 'index'])->name('cities');
    Route::post('/cities/store', [CityController::class, 'store'])->name('cities.store');
    Route::post('/cities/edit', [CityController::class, 'edit'])->name('cities.edit');
    Route::post('/cities/update', [CityController::class, 'update'])->name('cities.update');
    Route::post('/cities/destroy', [CityController::class, 'destroy'])->name('cities.destroy'); 
    Route::post('/cities/getchapters', [CityController::class, 'getchapters'])->name('cities.getchapters'); 

    Route::get('/businesscategories', [BusinesscategoryController::class, 'index'])->name('businesscategories');
    Route::post('/businesscategories/store', [BusinesscategoryController::class, 'store'])->name('businesscategories.store');
    Route::post('/businesscategories/edit', [BusinesscategoryController::class, 'edit'])->name('businesscategories.edit');
    Route::post('/businesscategories/update', [BusinesscategoryController::class, 'update'])->name('businesscategories.update');
    Route::post('/businesscategories/destroy', [BusinesscategoryController::class, 'destroy'])->name('businesscategories.destroy');

    Route::get('/chapters', [ChapterController::class, 'index'])->name('chapters');
    Route::post('/chapters/store', [ChapterController::class, 'store'])->name('chapters.store');
    Route::post('/chapters/edit', [ChapterController::class, 'edit'])->name('chapters.edit');
    Route::post('/chapters/update', [ChapterController::class, 'update'])->name('chapters.update');
    Route::post('/chapters/destroy', [ChapterController::class, 'destroy'])->name('chapters.destroy'); 
    
    Route::get('/enquirytypes', [EnquirytypeController::class, 'index'])->name('enquirytypes');
    Route::post('/enquirytypes/store', [EnquirytypeController::class, 'store'])->name('enquirytypes.store');
    Route::post('/enquirytypes/edit', [EnquirytypeController::class, 'edit'])->name('enquirytypes.edit');
    Route::post('/enquirytypes/update', [EnquirytypeController::class, 'update'])->name('enquirytypes.update');
    Route::post('/enquirytypes/destroy', [EnquirytypeController::class, 'destroy'])->name('enquirytypes.destroy');

    Route::get('/membershiptypes', [MembershiptypeController::class, 'index'])->name('membershiptypes');
    Route::post('/membershiptypes/store', [MembershiptypeController::class, 'store'])->name('membershiptypes.store');
    Route::post('/membershiptypes/edit', [MembershiptypeController::class, 'edit'])->name('membershiptypes.edit');
    Route::post('/membershiptypes/update', [MembershiptypeController::class, 'update'])->name('membershiptypes.update');
    Route::post('/membershiptypes/destroy', [MembershiptypeController::class, 'destroy'])->name('membershiptypes.destroy');

    Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships');
    Route::post('/memberships/store', [MembershipController::class, 'store'])->name('memberships.store');
    Route::post('/memberships/edit', [MembershipController::class, 'edit'])->name('memberships.edit');
    Route::post('/memberships/update', [MembershipController::class, 'update'])->name('memberships.update');
    Route::post('/memberships/destroy', [MembershipController::class, 'destroy'])->name('memberships.destroy'); 
});
require __DIR__.'/auth.php';
