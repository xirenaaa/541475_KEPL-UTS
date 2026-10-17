<template>
  <div class="dashboard-page">
    <!-- Top Navigation Bar -->
    <header class="top-nav">
      <div class="brand-pill">
        <svg class="brand-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
          <path d="M6 6h10" />
          <path d="M6 10h7" />
        </svg>
        <span>Bibliotech</span>
      </div>

      <nav class="nav-center">
        <button class="nav-pill active">Dashboard</button>
        <button class="nav-pill-link">Katalog</button>
        <button class="nav-pill-link">Sirkulasi</button>
        <button class="nav-pill-link">Anggota</button>
        <button class="nav-pill-link">Statistik</button>
      </nav>

      <div class="nav-right">
        <div class="user-pill">
          <div class="avatar-circle">
            {{ userInitial }}
          </div>
          <span class="user-name">{{ userName }}</span>
        </div>
        <button class="btn-logout-icon" title="Keluar dari sistem" @click="logout">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
          </svg>
        </button>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="main-shell">
      <!-- Greeting & Top KPI Section -->
      <section class="hero-kpi-row">
        <div class="hero-left">
          <h1 class="welcome-heading">Welcome in, {{ userName }}</h1>
          <div class="segment-pill-row">
            <div class="stat-segment">
              <span class="seg-label">Total Koleksi</span>
              <div class="pill-badge dark">100%</div>
            </div>
            <div class="stat-segment">
              <span class="seg-label">Tersedia</span>
              <div class="pill-badge yellow">85%</div>
            </div>
            <div class="stat-segment">
              <span class="seg-label">Peminjaman</span>
              <div class="pill-badge striped">15%</div>
            </div>
          </div>
        </div>

        <div class="hero-right-kpis">
          <div class="kpi-unit">
            <div class="kpi-icon-wrap">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
              </svg>
            </div>
            <div class="kpi-data">
              <span class="kpi-num">{{ books.length }}</span>
              <span class="kpi-sub">Judul Buku</span>
            </div>
          </div>

          <div class="kpi-unit">
            <div class="kpi-icon-wrap">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
            </div>
            <div class="kpi-data">
              <span class="kpi-num">{{ totalAuthors }}</span>
              <span class="kpi-sub">Penulis</span>
            </div>
          </div>

          <div class="kpi-unit">
            <div class="kpi-icon-wrap">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
              </svg>
            </div>
            <div class="kpi-data">
              <span class="kpi-num">{{ estimatedCopies }}</span>
              <span class="kpi-sub">Eksemplar</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Bento Grid Section -->
      <section class="bento-grid">
        <!-- Card 1: Featured Highlight -->
        <div class="bento-card card-featured">
          <div class="featured-top">
            <span class="tag-pill-yellow">Sorotan Utama</span>
            <span class="featured-year">2026</span>
          </div>
          <div class="featured-info">
            <h3 class="featured-title">{{ featuredBookTitle }}</h3>
            <p class="featured-author">Karya: {{ featuredBookAuthor }}</p>
          </div>
          <div class="featured-footer">
            <span class="isbn-code">ISBN: {{ featuredBookIsbn }}</span>
            <div class="status-indicator">Tersedia di Rak A-1</div>
          </div>
        </div>

        <!-- Card 2: Weekly Activity Progress Bars -->
        <div class="bento-card card-chart">
          <div class="card-title-row">
            <div>
              <span class="sub-caption">Aktivitas Mingguan</span>
              <h4 class="card-headline">14.8k <span class="unit-text">Akses Buku</span></h4>
            </div>
            <div class="mini-arrow-btn">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="7" y1="17" x2="17" y2="7" />
                <polyline points="7 7 17 7 17 17" />
              </svg>
            </div>
          </div>
          <!-- Bar Graph Visualization -->
          <div class="bar-chart-visual">
            <div class="bar-col">
              <div class="bar-fill" style="height: 45%;"></div>
              <span class="day-lbl">S</span>
            </div>
            <div class="bar-col">
              <div class="bar-fill" style="height: 70%;"></div>
              <span class="day-lbl">M</span>
            </div>
            <div class="bar-col">
              <div class="bar-fill" style="height: 55%;"></div>
              <span class="day-lbl">T</span>
            </div>
            <div class="bar-col">
              <div class="bar-fill" style="height: 85%;"></div>
              <span class="day-lbl">W</span>
            </div>
            <div class="bar-col active-day">
              <div class="tooltip-val">12 Buku</div>
              <div class="bar-fill accent" style="height: 95%;"></div>
              <span class="day-lbl">T</span>
            </div>
            <div class="bar-col">
              <div class="bar-fill" style="height: 60%;"></div>
              <span class="day-lbl">F</span>
            </div>
            <div class="bar-col">
              <div class="bar-fill" style="height: 35%;"></div>
              <span class="day-lbl">S</span>
            </div>
          </div>
        </div>

        <!-- Card 3: Service Status & Timer -->
        <div class="bento-card card-service">
          <div class="card-title-row">
            <div>
              <span class="sub-caption">Layanan Sirkulasi</span>
              <h4 class="card-headline">Waktu Layanan</h4>
            </div>
            <div class="mini-arrow-btn">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="7" y1="17" x2="17" y2="7" />
                <polyline points="7 7 17 7 17 17" />
              </svg>
            </div>
          </div>
          <div class="timer-dial-wrap">
            <div class="circular-dial">
              <span class="dial-time">08:30</span>
              <span class="dial-caption">Jam Buka</span>
            </div>
            <div class="timer-controls">
              <button class="btn-ctrl active">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor">
                  <polygon points="5 3 19 12 5 21 5 3" />
                </svg>
              </button>
              <button class="btn-ctrl">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor">
                  <rect x="6" y="4" width="4" height="16" />
                  <rect x="14" y="4" width="4" height="16" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Card 4: Dark Companion Card (SOP Checklist) -->
        <div class="bento-card card-dark-widget">
          <div class="dark-header">
            <span class="dark-title">Status Kurasi</span>
            <span class="dark-count">4/4</span>
          </div>
          <div class="task-list">
            <div class="task-item">
              <div class="task-icon-circle">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                  <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
              </div>
              <div class="task-desc">
                <span class="t-name">Katalogisasi ISBN</span>
                <span class="t-time">Lengkap</span>
              </div>
              <div class="check-pill">Aktif</div>
            </div>

            <div class="task-item">
              <div class="task-icon-circle">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10" />
                  <polyline points="12 6 12 12 14 14" />
                </svg>
              </div>
              <div class="task-desc">
                <span class="t-name">Sinkronisasi Database</span>
                <span class="t-time">MySQL 8.0</span>
              </div>
              <div class="check-pill">Aktif</div>
            </div>

            <div class="task-item">
              <div class="task-icon-circle">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="2" y="2" width="20" height="8" rx="2" ry="2" />
                  <rect x="2" y="14" width="20" height="8" rx="2" ry="2" />
                </svg>
              </div>
              <div class="task-desc">
                <span class="t-name">Server FrankenPHP</span>
                <span class="t-time">Port 8000</span>
              </div>
              <div class="check-pill">Aktif</div>
            </div>
          </div>
        </div>
      </section>

      <!-- Main CRUD Section: Book Catalog Table -->
      <section class="catalog-section">
        <div class="catalog-header-bar">
          <div>
            <h2 class="section-title">Katalog Koleksi Buku</h2>
            <p class="section-subtitle">Daftar buku terdaftar dalam basis data sistem perpustakaan</p>
          </div>
          <div class="action-toolbar">
            <div class="search-box">
              <svg class="search-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
              </svg>
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Cari judul atau penulis..."
              />
            </div>
            <button class="btn-dark-pill" @click="openAddModal">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
              </svg>
              <span>Tambah Buku</span>
            </button>
          </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="state-container">
          <div class="clean-spinner"></div>
          <p>Memuat data katalog...</p>
        </div>

        <!-- Empty State -->
        <div v-else-if="filteredBooks.length === 0" class="state-container">
          <div class="empty-icon-wrap">
            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
              <line x1="10" y1="10" x2="14" y2="10" />
            </svg>
          </div>
          <p class="empty-title">Belum ada buku yang ditemukan</p>
          <p class="empty-desc">Klik tombol "Tambah Buku" untuk mendaftarkan pustaka baru ke dalam sistem.</p>
        </div>

        <!-- Clean Table -->
        <div v-else class="table-card">
          <table class="clean-table">
            <thead>
              <tr>
                <th style="width: 50px;">NO</th>
                <th>JUDUL BUKU</th>
                <th>PENULIS</th>
                <th>ISBN</th>
                <th>PENERBIT</th>
                <th>TAHUN</th>
                <th style="text-align: right; width: 150px;">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(book, index) in filteredBooks" :key="book.id">
                <td class="col-num">{{ index + 1 }}</td>
                <td class="col-title">
                  <div class="book-title-cell">
                    <span class="title-primary">{{ book.title }}</span>
                    <span v-if="book.description" class="title-desc">{{ book.description }}</span>
                  </div>
                </td>
                <td class="col-author">{{ book.author }}</td>
                <td class="col-isbn">
                  <span class="isbn-tag">{{ book.isbn }}</span>
                </td>
                <td class="col-pub">{{ book.publisher || '-' }}</td>
                <td class="col-year">
                  <span class="year-pill">{{ book.year || '-' }}</span>
                </td>
                <td class="col-actions">
                  <div class="btn-group-row">
                    <button class="btn-action edit" @click="openEditModal(book)" title="Edit data">
                      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                      </svg>
                      <span>Edit</span>
                    </button>
                    <button class="btn-action delete" @click="confirmDelete(book)" title="Hapus buku">
                      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                      </svg>
                      <span>Hapus</span>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </main>

    <!-- Modal Form (Tambah & Edit) -->
    <div v-if="showModal" class="modal-backdrop" @click.self="closeModal">
      <div class="modal-card">
        <div class="modal-top">
          <div>
            <span class="sub-caption">Pustaka Digital</span>
            <h3 class="modal-headline">{{ isEditing ? 'Edit Informasi Buku' : 'Tambah Buku Baru' }}</h3>
          </div>
          <button class="btn-close-modal" @click="closeModal">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18" />
              <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
          </button>
        </div>

        <form @submit.prevent="isEditing ? updateBook() : createBook()" class="modal-form">
          <div class="field-item">
            <label for="modal-title">Judul Buku *</label>
            <input
              id="modal-title"
              v-model="form.title"
              type="text"
              placeholder="Masukkan judul buku secara lengkap"
              required
            />
          </div>

          <div class="field-item">
            <label for="modal-author">Nama Penulis *</label>
            <input
              id="modal-author"
              v-model="form.author"
              type="text"
              placeholder="Contoh: Robert C. Martin"
              required
            />
          </div>

          <div class="field-item">
            <label for="modal-isbn">Nomor ISBN *</label>
            <input
              id="modal-isbn"
              v-model="form.isbn"
              type="text"
              placeholder="978-x-xx-xxxxxx-x"
              required
            />
          </div>

          <div class="field-grid-2">
            <div class="field-item">
              <label for="modal-publisher">Penerbit</label>
              <input
                id="modal-publisher"
                v-model="form.publisher"
                type="text"
                placeholder="Nama penerbit buku"
              />
            </div>
            <div class="field-item">
              <label for="modal-year">Tahun Terbit</label>
              <input
                id="modal-year"
                v-model.number="form.year"
                type="number"
                placeholder="2024"
                min="1000"
                max="2030"
              />
            </div>
          </div>

          <div class="field-item">
            <label for="modal-desc">Deskripsi Singkat</label>
            <textarea
              id="modal-desc"
              v-model="form.description"
              rows="3"
              placeholder="Ringkasan topik atau catatan buku..."
            ></textarea>
          </div>

          <div v-if="formError" class="modal-error">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <span>{{ formError }}</span>
          </div>

          <div class="modal-action-row">
            <button type="button" class="btn-secondary-pill" @click="closeModal">Batal</button>
            <button type="submit" class="btn-dark-pill" :disabled="saving">
              {{ saving ? 'Menyimpan...' : (isEditing ? 'Simpan Perubahan' : 'Tambah Buku') }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div v-if="showDeleteConfirm" class="modal-backdrop" @click.self="showDeleteConfirm = false">
      <div class="modal-card modal-compact">
        <div class="modal-top">
          <h3 class="modal-headline">Konfirmasi Hapus</h3>
          <button class="btn-close-modal" @click="showDeleteConfirm = false">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18" />
              <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
          </button>
        </div>
        <p class="delete-warning-text">
          Apakah Anda yakin ingin menghapus buku <strong>"{{ bookToDelete?.title }}"</strong> dari basis data? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="modal-action-row">
          <button type="button" class="btn-secondary-pill" @click="showDeleteConfirm = false">Batal</button>
          <button type="button" class="btn-danger-pill" @click="deleteBook" :disabled="saving">
            {{ saving ? 'Menghapus...' : 'Ya, Hapus Data' }}
          </button>
        </div>
      </div>
    </div>

    <!-- Toast Notification -->
    <div v-if="notification" class="toast-pill" :class="notification.type">
      <svg v-if="notification.type === 'success'" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="20 6 9 17 4 12" />
      </svg>
      <svg v-else viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" y1="8" x2="12" y2="12" />
      </svg>
      <span>{{ notification.message }}</span>
    </div>
  </div>
</template>

<script>
import api from '../api'

export default {
  name: 'BooksPage',
  data() {
    return {
      books: [],
      loading: true,
      searchQuery: '',
      showModal: false,
      showDeleteConfirm: false,
      isEditing: false,
      saving: false,
      formError: '',
      notification: null,
      bookToDelete: null,
      editingBookId: null,
      form: {
        title: '',
        author: '',
        isbn: '',
        publisher: '',
        year: null,
        description: '',
      },
    }
  },
  computed: {
    userName() {
      try {
        const user = JSON.parse(localStorage.getItem('user'))
        return user?.name || 'Pustakawan'
      } catch {
        return 'Pustakawan'
      }
    },
    userInitial() {
      return this.userName.charAt(0).toUpperCase()
    },
    totalAuthors() {
      const authors = new Set(this.books.map(b => b.author).filter(Boolean))
      return authors.size || 0
    },
    estimatedCopies() {
      return this.books.length * 3 + 12
    },
    featuredBookTitle() {
      return this.books[0]?.title || 'Clean Code: Handbook of Agile'
    },
    featuredBookAuthor() {
      return this.books[0]?.author || 'Robert C. Martin'
    },
    featuredBookIsbn() {
      return this.books[0]?.isbn || '978-0-13-235088-4'
    },
    filteredBooks() {
      if (!this.searchQuery) return this.books
      const q = this.searchQuery.toLowerCase()
      return this.books.filter(
        b =>
          b.title?.toLowerCase().includes(q) ||
          b.author?.toLowerCase().includes(q) ||
          b.isbn?.toLowerCase().includes(q)
      )
    },
  },
  mounted() {
    this.fetchBooks()
  },
  methods: {
    async fetchBooks() {
      this.loading = true
      try {
        const response = await api.get('/books')
        this.books = response.data.data
      } catch (err) {
        this.showNotification('Gagal memuat katalog buku.', 'error')
      } finally {
        this.loading = false
      }
    },
    openAddModal() {
      this.isEditing = false
      this.formError = ''
      this.form = { title: '', author: '', isbn: '', publisher: '', year: null, description: '' }
      this.showModal = true
    },
    openEditModal(book) {
      this.isEditing = true
      this.editingBookId = book.id
      this.formError = ''
      this.form = {
        title: book.title,
        author: book.author,
        isbn: book.isbn,
        publisher: book.publisher || '',
        year: book.year || null,
        description: book.description || '',
      }
      this.showModal = true
    },
    closeModal() {
      this.showModal = false
      this.formError = ''
    },
    async createBook() {
      this.saving = true
      this.formError = ''
      try {
        await api.post('/books', this.form)
        this.showNotification('Buku baru berhasil ditambahkan.', 'success')
        this.closeModal()
        await this.fetchBooks()
      } catch (err) {
        if (err.response && err.response.status === 422) {
          const errors = err.response.data.errors
          this.formError = errors ? Object.values(errors).flat().join(', ') : 'Validasi input tidak sesuai.'
        } else {
          this.formError = 'Gagal menyimpan buku baru.'
        }
      } finally {
        this.saving = false
      }
    },
    async updateBook() {
      this.saving = true
      this.formError = ''
      try {
        await api.put(`/books/${this.editingBookId}`, this.form)
        this.showNotification('Data buku berhasil diperbarui.', 'success')
        this.closeModal()
        await this.fetchBooks()
      } catch (err) {
        if (err.response && err.response.status === 422) {
          const errors = err.response.data.errors
          this.formError = errors ? Object.values(errors).flat().join(', ') : 'Validasi input tidak sesuai.'
        } else {
          this.formError = 'Gagal memperbarui data buku.'
        }
      } finally {
        this.saving = false
      }
    },
    confirmDelete(book) {
      this.bookToDelete = book
      this.showDeleteConfirm = true
    },
    async deleteBook() {
      this.saving = true
      try {
        await api.delete(`/books/${this.bookToDelete.id}`)
        this.showNotification('Buku telah dihapus dari sistem.', 'success')
        this.showDeleteConfirm = false
        await this.fetchBooks()
      } catch {
        this.showNotification('Gagal menghapus data buku.', 'error')
      } finally {
        this.saving = false
      }
    },
    async logout() {
      try {
        await api.post('/logout')
      } catch {
        // ignore
      }
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      this.$router.push('/login')
    },
    showNotification(message, type = 'success') {
      this.notification = { message, type }
      setTimeout(() => {
        this.notification = null
      }, 3500)
    },
  },
}
</script>

<style scoped>
.dashboard-page {
  min-height: 100vh;
  padding: 24px 36px 60px 36px;
  max-width: 1440px;
  margin: 0 auto;
}

/* 1. Top Navigation Bar */
.top-nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
}

