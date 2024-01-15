<?php

namespace App\Livewire;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kodepos;
use App\Models\Provinsi;
use App\Models\Pendaftar;
use Carbon\Carbon;
use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use Illuminate\Support\Str;

class DaftarTN extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    // public Pendaftar $pendaftar;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Hidden::make('tahap')
                    ->default('Mendaftar'),

                Section::make('')
                    ->schema([

                        Placeholder::make('')
                            ->content(new HtmlString('<div class="">
                                         <p>Butuh bantuan?</p>
                                         <p>Silakan mengubungi admin di bawah ini melalui WA:</p>
                                         <p class="text-tsn-header"><a href="https://wa.me/6282210862400">> Link WA Admin Putra <</a></p>
                                         <p class="text-tsn-header"><a href="https://wa.me/628175765767">> Link WA Admin Putri <</a></p>
                                     </div>')),
                    ]),

                Wizard::make([

                    // Step::make('CEK NIK')
                    //     ->schema([

                    //         TextInput::make('ps_qism_view')
                    //             ->label('Qism yang dituju')
                    //             ->default('MTW/TN')
                    //             ->disabled()
                    //             ->required()
                    //             ->dehydrated(),

                    //         Hidden::make('ps_qism')
                    //             ->default('6'),

                    //         TextInput::make('ps_kartu_keluarga')
                    //             ->label('Nomor KK Calon Santri')
                    //             ->hint('Isi sesuai KK')
                    //             ->hintColor('danger')
                    //             ->length(16)
                    //             ->required()
                    //             ->default('3295141306822004'),

                    //         Select::make('ps_kewarganegaraan')
                    //             ->label('Kewarganegaraan')
                    //             ->placeholder('Pilih Kewarganegaraan')
                    //             ->options([
                    //                 'WNI' => 'WNI',
                    //                 'WNA' => 'WNA',
                    //             ])
                    //             ->required()
                    //             ->live(),
                    //         // ->native(false),


                    //         TextInput::make('ps_nik')
                    //             ->label('NIK Calon Santri')
                    //             ->hint('Isi sesuai dengan KK')
                    //             ->hintColor('danger')
                    //             ->length(16)
                    //             ->required()
                    //             ->live()
                    //             ->unique(Pendaftar::class, 'ps_nik')
                    //             ->unique(Santri::class, 'nik')
                    //             // ->exists(modifyRuleUsing: function (Exists $rule, Get $get) {
                    //             //     return $rule->where('tahap', 'Diterima');
                    //             // })
                    //             ->default('3295131306822002')
                    //             ->hidden(fn (Get $get) =>
                    //             $get('ps_kewarganegaraan') == 'WNA' ||
                    //                 $get('ps_kewarganegaraan') == ''),

                    //         Grid::make(2)
                    //             ->schema([

                    //                 TextInput::make('ps_kitas')
                    //                     ->label('KITAS')
                    //                     ->hint('Nomor Izin Tinggal (KITAS)')
                    //                     ->hintColor('danger')
                    //                     ->required()
                    //                     ->unique(Pendaftar::class, 'ps_kitas')
                    //                     ->unique(Santri::class, 'kitas')
                    //                     ->hidden(fn (Get $get) =>
                    //                     $get('ps_kewarganegaraan') == 'WNI' ||
                    //                         $get('ps_kewarganegaraan') == ''),

                    //                 TextInput::make('ps_asal_negara')
                    //                     ->label('Asal Negara')
                    //                     ->required()
                    //                     ->hidden(fn (Get $get) =>
                    //                     $get('ps_kewarganegaraan') == 'WNI' ||
                    //                         $get('ps_kewarganegaraan') == ''),


                    //             ]),

                    //     ]),

                    Step::make('CALON SANTRI')
                        ->schema([

                            //SANTRI
                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                                <p class="text-2xl strong"><strong>DATA CALON SANTRI</strong></p>
                                            </div>')),

                            TextInput::make('ps_nama_lengkap')
                                ->label('Nama Lengkap')
                                ->hint('Isi sesuai dengan KK')
                                ->hintColor('danger')
                                ->required(),

                            TextInput::make('ps_nama_panggilan')
                                ->label('Nama Hijroh')
                                ->required()
                                ->default('ummu'),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                            </div>')),


                            TextInput::make('ps_peng_pend_formal')
                                ->label('Pengalaman Pendidikan Formal')
                                ->required()
                                ->default('f'),

                            TextInput::make('ps_peng_pend_agama')
                                ->label('Pengalaman Pendidikan Agama (mondok)')
                                ->required()
                                ->default('a'),

                            TextInput::make('ps_hafalan')
                                ->label('Hafalan')
                                ->length('2')
                                ->suffix('juz')
                                ->required()
                                ->default('10'),

                            Select::make('ps_mendaftar_keinginan')
                                ->label('Mendaftar atas kenginginan')
                                ->options([
                                    'Orangtua' => 'Orangtua',
                                    'Ananda' => 'Ananda',
                                    'Lainnya' => 'Lainnya',
                                ])
                                ->required()
                                ->live()
                                ->default('Orangtua'),

                            TextInput::make('ps_mendaftar_keinginan_lainnya')
                                ->label('Lainnya')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ps_mendaftar_keinginan') !== 'Lainnya' ||
                                    $get('ps_mendaftar_keinginan') == ''),



                            Hidden::make('ps_aktivitaspend')
                                ->default("Ma'had Aly"),

                            Grid::make(3)
                                ->schema([

                                    Radio::make('ps_jenikelamin')
                                        ->label('Jenis Kelamin')
                                        ->options([
                                            'Laki-laki' => 'Laki-laki',
                                            'Perempuan' => 'Perempuan',
                                        ])
                                        ->required()
                                        ->inline(),

                                    TextInput::make('ps_tempat_lahir')
                                        ->label('Tempat Lahir')
                                        ->hint('Isi sesuai dengan KK')
                                        ->hintColor('danger')
                                        ->required(),


                                    DatePicker::make('ps_tanggal_lahir')
                                        ->label('Tanggal Lahir')
                                        ->hint('Isi sesuai dengan KK')
                                        ->hintColor('danger')
                                        ->required()
                                        ->live(debounce: 600)
                                        ->closeOnDateSelection()
                                        ->afterStateUpdated(function (Set $set, $state) {
                                            $set('ps_umur', Carbon::parse($state)->age);
                                        }),


                                    TextInput::make('ps_umur')
                                        ->disabled(),

                                ]),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                            </div>')),

                            Grid::make(2)
                                ->schema([

                                    TextInput::make('ps_jumlah_saudara')
                                        ->label('Jumlah saudara')
                                        ->required(),

                                    TextInput::make('ps_anak_ke')
                                        ->label('Anak ke-')
                                        ->required()
                                        ->lte('ps_jumlah_saudara'),




                                ]),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                            </div>')),

                            Grid::make(1)
                                ->schema([

                                    TextInput::make('ps_agama')
                                        ->label('Agama')
                                        ->default('Islam')
                                        ->disabled()
                                        ->required(),

                                ]),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                            </div>')),

                            Grid::make(2)
                                ->schema([

                                    Select::make('ps_cita_cita')
                                        ->label('Cita-cita')
                                        ->placeholder('Pilih Cita-cita')
                                        ->options([
                                            'PNS' => 'PNS',
                                            'TNI/Polri' => 'TNI/Polri',
                                            'Guru/Dosen' => 'Guru/Dosen',
                                            'Dokter' => 'Dokter',
                                            'Politikus' => 'Politikus',
                                            'Wiraswasta' => 'Wiraswasta',
                                            'Seniman/Artis' => 'Seniman/Artis',
                                            'Ilmuwan' => 'Ilmuwan',
                                            'Agamawan' => 'Agamawan',
                                            'Lainnya' => 'Lainnya',
                                        ])
                                        ->required()
                                        ->live(),

                                    TextInput::make('ps_cita_cita_lainnya')
                                        ->label('Cita-cita Lainnya')
                                        ->required()
                                        ->hidden(fn (Get $get) =>
                                        $get('ps_cita_cita') !== 'Lainnya'),
                                ]),

                            Grid::make(2)
                                ->schema([
                                    Select::make('ps_hobi')
                                        ->label('Hobi')
                                        ->placeholder('Pilih Hobi')
                                        ->options([
                                            'Olahraga' => 'Olahraga',
                                            'Kesetuan' => 'Kesetuan',
                                            'Membaca' => 'Membaca',
                                            'Menulis' => 'Menulis',
                                            'Jalan-jalan' => 'Jalan-jalan',
                                            'Lainnya' => 'Lainnya',
                                        ])
                                        ->required()
                                        ->live(),

                                    TextInput::make('ps_hobi_lainnya')
                                        ->label('Hobi Lainnya')
                                        ->required()
                                        ->hidden(fn (Get $get) =>
                                        $get('ps_hobi') !== 'Lainnya'),

                                ]),


                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                            </div>')),

                            Grid::make(2)
                                ->schema([
                                    Select::make('ps_keb_khus')
                                        ->label('Kebutuhan Khusus')
                                        ->placeholder('Pilih Kebutuhan Khusus')
                                        ->options([
                                            'Tidak Ada' => 'Tidak Ada',
                                            'Lamban belajar' => 'Lamban belajar',
                                            'Kesulitan belajar spesifik' => 'Kesulitan belajar spesifik',
                                            'Gangguan komunikasi' => 'Gangguan komunikasi',
                                            'Berbakat/memiliki kemampuan dan kecerdasan luar biasa' => 'Berbakat/memiliki kemampuan dan kecerdasan luar biasa',
                                            'Lainnya' => 'Lainnya',
                                        ])
                                        ->required()
                                        ->live(),

                                    TextInput::make('ps_keb_khus_lainnya')
                                        ->label('Kebutuhan Khusus Lainnya')
                                        ->required()
                                        ->hidden(fn (Get $get) =>
                                        $get('ps_keb_khus') !== 'Lainnya'),

                                ]),

                            Grid::make(2)
                                ->schema([
                                    Select::make('ps_keb_dis')
                                        ->label('Kebutuhan Disabilitas')
                                        ->placeholder('Pilih Kebutuhan Disabilitas')
                                        ->options([
                                            'Tidak Ada' => 'Tidak Ada',
                                            'Tuna Netra' => 'Tuna Netra',
                                            'Tuna Rungu' => 'Tuna Rungu',
                                            'Tuna Daksa' => 'Tuna Daksa',
                                            'Tuna Grahita' => 'Tuna Grahita',
                                            'Tuna Laras' => 'Tuna Laras',
                                            'Tuna Wicara' => 'Tuna Wicara',
                                            'Lainnya' => 'Lainnya',
                                        ])
                                        ->required()
                                        ->live(),

                                    TextInput::make('ps_keb_dis_lainnya')
                                        ->label('Kebutuhan Disabilitas Lainnya')
                                        ->required()
                                        ->hidden(fn (Get $get) =>
                                        $get('ps_keb_dis') !== 'Lainnya'),

                                ]),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                            </div>')),

                            Grid::make(1)
                                ->schema([

                                    Toggle::make('ps_tdk_hp')
                                        ->label('Tidak memiliki nomer handphone')
                                        ->live(),

                                    TextInput::make('ps_nomor_handphone')
                                        ->label('No. Handphone')
                                        ->helperText('Contoh: 6282187782223')
                                        ->tel()
                                        ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                        ->required()
                                        ->hidden(fn (Get $get) =>
                                        $get('ps_tdk_hp') == 1),

                                    TextInput::make('ps_email')
                                        ->label('Email')
                                        ->email(),
                                ]),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                            </div>')),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                                                        <p class="text-2xl strong"><strong>TEMPAT TINGGAL DOMISILI</strong></p>
                                                                        <p class="text-2xl strong"><strong>SANTRI</strong></p>
                                                                    </div>')),

                            Select::make('ps_al_s_status_mukim')
                                ->label('Status Mukim')
                                ->placeholder('Pilih Status Mukim')
                                // ->native(false)
                                ->options([
                                    'Mukim' => 'Mukim',
                                    'Tidak Mukim' => 'Tidak Mukim',
                                ])
                                ->required()
                                ->live(debounce: 600),


                            Select::make('ps_al_s_stts_tptgl')
                                ->label('Status Tempat Tinggal')
                                ->placeholder('Pilih Status Tempat Tinggal')
                                ->options([
                                    'Tinggal dengan Ayah Kandung' => 'Tinggal dengan Ayah Kandung',
                                    'Tinggal dengan Ibu Kandung' => 'Tinggal dengan Ibu Kandung',
                                    'Tinggal dengan Wali' => 'Tinggal dengan Wali',
                                    'Ikut Saudara/Kerabat' => 'Ikut Saudara/Kerabat',
                                    'Kontrak/Kost' => 'Kontrak/Kost',
                                    'Tinggal di Asrama Bukan Milik Pesantren' => 'Tinggal di Asrama Bukan Milik Pesantren',
                                    'Panti Asuhan' => 'Panti Asuhan',
                                    'Rumah Singgah' => 'Rumah Singgah',
                                    'Lainnya' => 'Lainnya',
                                ])
                                ->required()
                                ->live()
                                ->hidden(
                                    fn (Get $get) =>
                                    $get('ps_al_s_status_mukim') !== 'Tidak Mukim'
                                ),

                            Grid::make(2)
                                ->schema([

                                    Select::make('ps_al_s_provinsi_id')
                                        ->label('Provinsi')
                                        ->placeholder('Pilih Provinsi')
                                        ->options(Provinsi::all()->pluck('provinsi', 'id'))
                                        ->required()
                                        ->live(debounce: 600)
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        )
                                        ->afterStateUpdated(function (Set $set) {
                                            $set('ps_al_s_kabupaten_id', null);
                                            $set('ps_al_s_kecamatan_id', null);
                                            $set('ps_al_s_kelurahan_id', null);
                                            $set('ps_al_s_kodepos', null);
                                        }),

                                    Select::make('ps_al_s_kabupaten_id')
                                        ->label('Kabupaten')
                                        ->placeholder('Pilih Kabupaten')
                                        ->options(fn (Get $get): Collection => Kabupaten::query()
                                            ->where('provinsi_id', $get('ps_al_s_provinsi_id'))
                                            ->pluck('kabupaten', 'id'))
                                        ->required()
                                        ->live(debounce: 600)
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                    Select::make('ps_al_s_kecamatan_id')
                                        ->label('Kecamatan')
                                        ->placeholder('Pilih Kecamatan')
                                        ->options(fn (Get $get): Collection => Kecamatan::query()
                                            ->where('kabupaten_id', $get('ps_al_s_kabupaten_id'))
                                            ->pluck('kecamatan', 'id'))
                                        ->required()
                                        ->live(debounce: 600)
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                    Select::make('ps_al_s_kelurahan_id')
                                        ->label('Kelurahan')
                                        ->placeholder('Pilih Kelurahan')
                                        ->options(fn (Get $get): Collection => Kelurahan::query()
                                            ->where('kecamatan_id', $get('ps_al_s_kecamatan_id'))
                                            ->pluck('kelurahan', 'id'))
                                        ->required()
                                        ->live(debounce: 600)
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        )
                                        ->afterStateUpdated(function (Get $get, ?string $state, Set $set) {

                                            $kodepos = Kodepos::where('kelurahan_id', $state)->get('kodepos');

                                            $state = $kodepos;

                                            foreach ($state as $states) {
                                                dd($states);
                                                $set('ps_al_s_kodepos', Str::substr($states, 12, 5));
                                            }
                                        }),


                                    TextInput::make('ps_al_s_rt')
                                        ->label('RT')
                                        ->required()
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                    TextInput::make('ps_al_s_rw')
                                        ->label('RW')
                                        ->required()
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                    Textarea::make('ps_al_s_alamat')
                                        ->label('Alamat')
                                        ->required()
                                        ->columnSpanFull()
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                    TextInput::make('ps_al_s_kodepos')
                                        ->label('Kodepos')
                                        ->required()
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                        TextInput::make('ps_al_s_jarak')
                                        ->label('Jarak Tempat Tinggal ke Pondok')
                                        ->required()
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                        TextInput::make('ps_al_s_transportasi')
                                        ->label('Transportasi ke Pondok')
                                        ->required()
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                        TextInput::make('ps_al_s_waktu_tempuh')
                                        ->label('Waktu ke Pondok')
                                        ->required()
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),

                                        Textarea::make('ps_al_s_koordinat')
                                        ->label('Koordinat')
                                        ->required()
                                        ->hidden(
                                            fn (Get $get) =>
                                            $get('ps_al_s_status_mukim') !== 'Tidak Mukim' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                            $get('ps_al_s_stts_tptgl') === 'Tinggal dengan Wali'
                                        ),
                                ]),
                        ]),



                    Step::make('WALISANTRI')
                        ->schema([]),

                    Step::make('KUESIONER KEGIATAN HARIAN')
                        ->schema([]),

                    Step::make('KUESIONER KESEHATAN')
                        ->schema([]),

                    Step::make('KUESIONER KEMAMPUAN PEMBAYARAN ADMINISTRASI')
                        ->schema([]),
                ])
                    ->nextAction(
                        fn (Action $action) => $action->label('Lanjut')
                            ->extraAttributes([
                                "class" => "btn bg-tsn-accent text-black focus:bg-tsn-bg",
                            ]),
                    )
                    ->submitAction(new HtmlString('<button class="submit btn bg-tsn-accent">Submit</button>')),

                // Placeholder::make('')
                //     ->content(new HtmlString('<div>
                //                                     </div>')),


            ])
            ->statePath('data')
            ->model(Pendaftar::class);
    }

    public function create(): void
    {
        Pendaftar::create($this->form->getState());

        // $Pendaftar = Pendaftar::create($this->form->getState());

        // $this->form->model($Pendaftar)->saveRelationships();

        session()->flash('status', 'Alhamdulillah, ananda telah terdaftar sebagai calon santri');

        $this->redirect('/tn');
    }



    public function render(): View
    {
        return view('livewire.formdaftartn');
    }
}
