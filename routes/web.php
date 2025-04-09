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
use App\Http\Controllers\ChapterSelectionController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskstatusController;
use App\Http\Controllers\WorktimeController;
use App\Http\Controllers\MytaskController;
use App\Http\Controllers\MytasktransController;
use App\Http\Controllers\DailyworkController;
use App\Http\Controllers\TaskdayController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {return redirect(route('login'));});
Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/getChapter', [AdminController::class, 'getChapter'])->middleware(['auth', 'verified'])->name('getChapter');
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
    Route::get('/staffs/tasks/{id}', [StaffController::class, 'getCurrentDayTask'])->name('staffs.getCurrentDayTask');
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
    
    Route::post('/chapters/selection', [ ChapterSelectionController::class, 'selection'])->name('chapters.selection'); 
    Route::get('/chapter/dashboard', [ ChapterSelectionController::class, 'dashboard'])->name('chapter.dashboard'); 

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

    Route::get('/worktimes', [WorktimeController::class, 'index'])->name('worktimes');
    Route::post('/worktimes/store', [WorktimeController::class, 'store'])->name('worktimes.store');
    Route::post('/worktimes/edit', [WorktimeController::class, 'edit'])->name('worktimes.edit');
    Route::post('/worktimes/update', [WorktimeController::class, 'update'])->name('worktimes.update');
    Route::post('/worktimes/destroy', [WorktimeController::class, 'destroy'])->name('worktimes.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('/tasks/update', [TaskController::class, 'update'])->name('tasks.update');
    Route::post('/tasks/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy'); 

    Route::get('/statuses', [TaskstatusController::class, 'index'])->name('statuses');
    Route::post('/statuses/store', [TaskstatusController::class, 'store'])->name('statuses.store');
    Route::post('/statuses/edit', [TaskstatusController::class, 'edit'])->name('statuses.edit');
    Route::post('/statuses/update', [TaskstatusController::class, 'update'])->name('statuses.update');
    Route::post('/statuses/destroy', [TaskstatusController::class, 'destroy'])->name('statuses.destroy');
    
    Route::get('/mytasks', [MytaskController::class, 'index'])->name('mytasks');
    Route::post('/mytasks/store', [MytaskController::class, 'store'])->name('mytasks.store');
    Route::post('/mytasks/edit', [MytaskController::class, 'edit'])->name('mytasks.edit');
    Route::post('/mytasks/update', [MytaskController::class, 'update'])->name('mytasks.update');
    Route::post('/mytasks/destroy', [MytaskController::class, 'destroy'])->name('mytasks.destroy');
    Route::post('/get-task-date', [MytaskController::class, 'getStatusDate'])->name('get.task.date');

    Route::get('/mytasktrans/{mytask_id}', [MytasktransController::class, 'index'])->name('mytasktrans');
    Route::post('/mytasktrans/store', [MytasktransController::class, 'store'])->name('mytasktrans.store');
    Route::post('/mytasktrans/edit', [MytasktransController::class, 'edit'])->name('mytasktrans.edit');
    Route::post('/mytasktrans/update', [MytasktransController::class, 'update'])->name('mytasktrans.update');
    Route::post('/mytasktrans/destroy', [MytasktransController::class, 'destroy'])->name('mytasktrans.destroy');
    Route::post('/get-task-details', [MytasktransController::class, 'getTaskDetails'])->name('get.task.details');

    Route::get('/dailyworks', [DailyworkController::class, 'index'])->name('dailyworks');
    Route::post('/dailyworks/store', [DailyworkController::class, 'store'])->name('dailyworks.store');
    Route::post('/dailyworks/edit', [DailyworkController::class, 'edit'])->name('dailyworks.edit');
    Route::post('/dailyworks/update', [DailyworkController::class, 'update'])->name('dailyworks.update');
    Route::post('/dailyworks/destroy', [DailyworkController::class, 'destroy'])->name('dailyworks.destroy');

    Route::get('/taskdays/{id?}', [TaskdayController::class, 'index'])->name('taskdays');
    Route::post('/taskdays/list', [TaskdayController::class, 'list'])->name('taskdays.list');
    Route::post('/taskdays/store', [TaskdayController::class, 'store'])->name('taskdays.store');
    Route::get('/taskdays/{id}/edit', [TaskdayController::class, 'edit'])->name('taskdays.edit');
    Route::post('/taskdays/update/{id}', [TaskdayController::class, 'update'])->name('taskdays.update');
    Route::delete('/taskdays/{id}', [TaskdayController::class, 'destroy'])->name('taskdays.destroy');
    Route::get('/tasks/getlist', [TaskController::class, 'getlist'])->name('tasks.getlist');
    Route::get('/worktimes/getlist', [WorktimeController::class, 'getlist'])->name('worktimes.getlist');
});
require __DIR__.'/auth.php';
