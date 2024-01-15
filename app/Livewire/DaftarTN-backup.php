<?php

namespace App\Livewire;

use App\Models\Pendaftar;
use App\Models\PWalisantri;
use App\Models\Santri;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
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
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\Exists;
use Livewire\Component;

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

                Placeholder::make('')
                    ->content(new HtmlString('<div class="border-b">
                                         <p>Butuh bantuan?</p>
                                         <p>Silakan mengubungi admin di bawah ini melalui WA:</p>
                                         <p class="text-tsn-header"><a href="https://wa.me/6282210862400">> Link WA Admin Putra <</a></p>
                                         <p class="text-tsn-header"><a href="https://wa.me/628175765767">> Link WA Admin Putri <</a></p>
                                     </div>')),

                Wizard::make([

                    Step::make('1. CEK NIK')
                        ->schema([

                            TextInput::make('qism_calon_view')
                                ->label('Qism yang dituju')
                                ->default('MTW/TN')
                                ->disabled()
                                ->required()
                                ->dehydrated(),

                            Hidden::make('qism_calon')
                                ->default('6'),

                            TextInput::make('kk_calon')
                                ->label('Nomor KK Calon Santri')
                                ->hint('Isi sesuai KK')
                                ->hintColor('danger')
                                ->length(16)
                                ->required()
                                ->default('3295141306822004'),

                            TextInput::make('nik_calon')
                                ->label('Nomor NIK Calon Santri')
                                ->hint('Isi sesuai KK')
                                ->hintColor('danger')
                                ->length(16)
                                ->live()
                                ->required()
                                ->unique(Pendaftar::class, 'nik_calon')
                                ->unique(Santri::class, 'nik')
                                // ->exists(modifyRuleUsing: function (Exists $rule, Get $get) {
                                //     return $rule->where('tahap', 'Diterima');
                                // })
                                ->default('3295131306822002'),


                        ]),

                    Step::make('DATA SANTRI')
                        ->schema([

                            TextInput::make('telp_calon')
                                ->label('Nomor WA walisantri')
                                ->tel()
                                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                ->required()
                                ->default('67687'),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b border-t">
                                                    <p class="text-xl strong"><strong>A. CALON SANTRI</strong></p>
                                                </div>')),

                            TextInput::make('nama_calon')
                                ->label('Nama Asli')
                                ->hint('Isi sesuai KK')
                                ->hintColor('danger')
                                ->required()
                                ->default('Aisyah'),

                            TextInput::make('nama_panggilan_calon')
                                ->label('Nama Hijroh')
                                ->required()
                                ->default('ummu'),

                            TextInput::make('tempat_lahir_calon')
                                ->label('Tempat Lahir')
                                ->hint('Isi sesuai KK')
                                ->hintColor('danger')
                                ->required()
                                ->default('kota'),

                            DatePicker::make('tanggal_lahir_calon')
                                ->label('Tanggal Lahir ')
                                ->hint('Isi sesuai KK')
                                ->hintColor('danger')
                                ->required()
                                // ->native(false)
                                ->closeOnDateSelection()
                                ->default('11111111'),

                            TextInput::make('umur_calon')
                                ->label('Umur')
                                ->required()
                                ->default('2'),

                            Textarea::make('al_s_alamat_calon')
                                ->label('Alamat')
                                ->required()
                                ->default('kota'),

                            TextInput::make('peng_pend_formal_calon')
                                ->label('Pengalaman Pendidikan Formal')
                                ->required()
                                ->default('f'),

                            TextInput::make('peng_pend_agama_calon')
                                ->label('Pengalaman Pendidikan Agama (mondok)')
                                ->required()
                                ->default('a'),

                            TextArea::make('peny_fisik_calon')
                                ->label('Riwayat Penyakit Fisik')
                                ->required()
                                ->default('f'),

                            TextArea::make('peny_non_fisik_calon')
                                ->label('Riwayat penyakit non fisik (terkena jin atau penyakit kejiwaan)')
                                ->required()
                                ->default('a'),

                            TextArea::make('akun_medsos_calon')
                                ->label('Akun Medsos yang Pernah Dimiliki')
                                ->required()
                                ->default('a'),

                            Radio::make('akun_medsos_aktif_calon')
                                ->label('Apakah masih aktif hingga kini?')
                                ->options([
                                    'Aktif' => 'Aktif',
                                    'Tidak Aktif' => 'Tidak Aktif',
                                ])
                                ->required()
                                ->inline()
                                ->default('Tidak Aktif'),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>Status Calon Santri</strong></p>
                                                </div>')),

                            Radio::make('status_mampu_calon')
                                ->label('Status calon anak didik')
                                ->options([
                                    'Santriwati mampu (tidak ada permasalahn biaya)' => 'Santriwati mampu (tidak ada permasalahn biaya)',
                                    'Santriwati kurang mampu (ada permasalahan biaya)' => 'Santriwati kurang mampu (ada permasalahan biaya)',
                                ])
                                ->live()
                                ->required()
                                ->inline()
                                ->default('Santriwati kurang mampu (ada permasalahan biaya)'),

                            Textarea::make('rincian_status_mampu_calon')
                                ->label('Dengan merincikan ketidakmampuannya untuk dipertimbangkan')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('status_mampu_calon') !== 'Santriwati kurang mampu (ada permasalahan biaya)' ||
                                    $get('status_mampu_calon') == '')
                                ->default('Santriwati kurang mampu (ada permasalahan biaya)'),

                            Select::make('mendaftar_keinginan_calon')
                                ->label('Mendaftar atas kenginginan')
                                ->options([
                                    'Orangtua' => 'Orangtua',
                                    'Ananda' => 'Ananda',
                                    'Lainnya' => 'Lainnya',
                                ])
                                ->required()
                                ->live()
                                ->default('Orangtua'),

                            TextInput::make('mendaftar_keinginan_lainnya_calon')
                                ->label('Lainnya')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('mendaftar_keinginan_calon') !== 'Lainnya' ||
                                    $get('mendaftar_keinginan_calon') == ''),

                            Hidden::make('tahap')
                                ->default('Mendaftar'),

                            Hidden::make('jeniskelamin_calon')
                                ->default('Perempuan'),
                        ]),

                    Step::make('DATA WALISANTRI')
                        ->schema([

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b border-t">
                                                    <p class="text-xl strong"><strong>B. ORANG TUA</strong></p>
                                                </div>')),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>B.1 Ayah Kandung</strong></p>
                                                </div>')),

                            TextInput::make('ak_nama_lengkap_calon')
                                ->label('Nama Ayah Kandung')
                                ->hint('Isi sesuai KK')
                                ->hintColor('danger')
                                ->required()
                                ->default('Orangtua'),

                            Select::make('ak_status_calon')
                                ->label('Status')
                                ->placeholder('Pilih Status')
                                ->options([
                                    'Masih Hidup' => 'Masih Hidup',
                                    'Sudah Meninggal' => 'Sudah Meninggal',
                                    'Tidak Diketahui' => 'Tidak Diketahui',
                                ])
                                ->required()
                                ->live()
                                ->default('Masih Hidup'),
                            // ->native(false),

                            TextInput::make('ak_nama_kunyah_calon')
                                ->label('Nama Kunyah')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ak_status_calon') == 'Sudah Meninggal' ||
                                    $get('ak_status_calon') == 'Tidak Diketahui' ||
                                    $get('ak_status_calon') == '')
                                ->default('Orangtua'),

                            Select::make('ak_pekerjaan_utama_calon')
                                ->label('Pekerjaan Utama')
                                ->placeholder('Pilih Pekerjaan Utama')
                                ->options([
                                    'Tidak Bekerja' => 'Tidak Bekerja',
                                    'Pensiunan' => 'Pensiunan',
                                    'PNS' => 'PNS',
                                    'TNI/Polisi' => 'TNI/Polisi',
                                    'Guru/Dosen' => 'Guru/Dosen',
                                    'Pegawai Swasta' => 'Pegawai Swasta',
                                    'Wiraswasta' => 'Wiraswasta',
                                    'Pengacara/Jaksa/Hakim/Notaris' => 'Pengacara/Jaksa/Hakim/Notaris',
                                    'Seniman/Pelukis/Artis/Sejenis' => 'Seniman/Pelukis/Artis/Sejenis',
                                    'Dokter/Bidan/Perawat' => 'Dokter/Bidan/Perawat',
                                    'Pilot/Pramugara' => 'Pilot/Pramugara',
                                    'Pedagang' => 'Pedagang',
                                    'Petani/Peternak' => 'Petani/Peternak',
                                    'Nelayan' => 'Nelayan',
                                    'Buruh (Tani/Pabrik/Bangunan)' => 'Buruh (Tani/Pabrik/Bangunan)',
                                    'Sopir/Masinis/Kondektur' => 'Sopir/Masinis/Kondektur',
                                    'Politikus' => 'Politikus',
                                    'Lainnya' => 'Lainnya',
                                ])
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ak_status_calon') == 'Sudah Meninggal' ||
                                    $get('ak_status_calon') == 'Tidak Diketahui' ||
                                    $get('ak_status_calon') == '')
                                ->default('Lainnya'),
                            // ->native(false),

                            Select::make('ak_pghsln_rt_calon')
                                ->label('Penghasilan Rata-Rata')
                                ->placeholder('Pilih Penghasilan Rata-Rata')
                                ->options([
                                    'Kurang dari 500.000' => 'Kurang dari 500.000',
                                    '500.000 - 1.000.000' => '500.000 - 1.000.000',
                                    '1.000.001 - 2.000.000' => '1.000.001 - 2.000.000',
                                    '2.000.001 - 3.000.000' => '2.000.001 - 3.000.000',
                                    '3.000.001 - 5.000.000' => '3.000.001 - 5.000.000',
                                    'Lebih dari 5.000.000' => 'Lebih dari 5.000.000',
                                    'Tidak ada' => 'Tidak ada',
                                ])
                                // ->searchable()
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ak_status_calon') == 'Sudah Meninggal' ||
                                    $get('ak_status_calon') == 'Tidak Diketahui' ||
                                    $get('ak_status_calon') == '')
                                ->default('Lebih dari 5.000.000'),
                            // ->native(false),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>Kajian yang Diikuti Ayah Kandung</strong></p>
                                                </div>'))
                                ->hidden(fn (Get $get) =>
                                $get('ak_status_calon') == 'Sudah Meninggal' ||
                                    $get('ak_status_calon') == 'Tidak Diketahui' ||
                                    $get('ak_status_calon') == ''),

                            Textarea::make('ak_ustadz_kajian_calon')
                                ->label('Ustadz yang mengisi kajian')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ak_status_calon') == 'Sudah Meninggal' ||
                                    $get('ak_status_calon') == 'Tidak Diketahui' ||
                                    $get('ak_status_calon') == '')
                                ->default('Lainnya'),

                            Textarea::make('ak_tempat_kajian_calon')
                                ->label('Tempat kajian yang diikuti')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ak_status_calon') == 'Sudah Meninggal' ||
                                    $get('ak_status_calon') == 'Tidak Diketahui' ||
                                    $get('ak_status_calon') == '')
                                ->default('Lainnya'),

                            Placeholder::make('')
                                ->content(new HtmlString('<div></div>')),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>B.2 Ibu Kandung</strong></p>
                                                </div>')),

                            TextInput::make('ik_nama_lengkap_calon')
                                ->label('Nama Ibu Kandung')
                                ->hint('Isi sesuai KK')
                                ->hintColor('danger')
                                ->required()
                                ->default('Ummu'),

                            Select::make('ik_status_calon')
                                ->label('Status')
                                ->placeholder('Pilih Status')
                                ->options([
                                    'Masih Hidup' => 'Masih Hidup',
                                    'Sudah Meninggal' => 'Sudah Meninggal',
                                    'Tidak Diketahui' => 'Tidak Diketahui',
                                ])
                                ->required()
                                ->live()
                                ->default('Masih Hidup'),
                            // ->native(false),

                            TextInput::make('ik_nama_kunyah_calon')
                                ->label('Nama Kunyah')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ik_status_calon') == 'Sudah Meninggal' ||
                                    $get('ik_status_calon') == 'Tidak Diketahui' ||
                                    $get('ik_status_calon') == '')
                                ->default('Ummu'),

                            Select::make('ik_pekerjaan_utama_calon')
                                ->label('Pekerjaan Utama')
                                ->placeholder('Pilih Pekerjaan Utama')
                                ->options([
                                    'Tidak Bekerja' => 'Tidak Bekerja',
                                    'Pensiunan' => 'Pensiunan',
                                    'PNS' => 'PNS',
                                    'TNI/Polisi' => 'TNI/Polisi',
                                    'Guru/Dosen' => 'Guru/Dosen',
                                    'Pegawai Swasta' => 'Pegawai Swasta',
                                    'Wiraswasta' => 'Wiraswasta',
                                    'Pengacara/Jaksa/Hakim/Notaris' => 'Pengacara/Jaksa/Hakim/Notaris',
                                    'Seniman/Pelukis/Artis/Sejenis' => 'Seniman/Pelukis/Artis/Sejenis',
                                    'Dokter/Bidan/Perawat' => 'Dokter/Bidan/Perawat',
                                    'Pilot/Pramugara' => 'Pilot/Pramugara',
                                    'Pedagang' => 'Pedagang',
                                    'Petani/Peternak' => 'Petani/Peternak',
                                    'Nelayan' => 'Nelayan',
                                    'Buruh (Tani/Pabrik/Bangunan)' => 'Buruh (Tani/Pabrik/Bangunan)',
                                    'Sopir/Masinis/Kondektur' => 'Sopir/Masinis/Kondektur',
                                    'Politikus' => 'Politikus',
                                    'Lainnya' => 'Lainnya',
                                ])
                                // ->searchable()
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ik_status_calon') == 'Sudah Meninggal' ||
                                    $get('ik_status_calon') == 'Tidak Diketahui' ||
                                    $get('ik_status_calon') == '')
                                ->default('Buruh (Tani/Pabrik/Bangunan)'),
                            // ->native(false),

                            Select::make('ik_pghsln_rt_calon')
                                ->label('Penghasilan Rata-Rata')
                                ->placeholder('Pilih Penghasilan Rata-Rata')
                                ->options([
                                    'Kurang dari 500.000' => 'Kurang dari 500.000',
                                    '500.000 - 1.000.000' => '500.000 - 1.000.000',
                                    '1.000.001 - 2.000.000' => '1.000.001 - 2.000.000',
                                    '2.000.001 - 3.000.000' => '2.000.001 - 3.000.000',
                                    '3.000.001 - 5.000.000' => '3.000.001 - 5.000.000',
                                    'Lebih dari 5.000.000' => 'Lebih dari 5.000.000',
                                    'Tidak ada' => 'Tidak ada',
                                ])
                                // ->searchable()
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ik_status_calon') == 'Sudah Meninggal' ||
                                    $get('ik_status_calon') == 'Tidak Diketahui' ||
                                    $get('ik_status_calon') == '')
                                ->default('Tidak ada'),
                            // ->native(false),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>Kajian yang Diikuti Ibu Kandung</strong></p>
                                                </div>'))
                                ->hidden(fn (Get $get) =>
                                $get('ik_status_calon') == 'Sudah Meninggal' ||
                                    $get('ik_status_calon') == 'Tidak Diketahui' ||
                                    $get('ik_status_calon') == ''),

                            Textarea::make('ik_ustadz_kajian_calon')
                                ->label('Ustadz yang mengisi kajian')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ik_status_calon') == 'Sudah Meninggal' ||
                                    $get('ik_status_calon') == 'Tidak Diketahui' ||
                                    $get('ik_status_calon') == '')
                                ->default('Ummu'),

                            Textarea::make('ik_tempat_kajian_calon')
                                ->label('Tempat kajian yang diikuti')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('ik_status_calon') == 'Sudah Meninggal' ||
                                    $get('ik_status_calon') == 'Tidak Diketahui' ||
                                    $get('ik_status_calon') == '')
                                ->default('Ummu'),

                            Placeholder::make('')
                                ->content(new HtmlString('<div>
                                                    </div>')),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b border-t">
                                                    <p class="text-xl strong"><strong>B. WALI (ORANG YANG BERTANGGUNG JAWAB)</strong></p>
                                                </div>')),

                            Select::make('w_status_calon')
                                ->label('Status')
                                ->placeholder('Pilih Status')
                                ->options(function (Get $get) {

                                    if (($get('ak_status_calon') == "Masih Hidup" && $get('ik_status_calon') == "Masih Hidup")) {
                                        return ([
                                            'Sama dengan ayah kandung' => 'Sama dengan ayah kandung',
                                            'Sama dengan ibu kandung' => 'Sama dengan ibu kandung',
                                            'Lainnya' => 'Lainnya'
                                        ]);
                                    } elseif (($get('ak_status_calon') == "Masih Hidup" && $get('ik_status_calon') !== "Masih Hidup")) {
                                        return ([
                                            'Sama dengan ayah kandung' => 'Sama dengan ayah kandung',
                                            'Lainnya' => 'Lainnya'
                                        ]);
                                    } elseif (($get('ak_status_calon') !== "Masih Hidup" && $get('ik_status_calon') == "Masih Hidup")) {
                                        return ([
                                            'Sama dengan ibu kandung' => 'Sama dengan ibu kandung',
                                            'Lainnya' => 'Lainnya'
                                        ]);
                                    } elseif (($get('ak_status_calon') !== "Masih Hidup" && $get('ik_status_calon') !== "Masih Hidup")) {
                                        return ([
                                            'Lainnya' => 'Lainnya'
                                        ]);
                                    }
                                })
                                ->required()
                                ->live()
                                ->default('Sama dengan ayah kandung'),
                            // ->native(false),

                            Select::make('w_hubungan_calon')
                                ->label('Hubungan dengan calon santri')
                                ->options([
                                    'Kakek/Nenek' => 'Kakek/Nenek',
                                    'Paman/Bibi' => 'Paman/Bibi',
                                    'Kakak' => 'Kakak',
                                    'Lainnya' => 'Lainnya',
                                ])
                                // ->searchable()
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('w_status_calon') !== 'Lainnya'),
                            // ->native(false),

                            TextInput::make('w_nama_lengkap_calon')
                                ->label('Nama Wali')
                                ->hint('Isi sesuai KK')
                                ->hintColor('danger')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('w_status_calon') !== 'Lainnya'),

                            TextInput::make('w_nama_kunyah_calon')
                                ->label('Nama Kunyah')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('w_status_calon') !== 'Lainnya'),

                            Select::make('w_pekerjaan_utama_calon')
                                ->label('Pekerjaan Utama')
                                ->placeholder('Pilih Pekerjaan Utama')
                                ->options([
                                    'Tidak Bekerja' => 'Tidak Bekerja',
                                    'Pensiunan' => 'Pensiunan',
                                    'PNS' => 'PNS',
                                    'TNI/Polisi' => 'TNI/Polisi',
                                    'Guru/Dosen' => 'Guru/Dosen',
                                    'Pegawai Swasta' => 'Pegawai Swasta',
                                    'Wiraswasta' => 'Wiraswasta',
                                    'Pengacara/Jaksa/Hakim/Notaris' => 'Pengacara/Jaksa/Hakim/Notaris',
                                    'Seniman/Pelukis/Artis/Sejenis' => 'Seniman/Pelukis/Artis/Sejenis',
                                    'Dokter/Bidan/Perawat' => 'Dokter/Bidan/Perawat',
                                    'Pilot/Pramugara' => 'Pilot/Pramugara',
                                    'Pedagang' => 'Pedagang',
                                    'Petani/Peternak' => 'Petani/Peternak',
                                    'Nelayan' => 'Nelayan',
                                    'Buruh (Tani/Pabrik/Bangunan)' => 'Buruh (Tani/Pabrik/Bangunan)',
                                    'Sopir/Masinis/Kondektur' => 'Sopir/Masinis/Kondektur',
                                    'Politikus' => 'Politikus',
                                    'Lainnya' => 'Lainnya',
                                ])
                                // ->searchable()
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('w_status_calon') !== 'Lainnya'),
                            // ->native(false),

                            Select::make('w_pghsln_rt_calon')
                                ->label('Penghasilan Rata-Rata')
                                ->placeholder('Pilih Penghasilan Rata-Rata')
                                ->options([
                                    'Kurang dari 500.000' => 'Kurang dari 500.000',
                                    '500.000 - 1.000.000' => '500.000 - 1.000.000',
                                    '1.000.001 - 2.000.000' => '1.000.001 - 2.000.000',
                                    '2.000.001 - 3.000.000' => '2.000.001 - 3.000.000',
                                    '3.000.001 - 5.000.000' => '3.000.001 - 5.000.000',
                                    'Lebih dari 5.000.000' => 'Lebih dari 5.000.000',
                                    'Tidak ada' => 'Tidak ada',
                                ])
                                // ->searchable()
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('w_status_calon') !== 'Lainnya'),
                            // ->native(false),

                            Placeholder::make('')
                                ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>Kajian yang Diikuti Wali</strong></p>
                                                </div>'))
                                ->hidden(fn (Get $get) =>
                                $get('w_status_calon') !== 'Lainnya'),

                            Textarea::make('w_ustadz_kajian_calon')
                                ->label('Ustadz yang mengisi kajian')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('w_status_calon') !== 'Lainnya'),

                            Textarea::make('w_tempat_kajian_calon')
                                ->label('Tempat kajian yang diikuti')
                                ->required()
                                ->hidden(fn (Get $get) =>
                                $get('w_status_calon') !== 'Lainnya'),
                        ]),
                ]),

                // Placeholder::make('')
                //     ->content(new HtmlString('<div>
                //                                     </div>')),


            ])
            ->statePath('data')
            ->model(PWalisantri::class);
    }

    public function create(): void
    {
        PWalisantri::create($this->form->getState());

        session()->flash('status', 'Alhamdulillah, ananda telah terdaftar sebagai calon santri');

        $this->redirect('/tn');
    }



    public function render(): View
    {
        return view('livewire.formdaftartn');
    }
}
