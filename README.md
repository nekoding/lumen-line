## Dev.to Line bot

Repository untuk backend line bot.

## Fitur

- [x] Mengambil list artikel dari dev.to
- [x] Mengambil list podcasts dari dev.to

## List command 

```
articles :page: = Mengambil list artikel (default halaman = 0)
podcasts :page: = Mengambil list podcast (default halaman = 0) 
help            = Menampilkan pesan bantuan
```

## Penggunaan
1. Silahkan tambahkan akun dari bot ini sebagai teman : [@873pbazo](https://lin.ee/bGXyJad) atau bisa juga dengan scan QR code dibawah  
![screenshoot/873pbazo.png](screenshoot/873pbazo.png)

2. Jika sudah silahkan kirimkan pesan sesuai command yang tersedia.   
contoh : 

```
articles 1
```

Maka bot akan mengambil list artikel halaman 1 dari api milik dev.to. Jika halaman tidak diinputkan maka secara otomatis bot akan mengambil dari halaman 0 / pertama.

## Dibuat dengan
- [x] Lumen
- [x] Line PHP SDK

## Screenshoot

- Pesan yang ditampilkan ketika bot pertama kali ditambahkan sebagai teman & tampilan pesan help
![screenshoot/1.png](screenshoot/1.png)

- Tampilan ketika menjalankan perintah articles
![screenshoot/2.png](screenshoot/2.png)

- Tampilan ketika menjalankan perintah podcasts
![screenshoot/3.png](screenshoot/3.png)

- Tampilan ketik perintah yang diinputkan tidak tersedia di dalam list
![screenshoot/4.png](screenshoot/4.png)