.brand-pill {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  padding: 8px 20px;
  border-radius: 9999px;
  font-family: 'Outfit', sans-serif;
  font-weight: 600;
  font-size: 1.1rem;
  color: #18181b;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
}

.brand-icon {
  width: 20px;
  height: 20px;
  color: #18181b;
}

.nav-center {
  display: flex;
  align-items: center;
  gap: 8px;
}

.nav-pill {
  border: none;
  background: #18181b;
  color: #ffffff;
  padding: 8px 22px;
  border-radius: 9999px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 0.88rem;
  font-weight: 500;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.nav-pill-link {
  border: none;
  background: transparent;
  color: #52525b;
  padding: 8px 16px;
  border-radius: 9999px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 0.88rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
}

.nav-pill-link:hover {
  color: #18181b;
  background: rgba(255, 255, 255, 0.6);
}

.nav-right {
  display: flex;
  align-items: center;
  gap: 12px;
}

.user-pill {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  padding: 5px 16px 5px 6px;
  border-radius: 9999px;
}

.avatar-circle {
  width: 28px;
  height: 28px;
  background: #fbbf24;
  color: #18181b;
  font-weight: 700;
  font-size: 0.85rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
}

.user-name {
  font-size: 0.86rem;
  font-weight: 600;
  color: #27272a;
}

.btn-logout-icon {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  border: 1px solid rgba(0, 0, 0, 0.08);
  background: #ffffff;
  color: #71717a;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-logout-icon:hover {
  background: #fee2e2;
  color: #dc2626;
  border-color: #fca5a5;
}

/* 2. Hero & Quick KPI Section */
.hero-kpi-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-bottom: 28px;
  gap: 24px;
}

