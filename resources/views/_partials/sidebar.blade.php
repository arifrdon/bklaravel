
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

        @if (Auth::user()->level =="admin" || Auth::user()->level =="kepala_sekolah" || Auth::user()->level =="guru_bk" || (Auth::user()->level =="guru") && config('wali_list')->contains(Auth::user()->id))
        <li class="nav-item {{ ($halaman == "skor_siswa" ? 'active':'') }} ">
          <a class="nav-link "  href="{{ url('skor_siswa') }}">
              <i class="fas fa-fw fa-folder"></i>
              <span>Skor Siswa</span>
          </a>
        </li>
        @endif

        @if (Auth::user()->level =="admin" || Auth::user()->level =="kepala_sekolah" || Auth::user()->level =="guru_bk")
        <li class="nav-item {{ ($halaman == "laporan_kejadian" ? 'active':'') }} ">
          <a class="nav-link "  href="{{ url('laporan_kejadian') }}">
              <i class="fas fa-fw fa-folder"></i>
              <span>Laporan Kejadian Siswa</span>
          </a>
        </li>
        @endif

        @if (Auth::user()->level =="admin" || Auth::user()->level =="kepala_sekolah" || Auth::user()->level =="guru_bk")
        <li class="nav-item {{ ($halaman == "pengaturan_bk" ? 'active':'') }}">
          <a class="nav-link" href="{{ url('pengaturan_bk') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan BK</span></a>
        </li>
        @endif

      </ul>

      