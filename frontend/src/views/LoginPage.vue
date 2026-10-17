<template>
  <div class="login-wrapper">
    <!-- Top Ambient Pill Header -->
    <header class="top-nav">
      <div class="brand-pill">
        <svg class="brand-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
          <path d="M6 6h10" />
          <path d="M6 10h7" />
        </svg>
        <span>Bibliotech</span>
      </div>
      <div class="nav-links">
        <span class="nav-pill active">Akses Katalog</span>
        <span class="nav-link">Bantuan</span>
      </div>
    </header>

    <!-- Main Card -->
    <main class="login-center">
      <div class="card-login">
        <div class="card-header">
          <h1 class="login-title">{{ isRegister ? 'Buat Akun Baru' : 'Welcome in' }}</h1>
          <p class="login-desc">
            {{ isRegister ? 'Lengkapi data untuk mendaftar pustakawan baru' : 'Silakan masuk untuk mengelola sistem katalog pustaka' }}
          </p>
        </div>

        <!-- Mode Toggle Tabs -->
        <div class="tab-pill-group">
          <button
            type="button"
            class="tab-pill"
            :class="{ active: !isRegister }"
            @click="isRegister = false; error = ''"
          >
            Masuk
          </button>
          <button
            type="button"
            class="tab-pill"
            :class="{ active: isRegister }"
            @click="isRegister = true; error = ''"
          >
            Daftar
          </button>
        </div>

        <!-- Register Form -->
        <form v-if="isRegister" @submit.prevent="register" class="form-body">
          <div class="field-group">
            <label for="reg-name">Nama Lengkap</label>
            <input
              id="reg-name"
              v-model="regForm.name"
              type="text"
              placeholder="Contoh: Falah Auladi"
              required
            />
          </div>

          <div class="field-group">
            <label for="reg-email">Alamat Email</label>
            <input
              id="reg-email"
              v-model="regForm.email"
              type="email"
              placeholder="nama@institusi.ac.id"
              required
            />
          </div>

          <div class="field-group">
            <label for="reg-password">Kata Sandi</label>
            <input
              id="reg-password"
              v-model="regForm.password"
              type="password"
              placeholder="Minimal 6 karakter"
              required
            />
          </div>

          <div class="field-group">
            <label for="reg-password-confirm">Konfirmasi Kata Sandi</label>
            <input
              id="reg-password-confirm"
              v-model="regForm.password_confirmation"
              type="password"
              placeholder="Ulangi kata sandi"
              required
            />
          </div>

          <div v-if="error" class="alert-error">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <span>{{ error }}</span>
          </div>

          <button type="submit" class="btn-dark-pill" :disabled="loading">
            {{ loading ? 'Memproses Pendaftaran...' : 'Daftar Akun Baru' }}
          </button>
        </form>

        <!-- Login Form -->
        <form v-else @submit.prevent="login" class="form-body">
          <div class="field-group">
            <label for="login-email">Alamat Email</label>
            <input
              id="login-email"
              v-model="loginForm.email"
              type="email"
              placeholder="admin@perpustakaan.com"
              required
            />
          </div>

          <div class="field-group">
            <div class="label-row">
              <label for="login-password">Kata Sandi</label>
              <span class="hint-text">Bawaan: password123</span>
            </div>
            <input
              id="login-password"
              v-model="loginForm.password"
              type="password"
              placeholder="Masukkan kata sandi"
              required
            />
          </div>

          <div v-if="error" class="alert-error">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <span>{{ error }}</span>
          </div>

          <button type="submit" class="btn-dark-pill" :disabled="loading">
            {{ loading ? 'Memverifikasi...' : 'Masuk ke Dashboard' }}
          </button>
        </form>

        <div class="card-footer-info">
          <span>Sistem Manajemen RESTful API &middot; KEPL 2026</span>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import api from '../api'