.welcome-heading {
  font-size: 2.25rem;
  font-weight: 400;
  color: #18181b;
  letter-spacing: -0.03em;
  margin-bottom: 14px;
}

.segment-pill-row {
  display: flex;
  align-items: center;
  gap: 16px;
}

.stat-segment {
  display: flex;
  align-items: center;
  gap: 8px;
}

.seg-label {
  font-size: 0.82rem;
  color: #71717a;
  font-weight: 500;
}

.pill-badge {
  padding: 5px 14px;
  border-radius: 9999px;
  font-size: 0.8rem;
  font-weight: 600;
  font-family: 'JetBrains Mono', monospace;
}

.pill-badge.dark {
  background: #18181b;
  color: #ffffff;
}

.pill-badge.yellow {
  background: #fcd34d;
  color: #78350f;
}

.pill-badge.striped {
  background: #ffffff;
  color: #71717a;
  border: 1px dashed #d4d4d8;
}

.hero-right-kpis {
  display: flex;
  align-items: center;
  gap: 32px;
}

.kpi-unit {
  display: flex;
  align-items: center;
  gap: 12px;
}

.kpi-icon-wrap {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.06);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #52525b;
}

.kpi-data {
  display: flex;
  flex-direction: column;
}

.kpi-num {
  font-size: 1.85rem;
  font-weight: 500;
  line-height: 1.1;
  color: #18181b;
}

