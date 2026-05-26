<aside class="admin-sidebar">
  <!-- Logo Section -->
  <div class="sidebar-header">
    <div class="sidebar-logo">
      <i class="fas fa-cog"></i>
      <span>Admin Panel</span>
    </div>
  </div>

  <!-- Menu Utama -->
  <nav class="sidebar-nav">
    <!-- Dashboard Section -->
    <div class="nav-section">
      <div class="nav-section-label">Dashboard</div>
      <button type="button" class="nav-item active" data-target="overview">
        <i class="fas fa-chart-line"></i>
        <span>Ringkasan</span>
      </button>
      <button type="button" class="nav-item" data-target="chart-panel">
        <i class="fas fa-chart-bar"></i>
        <span>Grafik</span>
      </button>
      <button type="button" class="nav-item" data-target="settings-panel">
        <i class="fas fa-cogs"></i>
        <span>Pengaturan Website</span>
      </button>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Konten</div>
      
      <button type="button" class="nav-item" data-target="post-form">
        <i class="fas fa-pen-fancy"></i>
        <span>Posting</span>
      </button>

      <button type="button" class="nav-item" data-target="announcement-form">
        <i class="fas fa-bullhorn"></i>
        <span>Pengumuman</span>
      </button>

      <button type="button" class="nav-item" data-target="documentation-form">
        <i class="fas fa-book-open"></i>
        <span>Dokumentasi</span>
      </button>
    </div>

    <!-- Data Management Section -->
    <div class="nav-section">
      <div class="nav-section-label">Manajemen Data</div>
      
        <a href="{{ route('data-calendar') }}" class="nav-item">
        <i class="fas fa-calendar-alt"></i>
        <span>Kalender Akademik</span>
      </a>
      <a href="{{ route('data-santri') }}" class="nav-item">
        <i class="fas fa-user-graduate"></i>
        <span>Data Santri</span>
      </a>
      <a href="{{ route('data-wali-santri') }}" class="nav-item">
        <i class="fas fa-user-tie"></i>
        <span>Data Wali Santri</span>
      </a>
      <a href="{{ route('data-guru') }}" class="nav-item">
        <i class="fas fa-chalkboard-user"></i>
        <span>Data Guru</span>
      </a>
      <a href="{{ route('data-user') }}" class="nav-item">
        <i class="fas fa-users"></i>
        <span>Data User</span>
      </a>
      <a href="{{ route('data-keuangan') }}" class="nav-item">
        <i class="fas fa-wallet"></i>
        <span>Data Keuangan</span>
      </a>
      <a href="{{ route('data-assets') }}" class="nav-item">
        <i class="fas fa-folder-open"></i>
        <span>Data Inventaris</span>
      </a>
      <a href="{{ route('data-ebooks') }}" class="nav-item">
        <i class="fas fa-book"></i>
        <span>Data Ebook</span>
      </a>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Evaluasi</div>
      <button type="button" class="nav-item" data-target="attendance-teacher-panel">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Absensi Guru</span>
      </button>
      <button type="button" class="nav-item" data-target="attendance-student-panel">
        <i class="fas fa-user-graduate"></i>
        <span>Absensi Santri</span>
      </button>
      <button type="button" class="nav-item" data-target="raport-panel">
        <i class="fas fa-file-alt"></i>
        <span>Raport Santri</span>
      </button>
      <button type="button" class="nav-item" data-target="achievement-panel">
        <i class="fas fa-trophy"></i>
        <span>Prestasi Santri</span>
      </button>
    </div>

  </nav>

  <!-- Footer Info -->
  <div class="sidebar-footer">
    <div class="user-info">
      <i class="fas fa-user-circle"></i>
      <span>{{ Auth::user()->name ?? 'Admin' }}</span>
    </div>
  </div>
</aside>

<style>
  .admin-sidebar {
    position: sticky;
    top: 1rem;
    height: fit-content;
    width: 280px;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .sidebar-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
  }

  .sidebar-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
  }

  .sidebar-logo i {
    font-size: 1.4rem;
  }

  .sidebar-nav {
    flex: 1;
    overflow-y: auto;
    padding: 1rem 0;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .sidebar-nav::-webkit-scrollbar {
    width: 6px;
  }

  .sidebar-nav::-webkit-scrollbar-track {
    background: transparent;
  }

  .sidebar-nav::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
  }

  .sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
  }

  .nav-section {
    padding: 0.5rem;
  }

  .nav-section:not(:last-child) {
    border-bottom: 1px solid #e2e8f0;
  }

  .nav-section-label {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #94a3b8;
    padding: 1rem 1rem 0.5rem;
    display: block;
  }

  .nav-item,
  .dropdown-item {
    width: 100%;
    padding: 0.85rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    border: none;
    background: transparent;
    color: #475569;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: left;
    border-radius: 10px;
    position: relative;
    white-space: nowrap;
    text-decoration: none;
  }

  .nav-item i,
  .dropdown-item i {
    width: 20px;
    text-align: center;
    font-size: 1rem;
    flex-shrink: 0;
  }

  .nav-item span,
  .dropdown-item span {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .nav-item:hover {
    background-color: #f1f5f9;
    color: #667eea;
    transform: translateX(2px);
  }

  .nav-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.25);
  }

  .nav-item.active i {
    animation: iconPulse 0.5s ease;
  }

  /* Removed dropdown-specific styles; navigation is flat now */

  .sidebar-footer {
    padding: 1rem;
    border-top: 1px solid #e2e8f0;
    background: #f8fafc;
  }

  .user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    font-size: 0.9rem;
    color: #475569;
    font-weight: 500;
  }

  .user-info i {
    font-size: 1.5rem;
    color: #667eea;
  }

  @keyframes iconPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.15); }
    100% { transform: scale(1); }
  }

  /* Responsive Design */
  @media (max-width: 900px) {
    .admin-sidebar {
      position: static;
      width: 100%;
      margin-bottom: 1.5rem;
      max-height: none;
    }
  }

  @media (max-width: 640px) {
    .admin-sidebar {
      width: 100%;
    }

    .sidebar-nav {
      flex-direction: row;
      flex-wrap: wrap;
    }

    .nav-section {
      min-width: 50%;
    }

    .nav-item span,
    .dropdown-item span {
      display: none;
    }

    .nav-item,
    .dropdown-item {
      justify-content: center;
      padding: 0.75rem;
    }

    .user-info span {
      display: none;
    }
  }
</style>
