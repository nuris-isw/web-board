# Web-Board 🏫

**Web-Board** adalah platform CMS Multi-tenant berbasis *Headless* yang dirancang khusus untuk memfasilitasi sekolah dalam mengelola website resmi secara instan, ringan, dan tanpa kerumitan teknis.

## 🎯 Tujuan Proyek
Banyak sekolah memiliki keterbatasan sumber daya untuk mengelola website secara rutin. Web-Board hadir untuk memberikan solusi yang lebih sederhana dibanding WordPress melalui:
* **Pengelolaan Terpusat:** Satu dashboard tunggal yang intuitif bagi operator sekolah.
* **Efisiensi Infrastruktur:** Satu sistem (database & backend) untuk melayani ratusan sekolah sekaligus.
* **Performa Maksimal:** Arsitektur modern (Laravel + Astro) memastikan website sangat cepat dan ramah SEO.

---

## 🚀 Tech Stack
* **Backend & Admin:** Laravel (API & Management Dashboard)
* **Frontend Client:** Astro (Static Site Generation)
* **Database:** MySQL/PostgreSQL (Multi-tenant with single database schema)
* **Styling:** Tailwind CSS

---

## ✨ Fitur Utama

### 🛠 Manajemen Tenant (Sekolah)
* **SaaS Ready:** Satu instalasi aplikasi untuk banyak domain sekolah.
* **First-time Wizard:** Panduan otomatis saat sekolah pertama kali mendaftar/hosting.
* **Role-based Access:** Keamanan login terpisah untuk tiap-tiap admin sekolah.

### 🎨 Desain & Branding Otomatis
* **Smart Layouts:** 3 Pilihan template otomatis berdasarkan jenjang:
    * **Kindergarten** (Playful & Colorful)
    * **Elementary** (Clean & Semi-Formal)
    * **High School** (Elegant & Professional)
* **Dynamic Branding:** Kustomisasi warna (Primary, Secondary, Accent, Background) via sistem **Preset** atau **Custom HEX Color**.

### 📝 Content Management
* **Identitas Sekolah:** Visi-misi, sejarah, dan struktur organisasi.
* **News/Blog:** Manajemen berita kegiatan dan pengumuman sekolah.
* **Gallery:** Dokumentasi foto fasilitas, kegiatan, dan prestasi.
* **Contact & Maps:** Integrasi alamat, kontak resmi, sosial media, dan Google Maps.

---

## 🏗 Arsitektur Sistem
Sistem ini menggunakan pendekatan **Headless CMS**:
1. **Laravel** bertindak sebagai pusat penyimpanan data dan penyedia API.
2. **Astro** mengonsumsi data dari API untuk merender halaman HTML statis.
3. **Deployment:** Sinkronisasi konten otomatis antara admin dashboard dan tampilan publik.

---