.kpi-sub {
  font-size: 0.78rem;
  color: #71717a;
  text-transform: capitalize;
}

/* 3. Bento Grid */
.bento-grid {
  display: grid;
  grid-template-columns: 1.2fr 1fr 1fr 1.1fr;
  gap: 20px;
  margin-bottom: 32px;
}

.bento-card {
  background: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.06);
  border-radius: 26px;
  padding: 24px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.card-title-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 16px;
}

.sub-caption {
  font-size: 0.8rem;
  color: #71717a;
  font-weight: 500;
}

.card-headline {
  font-size: 1.25rem;
  font-weight: 500;
  color: #18181b;
  margin-top: 2px;
}

.unit-text {
  font-size: 0.82rem;
  color: #71717a;
  font-weight: 400;
}

.mini-arrow-btn {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  border: 1px solid rgba(0, 0, 0, 0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #71717a;
}

/* Featured Card */
.card-featured {
  background: linear-gradient(145deg, #ffffff 0%, #fefcf7 100%);
}

.featured-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.tag-pill-yellow {
  background: #fef3c7;
  color: #92400e;
  padding: 4px 12px;
  border-radius: 9999px;
  font-size: 0.76rem;
  font-weight: 600;
}

.featured-year {
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.82rem;
  color: #a1a1aa;
}

.featured-title {
  font-size: 1.15rem;
  font-weight: 600;
  color: #18181b;
  line-height: 1.35;
  margin-bottom: 6px;
}

.featured-author {
  font-size: 0.84rem;
  color: #71717a;
}

.featured-footer {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 14px;
  border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.isbn-code {
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.78rem;
  color: #71717a;
}

.status-indicator {
  font-size: 0.78rem;
  color: #059669;
  font-weight: 600;
}

/* Bar Chart Card */
.bar-chart-visual {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  height: 110px;
  padding-top: 24px;
}

.bar-col {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  flex: 1;
  height: 100%;
  justify-content: flex-end;
  position: relative;
}

.bar-fill {
  width: 8px;
  background: #18181b;
  border-radius: 9999px;
  transition: height 0.3s ease;
}

.bar-fill.accent {
  background: #fbbf24;
  width: 10px;
}

.day-lbl {
  font-size: 0.72rem;
  color: #a1a1aa;
  font-weight: 600;
}

.tooltip-val {
  position: absolute;
  top: -24px;
  background: #fcd34d;
  color: #78350f;
  padding: 2px 6px;
  border-radius: 6px;
  font-size: 0.68rem;
  font-weight: 700;
  white-space: nowrap;
}

/* Service Dial Card */
.timer-dial-wrap {
  display: flex;
  align-items: center;
  justify-content: space-around;
  padding: 10px 0;
}

.circular-dial {
  width: 88px;
  height: 88px;
  border-radius: 50%;
  border: 4px solid #fef3c7;
  border-top-color: #fbbf24;
  border-right-color: #fbbf24;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.dial-time {
  font-size: 1.15rem;
  font-weight: 700;
  font-family: 'Outfit', sans-serif;
  color: #18181b;
}

.dial-caption {
  font-size: 0.65rem;
  color: #a1a1aa;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.timer-controls {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.btn-ctrl {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 1px solid rgba(0, 0, 0, 0.08);
  background: #f4f4f5;
  color: #71717a;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.btn-ctrl.active {
  background: #18181b;
  color: #ffffff;
}

/* Dark Card (Right Bento) */
.card-dark-widget {
  background: #242426;
  color: #ffffff;
}

.dark-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.dark-title {
  font-size: 0.95rem;
  font-weight: 600;
  color: #f4f4f5;
}

.dark-count {
  font-family: 'JetBrains Mono', monospace;
  font-size: 1.1rem;
  font-weight: 600;
  color: #fbbf24;
}

.task-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.task-item {
  display: flex;
  align-items: center;
  gap: 10px;
  background: rgba(255, 255, 255, 0.05);
  padding: 8px 12px;
  border-radius: 14px;
}

.task-icon-circle {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: rgba(251, 191, 36, 0.2);
  color: #fbbf24;
  display: flex;
  align-items: center;
  justify-content: center;
}

.task-desc {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.t-name {
  font-size: 0.8rem;
  color: #f4f4f5;
  font-weight: 500;
}

.t-time {
  font-size: 0.7rem;
  color: #a1a1aa;
}

.check-pill {
  font-size: 0.68rem;
  color: #fbbf24;
  font-weight: 600;
}

/* 4. Main CRUD Section */
.catalog-section {
  background: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.06);
  border-radius: 28px;
  padding: 30px;
  box-shadow: 0 4px 25px rgba(0, 0, 0, 0.02);
}

.catalog-header-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  gap: 20px;
}

.section-title {
  font-size: 1.4rem;
  font-weight: 600;
  color: #18181b;
}

.section-subtitle {
  font-size: 0.86rem;
  color: #71717a;
  margin-top: 2px;
}

.action-toolbar {
  display: flex;
  align-items: center;
  gap: 14px;
}

.search-box {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #fafaf9;
  border: 1px solid rgba(0, 0, 0, 0.09);
  border-radius: 9999px;
  padding: 8px 16px;
  width: 260px;
}

.search-icon {
  color: #a1a1aa;
}

.search-box input {
  border: none;
  background: transparent;
  outline: none;
  font-family: inherit;
  font-size: 0.86rem;
  color: #18181b;
  width: 100%;
}

.btn-dark-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 22px;
  background: #18181b;
  color: #ffffff;
  border: none;
  border-radius: 9999px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 0.88rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
  white-space: nowrap;
}

.btn-dark-pill:hover:not(:disabled) {
  background: #27272a;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(24, 24, 27, 0.15);
}

.btn-dark-pill:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Clean Table */
.table-card {
  overflow-x: auto;
}

.clean-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}

