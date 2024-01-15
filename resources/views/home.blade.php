<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'PSB TSN')</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body class="font-raleway antialiased bg-tsn-bg no-scrollbar">

    {{-- header --}}
    <div class="grid lg:grid-cols-3 sm:grid-cols-1 sticky top-0 h-64 z-50 bg-tsn-header border-b-4 border-tsn-accent">
        <div class="flex w-full lg:justify-self-start sm:justify-self-center px-1">
            <a href="http://127.0.0.1:8000/">
                <x-application-logo />
            </a>
        </div>
        <div></div>
        <div class="w-fit justify-self-end px-5 py-5">
            <figure><img src="\LogoTSN.png" alt="Album" class="w-16" /></figure>
        </div>

        <div class="col-span-3">
            <div class="relative justify-self-center">
                <div class=" bottom-0 flex w-full justify-center">
                    <p class="lg:text-5xl sm:text-xl text-white font-raleway"><strong>PENERIMAAN SANTRI
                            BARU</strong></p>
                </div>
                <div class="flex w-full justify-center">
                    <p class="lg:text-5xl sm:text-xl text-white font-raleway"><strong>MA'HAD
                            TA'DZIMUSSUNNAH</strong></p>
                </div>
                <div class="flex w-full justify-center">
                    <p class="lg:text-5xl sm:text-xl text-white font-raleway"><strong>SINE NGAWI</strong></p>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('status'))
    <div class="flex w-full justify-center bg-transparent py-4">
        <!-- The Modal -->
        <div id="myModal" class="modal-show bg-transparet w-full flex justify-center">
            <!-- Modal content -->
            <div
                class="bg-white w-fit p-2 flex flex-col rounded-xl shadow-xl border-2 border-tsn-header justify-center">
                <div class="flex justify-center">
                    <div class="flex">
                        @svg('heroicon-o-check-circle', 'w-10 h-10', ['style'
                        => 'color: #274043'])
                    </div>
                </div>
                <div class="flex">
                    <br>
                    <p class="text-center sm:text-xs lg:text-md">{{ session()->get('status') }}</p>
                    <br>
                </div>
                <div class="flex justify-center">
                    <div class="flex">
                        <button class="modal-btn btn bg-tsn-accent focus:bg-tsn-bg">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="flex w-full pt-8 justify-center flex-col">
        <div>
            <p class="lg:text-3xl sm:text-xl text-tsn-header font-raleway text-center"><strong>WAKTU
                    PENDAFTARAN</strong>
            </p>
        </div>
        {{-- <div>
            <p class="lg:text-3xl sm:text-xl text-tsn-header font-raleway text-center">01 Rajab 1445 H s/d 20 Sya'ban
                1445 H
            </p>
        </div> --}}
        <div>
            <p class="lg:text-3xl sm:text-xl text-tsn-header font-raleway text-center">01 Februari 2024 s/d 01 Maret
                2024
            </p>
        </div>
        <div>
            <p class="lg:text-xl sm:text-sm text-tsn-header font-raleway text-center">KBM dimulai Syawal 1445 H</p>
            <br>
        </div>
        <div class="w-full justify-center flex">
            <div role="alert" class="alert bg-tsn-attention w-fit flex flex-row">
                @svg('heroicon-o-exclamation-triangle', 'w-4 h-4', ['style'
                => 'color: #274043'])
                <span><strong>Kuota terbatas!</strong></span>
            </div>
        </div>
    </div>



    <div class="grid sm:grid-cols-1 lg:grid-cols-2 w-full h-fit justify-items-center p-4">

        {{-- TA --}}
        <div class="px-3 py-3 w-fit justify-center justify-self-center">
            <div class="card lg:card-side bg-base-100 shadow-xl px-4 py-4">
                <figure><img src="logoqism\Tarbiyatul Aulaad.png" alt="Album" class="w-32" /></figure>
                <div class="card-body">
                    <h2 class="card-title self-center text-center text-tsn-header">Pendaftaran</h2>
                    <h2 class="card-title self-center text-center text-tsn-header">Qism Tarbiyatul Aulaad</h2>
                    <h4 class="card-title self-center text-center text-tsn-header text-md">(Setingkat TK)</h4>
                    <p class="self-center">Program untuk pa/pi minimal umur 4,5 tahun</p>
                    <br>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr class="border-tsn-header">
                                <th class="text-tsn-header" colspan="2">Informasi hubungi:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th><a href="https://wa.me/6285233745522">@svg('heroicon-o-phone', 'w-4 h-4', ['style'
                                        => 'color: #274043'])</a></th>
                                <td class="text-tsn-header"><a href="https://wa.me/6285233745522">Ustadz Abu Tsabit
                                        (Putra)</a></td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th><a href="https://wa.me/6282328485257">@svg('heroicon-o-phone', 'w-4 h-4', ['style'
                                        => 'color: #274043'])</a></th>
                                <td class="text-tsn-header"><a href="https://wa.me/6282328485257">Kontak person
                                        putri</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="card-actions justify-start">
                        <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                            onclick="rincian_program_ta.showModal()">Rincian
                            Program</button>
                        <dialog id="rincian_program_ta" class="modal">
                            <div class="modal-box">
                                <div class="sticky top-0 right-0">
                                    <form method="dialog">
                                        <button
                                            class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0 text-3xl">✕</button>
                                    </form>
                                </div>
                                <br>

                                {{-- Tabel Rincian Program TA --}}
                                <div class="bg-tsn-header w-full border-b-4 border-tsn-accent">

                                    <h3 class="font-bold text-lg text-white text-center">Rincian Program Qism Tarbiyatul
                                        Aulaad</h3>

                                    <br>
                                </div>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">TARGET PENDIDIKAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Memahamkan dan membiasakan anak didik untuk mempelajari serta
                                                    mengamalkan ilmu agama sejak kecil</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Menanamkan pada diri anak didik kecintaan dan rasa butuh terhadap
                                                    ilmu agama</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Anak didik mampu membaca Al Qur’an dan aksara latin dengan baik
                                                </td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Anak didik mampu menulis arab dan latin dengan baik</td>
                                            </tr>
                                            <!-- row 5 -->
                                            <tr>
                                                <th>5</th>
                                                <td>Anak didik mampu menerapkan ilmu yang dipelajari dalam kehidupan
                                                    sehari-hari</td>
                                            </tr>
                                            <!-- row 6 -->
                                            <tr>
                                                <th>6</th>
                                                <td>Anak didik memiliki hafalan Al Qur’an ( Juz Amma ) doa sehari-hari
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">MATERI PENDIDIKAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Aqidah</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Akhlak</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Fiqh</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Tarikh/Sejarah Islam</td>
                                            </tr>
                                            <!-- row 5 -->
                                            <tr>
                                                <th>5</th>
                                                <td>Baca tulis arab</td>
                                            </tr>
                                            <!-- row 6 -->
                                            <tr>
                                                <th>6</th>
                                                <td>Baca tulis latin</td>
                                            </tr>
                                            <!-- row 7 -->
                                            <tr>
                                                <th>7</th>
                                                <td>Berhitung</td>
                                            </tr>
                                            <!-- row 8 -->
                                            <tr>
                                                <th>8</th>
                                                <td>Seni</td>
                                            </tr>
                                            <!-- row 8 -->
                                            <tr>
                                                <th></th>
                                                <td>Dll</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">SYARAT PENDAFTARAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Putra/putri berusia minimal 4,5 tahun</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Sehat jasmani dan Rohani</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Fotokopi akte kelahiran</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Fotokopi Kartu Keluarga</td>
                                            </tr>
                                            <!-- row 5 -->
                                            <tr>
                                                <th>5</th>
                                                <td>Mengisi formular pendaftaran</td>
                                            </tr>
                                            <!-- row 6 -->
                                            <tr>
                                                <th>6</th>
                                                <td>Orang tua/wali sanggup mengikuti peraturan yang berlaku</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <br>
                                <div class="flex sticky bottom-0 bg-transparent w-full justify-center rounded-xl">
                                    <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                                        onclick="daftar_ta.showModal()">Daftar</button>
                                    <dialog id="daftar_ta" class="modal">
                                        <div class="modal-box">
                                            <div class="sticky top-0 right-0">
                                                <form method="dialog">
                                                    <button
                                                        class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                                </form>
                                            </div>
                                            <div>
                                                @livewire('daftarta')
                                            </div>
                                        </div>
                                    </dialog>
                                </div>

                        </dialog>
                        <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                            onclick="daftar_ta.showModal()">Daftar</button>
                        <dialog id="daftar_ta" class="modal">
                            <div class="modal-box">
                                <div class="sticky top-0 right-0">
                                    <form method="dialog">
                                        <button
                                            class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                    </form>
                                </div>
                                <div>
                                    @livewire('daftarta')
                                </div>
                            </div>
                        </dialog>
                    </div>
                </div>

            </div>
        </div>

        {{-- PT --}}
        <div class="px-3 py-3 w-fit justify-center justify-self-center">
            <div class="card lg:card-side bg-base-100 shadow-xl px-4 py-4">
                <figure><img src="logoqism\Pra tahfidz.png" alt="Album" class="w-32" /></figure>
                <div class="card-body">
                    <h2 class="card-title self-center text-center text-tsn-header">Pendaftaran</h2>
                    <h2 class="card-title self-center text-center text-tsn-header">Qism Pra Tahfidz</h2>
                    <h4 class="card-title self-center text-center text-tsn-header text-md">(Setingkat SD)</h4>
                    <p class="self-center">Program untuk pa (umur mulai 6 tahun), <br> pi (umur mulai 7 tahun)</p>
                    <br>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr class="border-tsn-header">
                                <th class="text-tsn-header" colspan="2">Informasi hubungi:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th><a href="https://wa.me/6285235636182">@svg('heroicon-o-phone', 'w-4 h-4', ['style'
                                        => 'color: #274043'])</a></th>
                                <td class="text-tsn-header"><a href="https://wa.me/6285235636182">Ustadz Abu Ruwaifi'
                                        (Putra)</a></td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th><a href="https://wa.me/6285234772629">@svg('heroicon-o-phone', 'w-4 h-4', ['style'
                                        => 'color: #274043'])</a></th>
                                <td class="text-tsn-header"><a href="https://wa.me/6285234772629">Kontak person
                                        putri</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="card-actions justify-start">
                        <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                            onclick="rincian_program_pt.showModal()">Rincian
                            Program</button>
                        <dialog id="rincian_program_pt" class="modal">
                            <div class="modal-box">
                                <div class="sticky top-0 right-0">
                                    <form method="dialog">
                                        <button
                                            class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                    </form>
                                </div>
                                <br>
                                <div class="bg-tsn-header w-full border-b-4 border-tsn-accent">

                                    <h3 class="font-bold text-lg text-white text-center">Rincian Program Qism Pra
                                        Tahfidz</h3>

                                    <br>
                                </div>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">TUJUAN PENDIDIKAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Memahamkan dan membiasakan anak didik untuk mempelajari dan
                                                    mengamalkan ilmu agama sejak dini</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Membekali dengan pendidikan dasar yang disesuaikan dengan kebutuhan
                                                    agar anak tidak tertinggal jauh dalam hal akademis dengan anak-anak
                                                    seusianya yang mengeyam pendidikan dasar umum</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Menanamkan kecintaan dan rasa butuh terhadap ilmu
                                                </td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Menanamkan kesadaran untuk belajar</td>
                                            </tr>
                                            <!-- row 5 -->
                                            <tr>
                                                <th>5</th>
                                                <td>Melatih kemandirian belajar di ma’had secara bertahap</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">MATERI PELAJARAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="border-tsn-header">
                                                <th class="text-tsn-header">1</th>
                                                <td class="text-tsn-header"><strong>MATERI POKOK DINIYAH</strong></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Aqidah</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Akhlak dan adab</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Hafalan Qur’an</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Fiqh</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Siroh</td>
                                            </tr>

                                            <tr class="border-tsn-header">
                                                <th class="text-tsn-header">2</th>
                                                <td class="text-tsn-header"><strong>MATERI ALAT</strong></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Qiroah</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Bahasa arab</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Khot</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Jarlis</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Tajwid</td>
                                            </tr>

                                            <tr class="border-tsn-header">
                                                <th class="text-tsn-header">3</th>
                                                <td class="text-tsn-header"><strong>MATERI PENGETAHUAN UMUM
                                                        DASAR</strong></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Matematika</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>IPS</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Bahasa Indonesia</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Kesehatan dasar</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>IPA</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">SISTEM PENDIDIKAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th>1</th>
                                                <td>Membagi anak dalam kelompok kelas berdasarkan kemampuan dasar dan
                                                    umurnya</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th>2</th>
                                                <td>Evaluasi belajar diberikan tiap semester dalam bentuk rapor</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th>3</th>
                                                <td>Adanya program full day bagi anak kelas 1 s.d 4, sehingga diharapkan
                                                    anak istirahat / tidur siang di ma’had, dengan membawa bekal makan
                                                    siang dari rumah</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr>
                                                <th>4</th>
                                                <td>Adanya program menginap terkhusus anak kelas 5 dan 6, yang dibedakan
                                                    sesuai dengan tingkat kesiapan anak pada tiap tingkatan kelasnya
                                                    (detailnya bisa dilihat di rincian program)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <br>

                                <div>
                                    <table class="table">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-lg text-tsn-header" colspan="2">SYARAT PENDAFTARAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <td>Putra/putri usia 6 tahun</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <td>Sehat jasmani dan rohani</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <td>Dapat membaca dan menulis latin dan arab</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <td>Orang tua / wali sanggup mematuhi peraturan yang berlaku di ma’had
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>5</th>
                                                <td>Membawa perlengkapan menginap</td>
                                            </tr>
                                            <tr>
                                                <th>6</th>
                                                <td>Mengisi formulir pendaftaran</td>
                                            </tr>
                                            <tr>
                                                <th>7</th>
                                                <td>Menyertakan foto copy Kartu Keluarga</td>
                                            </tr>
                                            <tr>
                                                <th>8</th>
                                                <td>Bagi santri pindahan diwajibkan membawa surat keterangan baik dari
                                                    ma’had sebelumnya</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <br>

                                <div class="flex sticky bottom-0 bg-transparent w-full justify-center rounded-xl">
                                    <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                                        onclick="daftar_pt.showModal()">Daftar</button>
                                    <dialog id="daftar_pt" class="modal">
                                        <div class="modal-box">
                                            <div class="sticky top-0 right-0">
                                                <form method="dialog">
                                                    <button
                                                        class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                                </form>
                                            </div>
                                            <div>
                                                <p class="text-center">Tahap pendaftaran belum dimulai</p>
                                            </div>
                                        </div>
                                    </dialog>
                                </div>
                            </div>
                        </dialog>
                        <button class="btn bg-tsn-accent focus:bg-tsn-bg"
                            onclick="daftar_pt.showModal()">Daftar</button>
                        <dialog id="daftar_pt" class="modal">
                            <div class="modal-box">
                                <div class="sticky top-0 right-0">
                                    <form method="dialog">
                                        <button
                                            class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
                                    </form>
                                </div>
                                <div>
                                    <p class="text-center">Tahap pendaftaran belum dimulai</p>
                                </div>
                            </div>
                        </dialog>
                    </div>
                </div>

            </div>
        </div>



    </div>

    <div class="flex w-full py-4 justify-center">

        @livewire('statuspendaftaran')

    </div>



    {{--
    <div class="w-auto h-auto p-4 shadow-xl">
        <div class="carousel rounded-xl w-full h-full shadow-xl">
            <div id="slide1" class="carousel-item relative w-full">
                <img src="tsngallery/Selatan menghadap utara.png" class="w-full" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide4" class="btn btn-circle">❮</a>
                    <a href="#slide2" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide2" class="carousel-item relative w-full">
                <img src="https://daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.jpg" class="w-full" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide1" class="btn btn-circle">❮</a>
                    <a href="#slide3" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide3" class="carousel-item relative w-full">
                <img src="https://daisyui.com/images/stock/photo-1414694762283-acccc27bca85.jpg" class="w-full" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide2" class="btn btn-circle">❮</a>
                    <a href="#slide4" class="btn btn-circle">❯</a>
                </div>
            </div>
            <div id="slide4" class="carousel-item relative w-full">
                <img src="https://daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.jpg" class="w-full" />
                <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide3" class="btn btn-circle">❮</a>
                    <a href="#slide1" class="btn btn-circle">❯</a>
                </div>
            </div>
        </div>
    </div> --}}

    <footer class="footer footer-center p-10 bg-tsn-header text-primary-content border-t-4 border-tsn-accent">
        <aside>
            <figure><img src="\LogoTSN.png" alt="Album" class="w-16" /></figure>
            <p class="font-raleway">
                Ma'had Ta'dzimussunnah <br />Sine Ngawi
            </p>
            <p class="font-raleway">Nomor Statistik Pesantren: 510035210133</p>
            <p class="font-raleway">Dusun Krajan RT 02/RW 02 Desa Ketanggung Kec. Sine Kab. Ngawi 63264</p>
            <p class="font-raleway text-center"><a href="https://maps.app.goo.gl/UP1YyR7V6J3tV3bH6">Link Google Maps</a>
            </p>
            <p class="font-raleway text-center"><a
                    href="https://maps.app.goo.gl/UP1YyR7V6J3tV3bH6">@svg('heroicon-o-map-pin', 'w-4 h-4', ['style'
                    => 'color: #d3c281'])</a></p>
        </aside>
    </footer>

    <footer class="footer footer-center bottom-0 bg-tsn-header text-primary-content">
        <p class="text-cente font-raleway">Copyright © 1445 H/2024 M - All right reserved</p>
    </footer>

    @filamentScripts
    @vite('resources/js/app.js')

</body>

</html>
