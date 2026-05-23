izin go green
# 📋 SPK Prioritas Tugas

Sistem Pendukung Keputusan (SPK) berbasis web untuk membantu pengguna menentukan **urutan prioritas tugas** secara otomatis menggunakan metode **Simple Additive Weighting (SAW)**.

---

## 🧠 Tentang Proyek

Seringkali kita dihadapkan pada banyak tugas sekaligus dan bingung mana yang harus dikerjakan terlebih dahulu. Aplikasi ini menyelesaikan masalah tersebut dengan menghitung skor prioritas setiap tugas berdasarkan 5 kriteria objektif, lalu menampilkan daftar tugas yang sudah diurutkan dari prioritas tertinggi ke terendah.

---

## ✨ Fitur

- 🔐 **Autentikasi pengguna** — register, login, dan logout
- ➕ **Manajemen tugas** — tambah, edit, dan hapus tugas
- 📊 **Perangkingan otomatis** — menggunakan metode SAW
- 🥇 **Visualisasi ranking** — ikon medali untuk 3 tugas teratas
- 📈 **Progress bar** — pantau kemajuan tiap tugas
- 📱 **Responsif** — tampilan menyesuaikan layar desktop maupun mobile

---

## ⚙️ Metode SAW (Simple Additive Weighting)

Setiap tugas dievaluasi berdasarkan 5 kriteria berikut:

| Kode | Kriteria             | Tipe    | Bobot |
|------|----------------------|---------|-------|
| C1   | Deadline             | Cost    | 35%   |
| C2   | Tingkat Kepentingan  | Benefit | 25%   |
| C3   | Tingkat Kesulitan    | Benefit | 20%   |
| C4   | Estimasi Waktu       | Benefit | 10%   |
| C5   | Progress Pengerjaan  | Benefit | 10%   |

**Langkah perhitungan:**
1. Konversi nilai mentah tiap kriteria ke skala 1–5
2. Normalisasi matriks (min/nilai untuk Cost, nilai/max untuk Benefit)
3. Hitung nilai preferensi: **Vi = Σ (bobot × normalisasi)**
4. Urutkan tugas berdasarkan nilai Vi tertinggi

---

## 🛠️ Teknologi

- **Backend:** PHP 8+ (native, tanpa framework)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript (vanilla)
- **Koneksi DB:** PDO (PHP Data Objects)

---

## 📁 Struktur Proyek

```
PrioritasTugas_SPK/
├── index.php                  # Dashboard utama & tampilan ranking
├── koneksi.php                # Konfigurasi koneksi database & BASE_URL
│
├── auth/
│   ├── login.php              # Halaman login
│   ├── register.php           # Halaman registrasi
│   ├── proses_login.php       # Logika autentikasi login
│   ├── proses_register.php    # Logika registrasi pengguna
│   └── logout.php             # Proses logout & hapus sesi
│
├── tugas/
│   ├── tambah.php             # Form tambah tugas baru
│   ├── edit.php               # Form edit tugas
│   ├── hapus.php              # Proses hapus tugas
│   ├── proses_tambah.php      # Logika simpan tugas baru
│   └── proses_edit.php        # Logika update tugas
│
├── includes/
│   ├── saw.php                # Logika perhitungan metode SAW
│   └── session.php            # Proteksi halaman (cek sesi login)
│
├── css/
│   └── style.css              # Stylesheet utama
│
└── js/
    └── main.js                # Script JavaScript pendukung
```

---

## 🚀 Cara Instalasi

### Prasyarat
- PHP >= 8.0
- MySQL / MariaDB
- Web server lokal: [XAMPP](https://www.apachefriends.org/) / [Laragon](https://laragon.org/) / WAMP

### Langkah-langkah

**1. Clone atau unduh proyek ini**
```bash
git clone https://github.com/qiarhadempta/Sistem-Prioritas-Tugas-.git
```

**2. Pindahkan folder ke direktori web server**
```
# Untuk XAMPP:
C:/xampp/htdocs/PrioritasTugas_SPK

# Untuk Laragon:
C:/laragon/www/PrioritasTugas_SPK
```

**3. Buat database MySQL**

Buka phpMyAdmin atau terminal MySQL, lalu jalankan:

```sql
CREATE DATABASE spk_prioritas_tugas CHARACTER SET utf8 COLLATE utf8_general_ci;

USE spk_prioritas_tugas;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tugas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nama_tugas VARCHAR(200) NOT NULL,
    deadline DATETIME NOT NULL,
    kepentingan TINYINT NOT NULL CHECK (kepentingan BETWEEN 1 AND 5),
    kesulitan TINYINT NOT NULL CHECK (kesulitan BETWEEN 1 AND 5),
    estimasi FLOAT NOT NULL,
    progress TINYINT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

**4. Sesuaikan konfigurasi di `koneksi.php`**

```php
$host     = 'localhost';
$dbname   = 'spk_prioritas_tugas';
$username = 'root';
$password = '';  // Ganti jika ada password

define('BASE_URL', '/PrioritasTugas_SPK');  // Sesuaikan nama folder
```

**5. Akses aplikasi di browser**
```
http://localhost/PrioritasTugas_SPK/auth/login.php
```

---

## 📖 Cara Penggunaan

1. **Daftar akun** baru melalui halaman Register
2. **Login** dengan email dan password yang sudah didaftarkan
3. Klik **"+ Tambah Tugas"** untuk memasukkan tugas baru
4. Isi form: nama tugas, deadline, tingkat kepentingan, kesulitan, estimasi waktu, dan progress saat ini
5. Sistem otomatis **menghitung dan menampilkan ranking** tugas berdasarkan metode SAW
6. Gunakan tombol **Edit** untuk memperbarui progress atau data tugas
7. Tugas dengan nilai **Vi tertinggi** adalah yang paling perlu dikerjakan terlebih dahulu

---

## 📸 Tampilan Aplikasi

<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/522e382d-bfea-40e4-bca3-c345e5d30ae3" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/6141938a-e430-434c-a381-b9fadfb54917" />
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/0fc53812-1fd4-4cfb-8c90-1e69b8879d94" />


---

## 🤝 Kontribusi

Kontribusi sangat terbuka! Silakan:

1. Fork repositori ini
2. Buat branch fitur baru (`git checkout -b fitur/nama-fitur`)
3. Commit perubahan (`git commit -m 'Tambah fitur: ...'`)
4. Push ke branch (`git push origin fitur/nama-fitur`)
5. Buat Pull Request

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik. Bebas digunakan dan dikembangkan dengan tetap mencantumkan atribusi kepada pembuat asli.

---

## 👤 Pembuat

**qiarhadempta**  
GitHub: [@qiarhadempta](https://github.com/qiarhadempta)

fomo mau go green jg