.clean-table th {
  padding: 12px 16px;
  font-size: 0.74rem;
  font-weight: 600;
  color: #a1a1aa;
  letter-spacing: 0.5px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}

.clean-table td {
  padding: 16px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.04);
  font-size: 0.88rem;
  color: #27272a;
  vertical-align: middle;
}

.clean-table tr:hover td {
  background: #fafaf9;
}

.col-num {
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.82rem;
  color: #a1a1aa;
}

.book-title-cell {
  display: flex;
  flex-direction: column;
}

.title-primary {
  font-weight: 600;
  color: #18181b;
}

.title-desc {
  font-size: 0.78rem;
  color: #71717a;
  margin-top: 2px;
}

.col-author {
  color: #52525b;
}

.isbn-tag {
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.8rem;
  color: #71717a;
  background: #f4f4f5;
  padding: 4px 8px;
  border-radius: 6px;
}

.year-pill {
  display: inline-block;
  padding: 3px 10px;
  border-radius: 9999px;
  background: #fef3c7;
  color: #92400e;
  font-size: 0.78rem;
  font-weight: 600;
  font-family: 'JetBrains Mono', monospace;
}

.btn-group-row {
  display: flex;
  justify-content: flex-end;
  gap: 8px;
}

.btn-action {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 6px 12px;
  border-radius: 9999px;
  font-family: inherit;
  font-size: 0.78rem;
  font-weight: 500;
  cursor: pointer;
  border: 1px solid rgba(0, 0, 0, 0.08);
  background: #ffffff;
  transition: all 0.2s ease;
}

