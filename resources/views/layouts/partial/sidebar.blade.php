    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">

      <div class="logo">
        <a href="{{ route('welcome') }}" target="_blank" class="simple-text logo-normal">
          Kitchen
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/slider*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('slider.index') }}">
              <i class="material-icons">view_carousel</i>
              <p>Slider</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/category*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('category.index') }}">
              <i class="material-icons">layers</i>
              <p>Category</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/item*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('item.index') }}">
              <i class="material-icons">format_list_bulleted</i>
              <p>Item</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/about*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('about.index') }}">
              <i class="material-icons">account_box</i>
              <p>About</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/reservation*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('reservation.index') }}">
              <i class="material-icons">restaurant</i>
              <p>Reservations</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/contact*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('contact.index') }}">
              <i class="material-icons">message</i>
              <p>Messages</p>
            </a>
          </li>
        </ul>
      </div>
    </div>