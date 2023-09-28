## TABLES
- SEKOLAH  
  - ID
  - Nama
  - Alamat
  - Kode Pos
  - No. Telepon
  - Email
- PENGGUNA
  - Username
  - Password
  - Sekolah
 
## PAGES

MANAJEMEN = CRUD OPERATION (CREATE, READ, UPDATE, DELETE)

- HALAMAN REGISTER (**ADMIN**)
- HALAMAN LOGIN (**ADMIN, GURU**)
- HALAMAN MANAJEMEN INFORMASI SEKOLAH (**ADMIN**)
- HALAMAN MANAJEMEN GURU (**ADMIN**)
- HALAMAN MANAJEMEN SISWA (**ADMIN**)
- HALAMAN MANAJEMEN ROLE (**ADMIN**)
- HALAMAN MANAJEMEN PERMISSION (**ADMIN**)
- HALAMAN MANAJEMEN PENGGUNA (**ADMIN**)
- HALAMAN MANAJEMEN JENIS PELANGGARAN (**ADMIN**)
- HALAMAN MANAJEMEN ATTRIBUT PELANGGARAN (**ADMIN**)
- HALAMAN MANAJEMEN SANKSI PELANGGARAN (**ADMIN**)
- HALAMAN MANAJEMEN DATA PELANGGARAN (**ADMIN**)
- HALAMAN MANAJEMEN INFORMASI SEKOLAH (**ADMIN**)
- HALAMAN MANAJEMEN PENGADUAN (**ADMIN**)

## INPUT
- INPUT INFORMASI SEKOLAH (**ADMIN**)
  - Nama Sekolah
  - Kepala Sekolah
  - Operator Sekolah / Admin
  - Akreditasi
  - Alamat Sekolah
  - Link Data Pokok Pendidikan (https://dapo.kemdikbud.go.id/sekolah/E8B5EBF511070E94BA97)




```sql
INSERT INTO informasi_sekolah VALUES (
    'SD NEGERI 167 PEKANBARU',
    'Hasminarni',
    'ELVA NINGSIH',
    'A',
    'Jl. Muhajirin, Sidomulyo Barat, Kec. Tampan, Kota Pekanbaru, Provinsi Riau 28294'
    'https://dapo.kemdikbud.go.id/sekolah/E8B5EBF511070E94BA97'
);
```
