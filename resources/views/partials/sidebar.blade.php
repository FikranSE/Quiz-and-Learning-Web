<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <div class="sidebar-brand-text mx-3">{{ __('Jendela Literasi') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('admin/dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUserManagement" aria-expanded="true" aria-controls="collapseUserManagement">
                  <span>{{ __('User Management') }}</span>
              </a>
              <div id="collapseUserManagement" class="collapse" aria-labelledby="headingUserManagement" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}"> <i class="fa fa-briefcase mr-2"></i> {{ __('Permissions') }}</a>
                      <a class="collapse-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}"><i class="fa fa-briefcase mr-2"></i> {{ __('Roles') }}</a>
                      <a class="collapse-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"> <i class="fa fa-user mr-2"></i> {{ __('Users') }}</a>
                  </div>
              </div>
          </li>
          
          <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseContentManagement" aria-expanded="true" aria-controls="collapseContentManagement">
                  <span>{{ __('Content Management') }}</span>
              </a>
              <div id="collapseContentManagement" class="collapse" aria-labelledby="headingContentManagement" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('admin/videos') || request()->is('admin/videos/*') ? 'active' : '' }}" href="{{ route('videos.index') }}">
                      <i class="fa fa-briefcase mr-2"></i> {{ __('Contents') }}
                  </a>
                      {{-- <a class="collapse-item {{ request()->is('admin/illustrasi') || request()->is('admin/illustrasi/*') ? 'active' : '' }}" href="{{ route('admin.illustrasi.index') }}"><i class="fa fa-briefcase mr-2"></i> {{ __('Illustrasi') }}</a>
                      <a class="collapse-item {{ request()->is('admin/tujuan') || request()->is('admin/tujuan/*') ? 'active' : '' }}" href="{{ route('admin.tujuan.index') }}"> <i class="fa fa-user mr-2"></i> {{ __('Tujuan') }}</a>
                   --}}
                    </div>
              </div>
          </li>
          

            <li class="nav-item {{ request()->is('admin/categories') || request()->is('admin/categories') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-cogs"></i>
                    <span>{{ __('Category') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('admin/questions') || request()->is('admin/questions') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.questions.index') }}">
                    <i class="fas fa-cogs"></i>
                    <span>{{ __('Question') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('admin/options') || request()->is('admin/options') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.options.index') }}">
                    <i class="fas fa-cogs"></i>
                    <span>{{ __('Option') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('admin/results') || request()->is('admin/results') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.results.index') }}">
                    <i class="fas fa-cogs"></i>
                    <span>{{ __('Result') }}</span></a>
            </li>



        </ul>