.btn-action.edit {
  color: #27272a;
}

.btn-action.edit:hover {
  background: #f4f4f5;
  border-color: #d4d4d8;
}

.btn-action.delete {
  color: #b91c1c;
}

.btn-action.delete:hover {
  background: #fef2f2;
  border-color: #fecaca;
}

/* Empty & Loading */
.state-container {
  text-align: center;
  padding: 50px 20px;
  color: #71717a;
}

.empty-icon-wrap {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: #fafaf9;
  border: 1px solid rgba(0, 0, 0, 0.06);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 12px;
  color: #a1a1aa;
}

.empty-title {
  font-weight: 600;
  color: #27272a;
  font-size: 1rem;
}

.empty-desc {
  font-size: 0.85rem;
  color: #71717a;
  margin-top: 4px;
}

.clean-spinner {
  width: 32px;
  height: 32px;
  border: 3px solid #f4f4f5;
  border-top-color: #fbbf24;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
  margin: 0 auto 12px;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* 5. Modal */
.modal-backdrop {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(24, 24, 27, 0.45);
  backdrop-filter: blur(4px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 20px;
}

.modal-card {
  background: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 28px;
  width: 100%;
  max-width: 520px;
  max-height: 90vh;
  overflow-y: auto;
  padding: 32px;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.12);
}

.modal-compact {
  max-width: 420px;
}

.modal-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 22px;
}

