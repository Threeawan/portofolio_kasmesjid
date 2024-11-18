 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
 <aside class="app-sidebar">
   <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="template/images/tryawan.jpg" alt="User Image">
     <div>
       <p class="app-sidebar__user-name">Mochamad Tryawan</p>
       <p class="app-sidebar__user-designation">Admin</p>
     </div>
   </div>
   <ul class="app-menu">
    
    <li>
        <a class="app-menu__item {{ \Route::is('dashboard.create')?'active':'' }}" href="{{ url('/mesjid_dashboard') }}">
        <i class="app-menu__icon bi bi-house-door"></i>
        <span class="app-menu__label">Dashboard</span>
        </a>
     </li>

     

     
     <li>
      <a class="app-menu__item {{ \Route::is('manajemen.detail')?'active':'' }}" href="{{ url('/manajemen_detail') }}">
          <i class="app-menu__icon bi bi-people"></i>
          <span class="app-menu__label">Manajemen User</span>
      </a>
    </li>
    
     <li>
        <a class="app-menu__item {{ \Route::is('mesjid.index')?'active':'' }}" href="{{ url('/mesjid') }}">
            <i class="app-menu__icon bi bi-download"></i>
            <span class="app-menu__label">Input Data</span>
        </a>
    </li>

   

  <li>
    <a class="app-menu__item {{ \Route::is('mesjid.detail')?'active':'' }}" href="{{ url('/mesjid_detail') }}">
        <i class="app-menu__icon bi bi-folder"></i>
        <span class="app-menu__label">Data Kas</span>
    </a>
</li>



<li>
  <a class="app-menu__item {{ \Route::is('mesjid.laporan')?'active':'' }}" href="{{ url('/mesjid_laporan') }}">
      <i class="app-menu__icon bi bi-briefcase"></i>
      <span class="app-menu__label">Laporan Kas</span>
  </a>
</li>



   </ul>
 </aside>