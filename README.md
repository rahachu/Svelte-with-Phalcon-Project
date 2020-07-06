# Pateron Application Rebuild
Repository ini merupakan backend yang akan digunakan
untuk membangun ulang aplikasi Pateron.

Dibangun menggunakan phalcon framework

# Instalasi

```
git clone git@github.com:rahachu/App.git
composer install
php -S localhost:8000 .htrouter.php
```
jika kamu memiliki phalcon devtools maka kamu hanya
perlu mengetikan
```
phalcon serve
```

# Aturan pengembangan
Pastikan kamu membuat branch baru dari branch developing
agar memudahkan dalam tracking bila suatu bug terjadi
lalu beri nama branch yang bermakna sesuah dengan yang kamu kerjakan
misalnya:
tryout_submit
jangan gunakan nama yang membuat orang lain bingung
misalnya:
kerjaan_wahyu

# Daftar API

## GET 'domain/' dan 'domain/{terserah}'
mengembalikan halaman pada frontend react
dan selanjutnya diserahkan kepada react router dom

## GET 'domain/auth'
output : 
{
    id
    username
    siswa (jika siswa)
    mentor (jika mentor)
    login (true jika loged in)
}

## GET 'domain/logout'
menghapus info user pada session

## POST 'domain/login'
input :
```
pastikan dalam object formdata()
{
    login
    password
    csrfKey : csrfToken
}
```

## POST 'domain/register'
input :
```
pastikan dalam object formdata()
{
    fullname
    school
    city
    phone
    username
    email
    password
}
```

## GET 'domain/confirm/{code}/{username}'
untuk mengonfirmasi email sehingga akun dapat
diaktifkan