@php 
$role_id=auth()->user()->role_id;
@endphp
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
        <a href="{{route('dashboard')}}" class="logo">
            <img src="{{asset('admin1/assets/img/logo/mywrrom.png')}}" alt="navbar brand" class="navbar-brand" height="70" />
        </a>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
            </button>
        </div>
        <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
        </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        @hideOnSpecificPage('getChapter')
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">APPLICATION</h4>
                </li>
                @if($role_id==1 || $role_id==2)
                <li class="nav-item {{request()->is('staffs')? 'active':''}}">
                    <a href="{{route('staffs')}}">
                        <i class="menu-icon fa  fa-users"></i>
                        <p>Staffs</p>
                    </a>
                </li>
                <li class="nav-item {{request()->is('attendances')? 'active':''}}">
                    <a href="{{route('attendances')}}">
                        <i class="menu-icon fa fa-clock"></i>
                        <p>Attendances</p>
                    </a>
                </li>
                @endif
                <li class="nav-item {{request()->is('memberships')? 'active':''}}">
                    <a href="{{route('memberships')}}">
                        <i class="menu-icon fa fa-users"></i>
                        <p>MemberShips</p>
                    </a>
                </li>
                <li class="nav-item {{request()->is('worktimes')? 'active':''}}">
                    <a href="{{route('worktimes')}}">
                        <i class="menu-icon fa fa-calendar"></i>
                        <p>Work Times</p>
                    </a>
                </li>
                <li class="nav-item {{request()->is('tasks')? 'active':''}}">
                    <a href="{{route('tasks')}}">
                        <i class="menu-icon fa fa-tasks"></i>
                        <p>Tasks</p>
                    </a>
                </li>
                <li class="nav-item {{request()->is('taskdays')? 'active':''}}">
                    <a href="{{route('taskdays')}}">
                        <i class="menu-icon fa fa-tasks"></i>
                        <p>Task Days</p>
                    </a>
                </li>
                <li class="nav-item {{request()->is('dailyworks')? 'active':''}}">
                    <a href="{{route('dailyworks')}}">
                        <i class="menu-icon fa fa-tasks"></i>
                        <p>Daily Works</p>
                    </a>
                </li>
                <li class="nav-item {{request()->is('invoices')? 'active':''}}">
                    <a href="{{route('invoices')}}">
                        <i class="menu-icon fas fa-file-invoice"></i>
                        <p>Invoices</p>
                    </a>
                </li>
                @if($role_id==3||$role_id==2)
                <li class="nav-item {{request()->is('mytasks')? 'active':''}}">
                    <a href="{{route('mytasks')}}">
                        <i class="menu-icon fa fa-tasks"></i>
                        <p>My Tasks</p>
                    </a>
                </li>
                @endif
                @if($role_id==3)
                <li class="nav-item {{request()->is('getChapter')? 'active':''}}">
                    <a href="{{route('getChapter')}}">
                        <i class="menu-icon fa fa-tasks"></i>
                        <p>Go To Chapter</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa fa-cogs"></i>
                        <p>Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('branches')||request()->is('departments')
                    ||request()->is('designations')||request()->is('roles')
                    ||request()->is('countries')||request()->is('states')
                    ||request()->is('districts')|| request()->is('cities') 
                    ||request()->is('businesscategories')||request()->is('membershiptypes')
                    ||request()->is('chapters') || request()->is('enquirytypes')
                    ||request()->is('statuses')? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{request()->is('branches')? 'active':''}}">
                                <a href="{{route('branches')}}">
                                    <span class="sub-item">Branches</span>
                                </a>
                            </li>
                            <li class="{{request()->is('departments')? 'active':''}}">
                                <a href="{{route('departments')}}">
                                    <span class="sub-item">Departments</span>
                                </a>
                            </li>
                            <li class="{{request()->is('designations')? 'active':''}}">
                                <a href="{{route('designations')}}">
                                    <span class="sub-item">Designations</span>
                                </a>
                            </li>
                            <li class="{{request()->is('roles')? 'active':''}}">
                                <a href="{{route('roles')}}">
                                    <span class="sub-item">Roles</span>
                                </a>
                            </li>
                            <li class="{{request()->is('countries')? 'active':''}}">
                                <a href="{{route('countries')}}">
                                    <span class="sub-item">Countries</span>
                                </a>
                            </li>
                            <li class="{{request()->is('states')? 'active':''}}">
                                <a href="{{route('states')}}">
                                    <span class="sub-item">States</span>
                                </a>
                            </li>
                            <li class="{{request()->is('districts')? 'active':''}}">
                                <a href="{{route('districts')}}">
                                    <span class="sub-item">Districts</span>
                                </a>
                            </li>
                            <li class="{{request()->is('cities')? 'active':''}}">
                                <a href="{{route('cities')}}">
                                    <span class="sub-item">Cities</span>
                                </a>
                            </li>
                            <li class="{{request()->is('businesscategories')? 'active':''}}">
                                <a href="{{route('businesscategories')}}">
                                    <span class="sub-item">Business Categories</span>
                                </a>
                            </li>
                            <li class="{{request()->is('chapters')? 'active':''}}">
                                <a href="{{route('chapters')}}">
                                    <span class="sub-item">Chapters</span>
                                </a>
                            </li>
                            <li class="{{request()->is('enquirytypes')? 'active':''}}">
                                <a href="{{route('enquirytypes')}}">
                                    <span class="sub-item">Enquiry Types</span>
                                </a>
                            </li>
                            <li class="{{request()->is('membershiptypes')? 'active':''}}">
                                <a href="{{route('membershiptypes')}}">
                                    <span class="sub-item">Membership Types</span>
                                </a>
                            </li>
                            <li class="{{request()->is('statuses')? 'active':''}}">
                                <a href="{{route('statuses')}}">
                                    <span class="sub-item">Statuses</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        @endHideOnSpecificPage
    </div>
</div>