 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">

     <div data-simplebar class="h-100">

         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">
                @php
                     $role=Auth::user()->role;
                @endphp
                 @if( $role== 'admin')
                 <li>
                     <a href="{{route('index')}}">
                         <i data-feather="home"></i>
                         <span class="badge rounded-pill bg-soft-success text-success float-end"></span>
                         <span data-key="t-dashboard">Dashboard</span>
                     </a>
                 </li>
                 <li class="menu-title" data-key="t-apps">Pages</li>
                 <li>
                     <a href="{{route('user')}}">
                         <i data-feather="user"></i>
                         <span data-key="t-ecommerce">User</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{route('emp.show')}}">
                         <i data-feather="users"></i>
                         <span data-key="t-ecommerce">Employee</span>
                     </a>
                 </li>

                 <li>
                     <a href="{{route('login.details')}}">
                         <i data-feather="users"></i>
                         <span data-key="t-ecommerce">Login Details</span>
                     </a>
                 </li>
                 @elseif($role == 'agent')
                 <li>
                     <a href="{{route('emp.show')}}">
                         <i data-feather="users"></i>
                         <span data-key="t-ecommerce">Employee</span>
                     </a>
                 </li>
                 @endif
             </ul>
           
         </div>
         <!-- Sidebar -->
     </div>
 </div>
 <!-- Left Sidebar End -->