 <!-- Aside -->
 <aside class="bsb-sidebar-1 offcanvas offcanvas-start" tabindex="-1" id="bsbSidebar1" aria-labelledby="bsbSidebarLabel1">
     <div class="offcanvas-header">
         <a class="sidebar-brand  d-flex justify-content-center align-items-center"
             style="margin: 0 20px;text-decoration: none; font-size:20px;height:30px;" href="/">
             <x-logo />
         </a>
         <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
     </div>
     <div class="offcanvas-body pt-0">

         <ul class="navbar-nav">
             @guest
                 <!-- Authentication Links -->
                 <li class="nav-item mt-3">
                     <h6 class="py-1 fw-bold mx-3 text-secondary text-uppercase fs-7"><x-key-translate key="authentification" /></h6>
                 </li>

                 @if (Route::has('login'))
                     <li class="nav-item">
                         <a class="nav-link p-2 rounded {{ Request::routeIs('login') ? 'fw-bold text-primary' : '' }}" href="{{ route('login') }}">
                             <i class="bi bi-key me-2"></i>
                             <span class="nav-link-text"><x-key-translate key="login"/></span>
                         </a>
                     </li>
                 @endif

                 @if (Route::has('register'))
                     <li class="nav-item">
                         <a class="nav-link p-2 rounded {{ Request::routeIs('register') ? 'fw-bold text-primary' : '' }}" href="{{ route('register') }}">
                             <i class="bi bi-person-plus me-2"></i>
                             <span class="nav-link-text"><x-key-translate key="register"/></span>
                         </a>
                     </li>
                 @endif
             @else
                 <li class="nav-item mt-3">
                     <h6 class="py-1 fw-bold mx-3 text-secondary text-uppercase fs-7"><x-key-translate key="menu"/></h6>
                 </li>
                 @can('show_dashboard')
                     <li class="nav-item">
                         <a class="nav-link p-2 rounded {{ Request::routeIs('dashboard') ? 'fw-bold text-primary' : '' }}" href="{{ route('dashboard') }}">
                             <i class="bi bi-speedometer2 me-2"></i>
                             <span class="nav-link-text"><x-key-translate key="dashboard"/></span>
                         </a>
                     </li>
                 @endcan


                 <li class="nav-item">
                     <a class="nav-link p-2 rounded {{ Request::routeIs('home') ? 'fw-bold text-primary' : '' }}" href="{{ route('home') }}">
                         <i class="bi bi-person me-2"></i>
                         <span class="nav-link-text">{{ Auth::user()->name }}</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link p-2 rounded" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                         <i class="bi bi-box-arrow-right me-2"></i>
                         <x-key-translate key="logout"/>
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                 </li>

             @endguest

         </ul>
     </div>
 </aside>
