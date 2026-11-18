XXI BIOSKOP - Aplikasi Pemesanan Tiket
=======================================

CARA INSTALASI
1. Taruh folder "bioskop" di htdocs (XAMPP) / www (Laragon).
2. Buka phpMyAdmin > tab Import > pilih file database/db_bioskop.sql > Go.
   (database "db_bioskop" otomatis dibuat beserta datanya)
3. Cek model/m_koneksi.php, sesuaikan host / username / password MySQL kamu.
   (XAMPP default: user "root", password kosong)
4. Buka http://localhost/bioskop/

AKUN CONTOH
admin
username : admin
password : admin123

user
username : eka
password : user123

user
username : rahmat
password : user123

(login bisa pakai username atau email)

POSTER FILM
Taruh gambar poster di folder assets/img/ dengan nama sesuai kolom "poster"
di tabel film (avengers.jpg, joker.jpg, interstellar.jpg, batman.jpg,
spiderman.jpg, johnwick4.jpg, inception.jpg, fastx.jpg).
Poster bawaan hanyalah gambar placeholder buatan sendiri; ganti dengan poster asli kalau perlu (pakai nama file yang sama).

STRUKTUR FOLDER
assets/       gambar poster (img) & foto profil upload (uploads)
controller/   c_auth, c_login, c_user, c_pemesanan
database/     db_bioskop.sql
model/        m_koneksi, m_users, m_film, m_pemesanan
view/         semua halaman tampilan
index.php     pintu masuk (arahkan sesuai login/role)