.modal-headline {
  font-size: 1.25rem;
  font-weight: 600;
  color: #18181b;
}

.btn-close-modal {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 1px solid rgba(0, 0, 0, 0.08);
  background: #fafaf9;
  color: #71717a;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.modal-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.field-item {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.field-item label {
  font-size: 0.82rem;
  font-weight: 600;
  color: #27272a;
}

.field-item input,
.field-item textarea {
  width: 100%;
  padding: 10px 14px;
  background: #fafaf9;
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 12px;
  font-family: inherit;
  font-size: 0.9rem;
  color: #18181b;
  outline: none;
  transition: all 0.2s ease;
}

.field-item input:focus,
.field-item textarea:focus {
  background: #ffffff;
  border-color: #fbbf24;
  box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.18);
}

.field-grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}

.modal-error {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #fef2f2;
  border: 1px solid #fecaca;
  color: #b91c1c;
  padding: 10px 12px;
  border-radius: 10px;
  font-size: 0.82rem;
}

.modal-action-row {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
  margin-top: 10px;
}

.btn-secondary-pill {
  padding: 10px 20px;
  background: #f4f4f5;
  color: #52525b;
  border: none;
  border-radius: 9999px;
  font-family: inherit;
  font-size: 0.88rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-secondary-pill:hover {
  background: #e4e4e7;
  color: #18181b;
}

.btn-danger-pill {
  padding: 10px 22px;
  background: #dc2626;
  color: #ffffff;
  border: none;
  border-radius: 9999px;
  font-family: inherit;
  font-size: 0.88rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-danger-pill:hover:not(:disabled) {
  background: #b91c1c;
}

.delete-warning-text {
  font-size: 0.9rem;
  color: #52525b;
  line-height: 1.5;
  margin-bottom: 24px;
}

/* 6. Toast Notification */
.toast-pill {
  position: fixed;
  bottom: 30px;
  right: 30px;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 22px;
  border-radius: 9999px;
  background: #18181b;
  color: #ffffff;
  font-size: 0.86rem;
  font-weight: 500;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  z-index: 2000;
  animation: slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.toast-pill.success {
  border-left: 4px solid #10b981;
}

.toast-pill.error {
  border-left: 4px solid #ef4444;
}

@keyframes slideUp {
  from { transform: translateY(20px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

/* Responsive */
@media (max-width: 1100px) {
  .bento-grid {
    grid-template-columns: 1fr 1fr;
  }
}

@media (max-width: 768px) {
  .dashboard-page {
    padding: 16px;
  }
  .top-nav {
    flex-direction: column;
    gap: 14px;
    align-items: flex-start;
  }
  .hero-kpi-row {
    flex-direction: column;
    align-items: flex-start;
  }
  .bento-grid {
    grid-template-columns: 1fr;
  }
  .catalog-header-bar {
    flex-direction: column;
    align-items: flex-start;
  }
  .action-toolbar {
    width: 100%;
    flex-direction: column;
  }
  .search-box {
    width: 100%;
  }
  .btn-dark-pill {
    width: 100%;
    justify-content: center;
  }
  .field-grid-2 {
    grid-template-columns: 1fr;
  }
}
</style>
