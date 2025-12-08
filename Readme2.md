# SIPADU — Sistem Pengaduan Mahasiswa UNILA  
Sistem Informasi Pengaduan Mahasiswa Universitas Lampung

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-8.1-blue?style=flat-square)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15.x-336791?style=flat-square)
![Status](https://img.shields.io/badge/Status-Production-green?style=flat-square)
![License](https://img.shields.io/badge/License-MIT-lightgrey?style=flat-square)

---

## Deskripsi Proyek
**SIPADU (Sistem Pengaduan Mahasiswa)** adalah aplikasi berbasis web yang dirancang untuk menjadi sarana pelaporan mahasiswa terhadap kendala atau aspirasi terkait layanan kampus Universitas Lampung.  
Sistem ini menerapkan manajemen laporan berbasis *ticketing system* sehingga setiap aduan dapat ditangani secara cepat, terstruktur, dan transparan.

Aplikasi ini dilengkapi dengan:
- Sistem autentikasi multi-role (Mahasiswa, Admin, PIC Unit)
- Verifikasi OTP melalui email
- Penanganan aduan oleh unit terkait (PIC)
- Tracking status aduan secara real-time
- Upload data (KTM, bukti aduan) melalui Cloudinary
- Validasi admin sebelum penugasan
- Riwayat tindak lanjut aduan

---

## Tim Pengembang

| Nama | NPM | Peran |
|------|------|-------|
| Oryza Surya Hapsari | 2317051107 | Backend Developer |
| Lutfi Harya Ferdian | 2317051096 | Fullstack Developer |
| Indriazan Alkautsar | 2357051074 | UI/UX & Frontend Developer |
| Afgan Candra Putra Nuraya | 2317051068 | Backend Developer |

### Dosen Pengampu
- M. Iqbal Parabi, S.Si., M.T.  
- Muhammad Ikhsan, S.Kom., M.Cs.

---

## Tujuan Pengembangan
1. Menyediakan sarana pengaduan mahasiswa yang lebih modern, transparan, dan terstruktur.  
2. Mempercepat proses penanganan aduan oleh fakultas atau unit terkait.  
3. Menghindari duplikasi pengaduan pada masalah yang sama.  
4. Membangun sistem berbasis *ticketing* yang dapat di-tracking oleh mahasiswa.  
5. Meningkatkan kualitas layanan dan responsivitas pihak kampus.

---

## Fitur Utama

### **1. Autentikasi & Keamanan**
- Login multi-role (Mahasiswa, Admin, PIC)
- Verifikasi email menggunakan OTP
- Password hashing (bcrypt)
- Middleware berbasis peran
- CSRF protection Laravel

### **2. Ticketing System**
- Nomor tiket unik otomatis
- Riwayat tindak lanjut setiap aduan
- Tracking status real-time

### **3. Upload Berkas**
- Upload KTM & bukti aduan via Cloudinary
- Validasi client-side & server-side

### **4. Manajemen Role**
- **Mahasiswa:** membuat & memantau aduan  
- **Admin:** validasi & penugasan  
- **PIC:** menyelesaikan aduan

### **5. Manajemen Proses Aduan**
Status workflow:
- Menunggu → Diverifikasi Admin → Diproses oleh PIC → Penyelesaian → Selesai / Ditolak


---

## Alur Sistem (Business Flow)

### **1. Registrasi Mahasiswa**
- Mahasiswa registrasi → sistem mengirim OTP → user verifikasi email.

### **2. Pengajuan Aduan**
- Mahasiswa mengisi form + upload bukti → sistem membuat nomor tiket → masuk ke dashboard admin.

### **3. Validasi Admin**
Admin dapat:
- Menerima aduan → menugaskan ke PIC terkait  
- Menolak aduan jika tidak valid  

### **4. Penanganan oleh PIC**
- PIC melihat daftar tugas  
- Memberikan progres / catatan  
- Menyelesaikan aduan  

### **5. Tracking Mahasiswa**
- Mahasiswa dapat melihat:
  - Status aduan
  - Catatan penyelesaian
  - Waktu update terakhir

---


## Teknologi yang Digunakan

### **Backend**
- Laravel 10  
- PHP 8.1  
- PostgreSQL  
- Cloudinary API  
- Laravel Mail SMTP  

### **Frontend**
- Blade Template  
- Bootstrap 5  
- JavaScript Vanilla  

### **Pendukung**
- Eloquent ORM  
- Laravel Middleware  
- Skema MVC  

---

## Instalasi & Konfigurasi

### **1. Clone Repository**
```bash
git clone https://github.com/LutfiHaryaFerdian/SIPADU
cd SIPADU
