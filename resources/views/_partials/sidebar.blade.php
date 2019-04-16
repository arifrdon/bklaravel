
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item {{ ($halaman == "" ? 'active':'') }}">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item {{ ($halaman == "kejadian" ? 'active':'') }} ">
          <a class="nav-link "  href="{{ url('kejadian') }}">
              <i class="fas fa-fw fa-folder"></i>
              <span>List Kejadian</span>
          </a>
        </li>
        <li class="nav-item {{ ($halaman == "kejadian_siswa" ? 'active':'') }} ">
          <a class="nav-link "  href="{{ url('kejadian_siswa') }}">
              <i class="fas fa-fw fa-folder"></i>
              <span>Kejadian Siswa</span>
          </a>
        </li>
        <li class="nav-item {{ ($halaman == "skor_siswa" ? 'active':'') }} ">
          <a class="nav-link "  href="{{ url('skor_siswa') }}">
              <i class="fas fa-fw fa-folder"></i>
              <span>Skor Siswa</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('pengaturan_bk/edit') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan BK</span></a>
        </li>
      </ul>

      