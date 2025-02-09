<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar profile starts -->
    <div class="sidebar-profile">
        @if(Auth::check())
            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : url('/') . '/assets/images/default-user.png' }}" class="img-shadow img-3x me-3 rounded-5" alt="User Photo">
            <div class="m-0">
                <h5 class="mb-1 profile-name text-nowrap text-truncate">{{ Auth::user()->name }}</h5>
                <p class="m-0 small profile-name text-nowrap text-truncate">{{ Auth::user()->email }}</p>
            </div>
        @else
            <img src="{{ url('/') }}/assets/images/user6.png" class="img-shadow img-3x me-3 rounded-5" alt="Default User Photo">
            <div class="m-0">
                <h5 class="mb-1 profile-name text-nowrap text-truncate">Guest</h5>
                <p class="m-0 small profile-name text-nowrap text-truncate">Guest User</p>
            </div>
        @endif
    </div>
    <!-- Sidebar profile ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="ri-stethoscope-line"></i>
            <span class="menu-text">Cadastros</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{ url('/procedimentos') }}">Procedimentos</a>
            </li>
            <li>
              <a href="{{ url('/profissionais') }}">Profissionais</a>
            </li>
            <li>
              <a href="{{ url('/medicamentos') }}">Medicamentos</a>
            </li>
            <li>
              <a href="{{ url('/convenios') }}">Convênios</a>
            </li>
            <li>
              <a href="{{ url('/especialidades') }}">Especialidades</a>
            </li>
            <li>
              <a href="{{ url('/forma_pagto') }}">Forma de Pagamentos</a>
            </li> 
            <li>
              <a href="{{ url('/contas') }}">Contas - Receitas e Despesas</a>
            </li>            
              @if(Auth::check() && Auth::user()->is_admin)
                <li><a href="{{ url('/usuarios') }}">Usuários</a></li>
              @endif
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ url('/pacientes') }}">
            <i class="ri-heart-pulse-line"></i>
            <span class="menu-text">Pacientes</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('/jogos') }}">
            <i class="ri-nurse-line"></i>
            <span class="menu-text">Jogos Analiticos</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('/atestados') }}">
            <i class="ri-dossier-line"></i>
            <span class="menu-text">Atestados</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('/receitas') }}">
            <i class="ri-building-2-line"></i>
            <span class="menu-text">Receituario</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('/orcamentos') }}">
            <i class="ri-secure-payment-line"></i>
            <span class="menu-text">Orçamentos</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="ri-group-2-line"></i>
            <span class="menu-text">Tratamentos</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('/movimentos') }}">
            <i class="ri-group-2-line"></i>
            <span class="menu-text">Financeiro</span>
          </a>
        </li>        
        <!-- <li class="treeview">
          <a href="#">
            <i class="ri-money-dollar-circle-line"></i>
            <span class="menu-text">Salaries</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="salaries.html">Salary List</a>
            </li>
            <li>
              <a href="payslip.html">Payslip</a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="ri-hotel-bed-line"></i>
            <span class="menu-text">Rooms</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="room-statistics.html">Statistics</a>
            </li>
            <li>
              <a href="rooms-allotted.html">Rooms Allotted</a>
            </li>
            <li>
              <a href="rooms-by-dept.html">Rooms By Department</a>
            </li>
            <li>
              <a href="available-rooms.html">Available Rooms</a>
            </li>
            <li>
              <a href="book-room.html">Book Room</a>
            </li>
            <li>
              <a href="add-room.html">Add Room</a>
            </li>
            <li>
              <a href="edit-room.html">Edit Room</a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="ri-car-washing-line"></i>
            <span class="menu-text">Ambulance</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="ambulance-list.html">Ambulance List</a>
            </li>
            <li>
              <a href="add-ambulance.html">Add Ambulance</a>
            </li>
            <li>
              <a href="edit-ambulance.html">Edit Ambulance</a>
            </li>
            <li>
              <a href="ambulance-call-list.html">Ambulance Call List</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="events.html">
            <i class="ri-calendar-line"></i>
            <span class="menu-text">Event Management</span>
          </a>
        </li>
        <li>
          <a href="gallery.html">
            <i class="ri-tent-line"></i>
            <span class="menu-text">Gallery</span>
          </a>
        </li>
        <li>
          <a href="news.html">
            <i class="ri-news-line"></i>
            <span class="menu-text">News & Updates</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="ri-color-filter-line"></i>
            <span class="menu-text">UI Elements</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="alerts.html">Alerts</a>
            </li>
            <li>
              <a href="avatars.html">Avatars</a>
            </li>
            <li>
              <a href="badges.html">Badges</a>
            </li>
            <li>
              <a href="buttons.html">Buttons</a>
            </li>
            <li>
              <a href="button-groups.html">Button Groups</a>
            </li>
            <li>
              <a href="cards.html">Cards</a>
            </li>
            <li>
              <a href="advanced-cards.html">Advanced Cards</a>
            </li>
            <li>
              <a href="dropdowns.html">Dropdowns</a>
            </li>
            <li>
              <a href="list-items.html">List Items</a>
            </li>
            <li>
              <a href="progress.html">Progress Bars</a>
            </li>
            <li>
              <a href="placeholders.html">Placeholders</a>
            </li>
            <li>
              <a href="spinners.html">Spinners</a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="ri-notification-badge-line"></i>
            <span class="menu-text">Jquery Components</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="accordions.html">Accordions</a>
            </li>
            <li>
              <a href="carousel.html">Carousel</a>
            </li>
            <li>
              <a href="modals.html">Modals</a>
            </li>
            <li>
              <a href="popovers.html">Popovers</a>
            </li>
            <li>
              <a href="tabs.html">Tabs</a>
            </li>
            <li>
              <a href="tooltips.html">Tooltips</a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="ri-terminal-window-line"></i>
            <span class="menu-text">Forms</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="form-inputs.html">Form Inputs</a>
            </li>
            <li>
              <a href="form-checkbox-radio.html">Checkbox &amp; Radio</a>
            </li>
            <li>
              <a href="form-file-input.html">File Input</a>
            </li>
            <li>
              <a href="form-validations.html">Validations</a>
            </li>
            <li>
              <a href="date-time-pickers.html">Date Time Pickers</a>
            </li>
            <li>
              <a href="form-masks.html">Input Masks</a>
            </li>
            <li>
              <a href="form-tags.html">Input Tags</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="tables.html">
            <i class="ri-table-line"></i>
            <span class="menu-text">Tables</span>
          </a>
        </li>
          <a href="maps.html">
            <i class="ri-road-map-line"></i>
            <span class="menu-text">Vector Maps</span>
          </a>
        </li>
        <li>
          <a href="icons.html">
            <i class="ri-send-plane-2-line"></i>
            <span class="menu-text">Icons</span>
          </a>
        </li>
        <li>
          <a href="settings.html">
            <i class="ri-settings-5-line"></i>
            <span class="menu-text">Account Settings</span>
          </a>
        </li>
        <li>
          <a href="typography.html">
            <i class="ri-font-size"></i>
            <span class="menu-text">Typography</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="ri-login-circle-line"></i>
            <span class="menu-text">Login/Signup</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="login.html">Login</a>
            </li>
            <li>
              <a href="signup.html">Signup</a>
            </li>
            <li>
              <a href="forgot-password.html">Forgot Password</a>
            </li>
            <li>
              <a href="reset-password.html">Reset Password</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="page-not-found.html">
            <i class="ri-alert-line"></i>
            <span class="menu-text">Page Not Found</span>
          </a>
        </li>
        <li>
          <a href="maintenance.html">
            <i class="ri-auction-line"></i>
            <span class="menu-text">Maintenance</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="ri-dropdown-list"></i>
            <span class="menu-text">Menu Level</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#">Level One Link</a>
            </li>
            <li>
              <a href="#!">
                Level One Menu
                <i class="ri-arrow-right-s-line"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="#!">Level Two Link</a>
                </li>
                <li>
                  <a href="#!">Level Two Menu
                    <i class="ri-arrow-right-s-line"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="#!">Level Three Link</a>
                    </li>
                    <li>
                      <a href="#!">Level Three Link</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <a href="#!">Level One Link</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="default.html">
            <i class="ri-send-plane-line"></i>
            <span class="menu-text">External Link</span>
          </a>
        </li>
        <li>
          <a href="#!">
            <i class="ri-exchange-line"></i>
            <span class="menu-text">Chip</span>
            <span class="badge bg-primary ms-auto">6</span>
          </a>
        </li>
        <li>
          <a href="#!">
            <i class="ri-ticket-line"></i>
            <span class="menu-text">Badge</span>
            <span class="badge border border-primary text-primary ms-auto">Chip</span>
          </a>
        </li>
        <li>
          <a href="#!" class="disabled">
            <i class="ri-magic-line"></i>
            <span class="menu-text">Disabled Link</span>
          </a>
        </li> -->
      </ul>
    </div>
    <!-- Sidebar menu ends -->

    <!-- Sidebar contact starts -->

    <!-- Sidebar contact ends -->

  </nav>