export default {
  name: 'LoginPage',
  data() {
    return {
      isRegister: false,
      loading: false,
      error: '',
      loginForm: {
        email: '',
        password: '',
      },
      regForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
    }
  },
  methods: {
    async login() {
      this.loading = true
      this.error = ''
      try {
        const response = await api.post('/login', this.loginForm)
        localStorage.setItem('token', response.data.token)
        localStorage.setItem('user', JSON.stringify(response.data.user))
        this.$router.push('/')
      } catch (err) {
        if (err.response && err.response.status === 422) {
          const errors = err.response.data.errors
          this.error = errors ? Object.values(errors).flat().join(', ') : err.response.data.message
        } else {
          this.error = 'Kombinasi email atau kata sandi tidak sesuai.'
        }
      } finally {
        this.loading = false
      }
    },
    async register() {
      this.loading = true
      this.error = ''
      try {
        const response = await api.post('/register', this.regForm)
        localStorage.setItem('token', response.data.token)
        localStorage.setItem('user', JSON.stringify(response.data.user))
        this.$router.push('/')
      } catch (err) {
        if (err.response && err.response.status === 422) {
          const errors = err.response.data.errors
          this.error = errors ? Object.values(errors).flat().join(', ') : err.response.data.message
        } else {
          this.error = 'Pendaftaran gagal. Pastikan email belum terdaftar.'
        }
      } finally {
        this.loading = false
      }
    },
  },
}
</script>

<style scoped>
.login-wrapper {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  padding: 24px 32px;
}

/* Top Nav Pill */
.top-nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1280px;
  width: 100%;
  margin: 0 auto;
}

.brand-pill {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  padding: 8px 18px;
  border-radius: 9999px;
  font-family: 'Outfit', sans-serif;
  font-weight: 600;
  font-size: 1.05rem;
  color: #18181b;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
}

.brand-icon {
  width: 20px;
  height: 20px;
  color: #18181b;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 16px;
}

.nav-pill {
  background: #18181b;
  color: #ffffff;
  padding: 8px 18px;
  border-radius: 9999px;
  font-size: 0.85rem;
  font-weight: 500;
}

.nav-link {
  font-size: 0.85rem;
  color: #71717a;
  padding: 8px 12px;
}

/* Center Form Card */
.login-center {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 16px;
}

.card-login {
  background: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.07);
  border-radius: 28px;
  width: 100%;
  max-width: 440px;
  padding: 40px 36px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.04);
}

.card-header {
  margin-bottom: 24px;
}

.login-title {
  font-size: 2rem;
  font-weight: 500;
  color: #18181b;
  margin-bottom: 6px;
  letter-spacing: -0.03em;
}

.login-desc {
  font-size: 0.9rem;
  color: #71717a;
  line-height: 1.5;
}

/* Tab Segmented Pill */
.tab-pill-group {
  display: flex;
  background: #f4f4f5;
  padding: 4px;
  border-radius: 9999px;
  margin-bottom: 24px;
}

.tab-pill {
  flex: 1;
  padding: 8px;
  border: none;
  background: transparent;
  color: #71717a;
  font-family: inherit;
  font-size: 0.88rem;
  font-weight: 500;
  border-radius: 9999px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.tab-pill.active {
  background: #ffffff;
  color: #18181b;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
}

/* Form */
.form-body {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.field-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.label-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.field-group label {
  font-size: 0.84rem;
  font-weight: 600;
  color: #27272a;
}

.hint-text {
  font-size: 0.75rem;
  color: #a1a1aa;
}

.field-group input {
  width: 100%;
  padding: 12px 16px;
  background: #fafaf9;
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 14px;
  font-family: inherit;
  font-size: 0.92rem;
  color: #18181b;
  outline: none;
  transition: all 0.2s ease;
}

.field-group input:focus {
  background: #ffffff;
  border-color: #fbbf24;
  box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.18);
}

.field-group input::placeholder {
  color: #a1a1aa;
  font-weight: 400;
}

.alert-error {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #fef2f2;
  border: 1px solid #fecaca;
  color: #b91c1c;
  padding: 10px 14px;
  border-radius: 12px;
  font-size: 0.84rem;
}

.btn-dark-pill {
  width: 100%;
  padding: 14px;
  background: #18181b;
  color: #ffffff;
  border: none;
  border-radius: 9999px;
  font-family: 'Outfit', sans-serif;
  font-size: 0.98rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
  margin-top: 6px;
}

.btn-dark-pill:hover:not(:disabled) {
  background: #27272a;
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(24, 24, 27, 0.15);
}

.btn-dark-pill:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.card-footer-info {
  text-align: center;
  margin-top: 24px;
  font-size: 0.78rem;
  color: #a1a1aa;
}
</style>
