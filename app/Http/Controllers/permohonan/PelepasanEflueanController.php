<?php

namespace App\Http\Controllers\permohonan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

use App\Models\Borang;
use App\Models\Permohonan;
use App\Models\PaymentCallback;


class PelepasanEflueanController extends Controller
{
  public function index()
  {
    return view('content.permohonan.permohonan-pelepasan-efluen');
  }

  public function create(Request $request)
  {
    // dd("check");

    // dd($request);

    if ($request->method() === 'POST') {
      Log::info('Trigger this hiho');
    }

    // Rest of your code...
    // return redirect()->route('go-to-permohonan-pelepasan-efluen-borang-individu');

    return view('content.permohonan.permohonan-pelepasan-efluen-borang');
  }

  public function goToPage(Request $request)
  {
    return view('content.permohonan.permohonan-pelepasan-efluen-borang');
  }

  public function store(Request $request)
  {
    //  dd(env('BILLPLZ_API_KEY', "default"));
    $user = Auth::user();

    // You can now access the user's email and name
    $email = $user->email;
    $name = $user->name;
    // dd($user->email);
    $userId = Auth::id();

    $jenis_permohonan = $request->input('jenis-permohonan') ?? '';
    $nama_permohonan = $request->input('nama-permohonan') ?? '';
    $akaun = $request->input('akaun') ?? '1';

    // Borang A
    if ($akaun == 1) {
      $nama_pemohon_borang_a = $request->input('nama-pemohon-borang-a') ?? '';
      $alamat_berdaftar_borang_a = $request->input('alamat-berdaftar-borang-a') ?? '';
      $no_telefon_borang_a = $request->input('no-telefon-borang-a') ?? '';
      $no_faks_borang_a = $request->input('no-faks-borang-a') ?? '';
      $emel_borang_a = $request->input('emel-borang-a') ?? '';
      $nama_perniagaan_utama_borang_a = $request->input('nama-perniagaan-utama-borang-a') ?? '';
      $no_telefon_perniagaan_borang_a = $request->input('no-telefon-perniagaan-borang-a') ?? '';
      $no_faks_perniagaan_borang_a = $request->input('no-faks-perniagaan-borang-a') ?? '';
      $emel_perniagaan_borang_a = $request->input('emel-perniagaan-borang-a') ?? '';
      $jenis_perkhidmatan_borang_a = $request->input('jenis-perkhidmatan-borang-a') ?? '';
      $lokasi_perkhidmatan_borang_a = $request->input('lokasi-perkhidmatan-borang-a') ?? '';
      $cadangan_kawasan_aktiviti_borang_a = $request->input('cadangan-kawasan-aktiviti-borang-a') ?? '';

      $borang_a = [
        'nama_pemohon_borang_a' => $nama_pemohon_borang_a,
        'alamat_berdaftar_borang_a' => $alamat_berdaftar_borang_a,
        'emel_borang_a' => $emel_borang_a,
        'no_telefon_borang_a' => $no_telefon_borang_a,
        'no_faks_borang_a' => $no_faks_borang_a,
        'emel_borang_a' => $emel_borang_a,
        'nama_perniagaan_utama_borang_a' => $nama_perniagaan_utama_borang_a,
        'no_telefon_perniagaan_borang_a' => $no_telefon_perniagaan_borang_a,
        'no_faks_perniagaan_borang_a' => $no_faks_perniagaan_borang_a,
        'emel_perniagaan_borang_a' => $emel_perniagaan_borang_a,
        'jenis_perkhidmatan_borang_a' => $jenis_perkhidmatan_borang_a,
        'lokasi_perkhidmatan_borang_a' => $lokasi_perkhidmatan_borang_a,
        'cadangan_kawasan_aktiviti_borang_a' => $cadangan_kawasan_aktiviti_borang_a,
      ];
    }
    $borang_a = [];
    if ($akaun == 2) {
      $nama_syarikat_borang_a = $request->input('nama-syarikat-borang-a') ?? '';
      $no_syarikat_borang_a = $request->input('no-syarikat-borang-a') ?? '';
      $alamat_berdaftar_borang_a = $request->input('alamat-berdaftar-borang-a') ?? '';
      $no_telefon_borang_a = $request->input('no-telefon-borang-a') ?? '';
      $no_faks_borang_a = $request->input('no-faks-borang-a') ?? '';
      $emel_borang_a = $request->input('emel-borang-a') ?? '';
      $nama_perniagaan_utama_borang_a = $request->input('nama-perniagaan-utama-borang-a') ?? '';
      $no_telefon_perniagaan_borang_a = $request->input('no-telefon-perniagaan-borang-a') ?? '';
      $no_faks_perniagaan_borang_a = $request->input('no-faks-perniagaan-borang-a') ?? '';
      $emel_perniagaan_borang_a = $request->input('emel-perniagaan-borang-a') ?? '';
      $jenis_perkhidmatan_borang_a = $request->input('jenis-perkhidmatan-borang-a') ?? '';
      $lokasi_perkhidmatan_borang_a = $request->input('lokasi-perkhidmatan-borang-a') ?? '';
      $cadangan_kawasan_aktiviti_borang_a = $request->input('cadangan-kawasan-aktiviti-borang-a') ?? '';

      $borang_a = [
        'nama_syarikat_borang_a' => $nama_syarikat_borang_a,
        'no_syarikat_borang_a' => $no_syarikat_borang_a,
        'alamat_berdaftar_borang_a' => $alamat_berdaftar_borang_a,
        'emel_borang_a' => $emel_borang_a,
        'no_telefon_borang_a' => $no_telefon_borang_a,
        'no_faks_borang_a' => $no_faks_borang_a,
        'emel_borang_a' => $emel_borang_a,
        'nama_perniagaan_utama_borang_a' => $nama_perniagaan_utama_borang_a,
        'no_telefon_perniagaan_borang_a' => $no_telefon_perniagaan_borang_a,
        'no_faks_perniagaan_borang_a' => $no_faks_perniagaan_borang_a,
        'emel_perniagaan_borang_a' => $emel_perniagaan_borang_a,
        'jenis_perkhidmatan_borang_a' => $jenis_perkhidmatan_borang_a,
        'lokasi_perkhidmatan_borang_a' => $lokasi_perkhidmatan_borang_a,
        'cadangan_kawasan_aktiviti_borang_a' => $cadangan_kawasan_aktiviti_borang_a,
      ];

    }

    // Borang C
    $nama_pegawai_borang_c = $request->input('nama-pegawai-borang-c') ?? '';
    $no_kad_pengenalan_pegawai_borang_c = $request->input('no_kad_pengenalan-pegawai-borang-c') ?? '';
    $no_telefon_pegawai_borang_c = $request->input('no-telefon-pegawai-borang-c') ?? '';
    $lokasi_borang_c = $request->input('lokasi-borang-c') ?? '';
    $lokasi_titik_borang_c = $request->input('lokasi-titik-borang-c') ?? '';
    $sifat_dan_komposisi_borang_c = $request->input('sifat-dan-komposisi-borang-c') ?? '';
    $kekerapan_borang_c = $request->input('kekerapan-borang-c') ?? '';
    $kadar_alir_pegawai_borang_c = $request->input('kadar-alir-pegawai-borang-c') ?? '';
    $peralatan_borang_c = $request->input('peralatan-borang-c') ?? '';
    $pelan_borang_c = $request->input('pelan-borang-c') ?? '';
    $persampelan_borang_c = $request->input('persampelan-borang-c') ?? '';
    $kaedah_pelupusan_borang_c = $request->input('kaedah-pelupusan-borang-c') ?? '';
    $nama_syarikat_perunding_borang_c = $request->input('nama-syarikat-perunding-borang-c') ?? '';
    $no_syarikat_perunding_persempalan_borang_c = $request->input('no-syarikat-perunding-persempalan-borang-c') ?? '';
    $alamat_syarikat_perunding_persempalan_borang_c = $request->input('alamat-syarikat-perunding-persempalan-borang-c') ?? '';
    $nama_ahli_kimia_borang_c = $request->input('nama-ahli-kimia-borang-c') ?? '';
    $nama_pendaftaran_ahli_kimia_borang_c = $request->input('nama-pendaftaran-ahli-kimia-borang-c') ?? '';
    $alamat_ahli_kimia_borang_c = $request->input('alamat-ahli-kimia-borang-c') ?? '';
    $no_telefon_ahli_kimia_borang_c = $request->input('no-telefon-ahli-kimia-borang-c') ?? '';
    $no_faks_ahli_kimia_borang_c = $request->input('no-faks-ahli-kimia-borang-c') ?? '';
    $email_ahli_kimia_borang_c = $request->input('email-ahli-kimia-borang-c') ?? '';

    $borang_c = [
      'nama_pegawai_borang_c' => $nama_pegawai_borang_c,
      'no_kad_pengenalan_pegawai_borang_c' => $no_kad_pengenalan_pegawai_borang_c,
      'no_telefon_pegawai_borang_c' => $no_telefon_pegawai_borang_c,
      'lokasi_borang_c' => $lokasi_borang_c,
      'lokasi_titik_borang_c' => $lokasi_titik_borang_c,
      'sifat_dan_komposisi_borang_c' => $sifat_dan_komposisi_borang_c,
      'kekerapan_borang_c' => $kekerapan_borang_c,
      'kadar_alir_pegawai_borang_c' => $kadar_alir_pegawai_borang_c,
      'peralatan_borang_c' => $peralatan_borang_c,
      'pelan_borang_c' => $pelan_borang_c,
      'persampelan_borang_c' => $persampelan_borang_c,
      'kaedah_pelupusan_borang_c' => $kaedah_pelupusan_borang_c,
      'nama_syarikat_perunding_borang_c' => $nama_syarikat_perunding_borang_c,
      'no_syarikat_perunding_persempalan_borang_c' => $no_syarikat_perunding_persempalan_borang_c,
      'alamat_syarikat_perunding_persempalan_borang_c' => $alamat_syarikat_perunding_persempalan_borang_c,
      'nama_ahli_kimia_borang_c' => $nama_ahli_kimia_borang_c,
      'nama_pendaftaran_ahli_kimia_borang_c' => $nama_pendaftaran_ahli_kimia_borang_c,
      'alamat_ahli_kimia_borang_c' => $alamat_ahli_kimia_borang_c,
      'no_telefon_ahli_kimia_borang_c' => $no_telefon_ahli_kimia_borang_c,
      'no_faks_ahli_kimia_borang_c' => $no_faks_ahli_kimia_borang_c,
      'email_ahli_kimia_borang_c' => $email_ahli_kimia_borang_c,
    ];

    // Borang D
    $nama_syarikat_borang_d = $request->input('nama-syarikat-borang-d') ?? '';
    $alamat_syarikat_borang_d = $request->input('alamat-syarikat-borang-d') ?? '';
    $no_alamat_syarikat_borang_d = $request->input('no-alamat-syarikat-borang-d') ?? '';
    $no_alamat_pegawai_borang_d = $request->input('no-alamat-pegawai-borang-d') ?? '';
    $no_faks_pegawai_borang_d = $request->input('no-faks-pegawai-borang-d') ?? '';
    $emel_pegawai_borang_d = $request->input('emel-pegawai-borang-d') ?? '';
    $no_kad_pengenal_pegawai_borang_d = $request->input('no-kad-pengenal-pegawai-borang-d') ?? '';
    $tarikh_ujian_kualiti_air_borang_d = $request->input('tarikh-ujian-kualiti-air-borang-d') ?? '';
    $masa_ujian_kualiti_air_borang_d = $request->input('masa-ujian-kualiti-air-borang-d') ?? '';
    $koordinat_borang_d = $request->input('koordinat-borang-d') ?? '';
    $parameter_ujikaji_borang_d = $request->input('parameter-ujikaji-borang-d') ?? '';
    $kaedah_ujikaji_borang_d = $request->input('kaedah-ujikaji-borang-d') ?? '';
    $keputusan_borang_d = $request->input('keputusan-borang-d') ?? '';
    $pengesahan_borang_d = $request->input('pengesahan-borang-d') ?? '';
    $nama_syarikat_persampelan_borang_d = $request->input('nama-syarikat-persampelan-borang-d') ?? '';
    $no_syarikat_persampelan_borang_d = $request->input('no-syarikat-persampelan-borang-d') ?? '';
    $alamat_syarikat_persampelan_borang_d = $request->input('alamat-syarikat-persampelan-borang-d') ?? '';
    $no_tel_syarikat_persampelan_borang_d = $request->input('no-tel-syarikat-persampelan-borang-d') ?? '';
    $no_faks_syarikat_persampelan_borang_d = $request->input('no-faks-syarikat-persampelan-borang-d') ?? '';
    $emel_syarikat_persampelan_borang_d = $request->input('emel-syarikat-persampelan-borang-d') ?? '';

    $borang_d = [
      'nama_syarikat_borang_d' => $nama_syarikat_borang_d,
      'alamat_syarikat_borang_d' => $alamat_syarikat_borang_d,
      'no_alamat_syarikat_borang_d' => $no_alamat_syarikat_borang_d,
      'no_alamat_pegawai_borang_d' => $no_alamat_pegawai_borang_d,
      'no_faks_pegawai_borang_d' => $no_faks_pegawai_borang_d,
      'emel_pegawai_borang_d' => $emel_pegawai_borang_d,
      'no_kad_pengenal_pegawai_borang_d' => $no_kad_pengenal_pegawai_borang_d,
      'tarikh_ujian_kualiti_air_borang_d' => $tarikh_ujian_kualiti_air_borang_d,
      'masa_ujian_kualiti_air_borang_d' => $masa_ujian_kualiti_air_borang_d,
      'koordinat_borang_d' => $koordinat_borang_d,
      'parameter_ujikaji_borang_d' => $parameter_ujikaji_borang_d,
      'kaedah_ujikaji_borang_d' => $kaedah_ujikaji_borang_d,
      'keputusan_borang_d' => $keputusan_borang_d,
      'pengesahan_borang_d' => $pengesahan_borang_d,
      'nama_syarikat_persampelan_borang_d' => $nama_syarikat_persampelan_borang_d,
      'no_syarikat_persampelan_borang_d' => $no_syarikat_persampelan_borang_d,
      'alamat_syarikat_persampelan_borang_d' => $alamat_syarikat_persampelan_borang_d,
      'no_tel_syarikat_persampelan_borang_d' => $no_tel_syarikat_persampelan_borang_d,
      'no_faks_syarikat_persampelan_borang_d' => $no_faks_syarikat_persampelan_borang_d,
      'emel_syarikat_persampelan_borang_d' => $emel_syarikat_persampelan_borang_d,
    ];

    $fileName1 = '';
    // file_upload
    if ($request->hasFile('upload1-pelepasan-efluen')) {
      $file1 = $request->file('upload1-pelepasan-efluen');
      $extension1 = $file1->getClientOriginalExtension();
      $fileName1 = time() . '_' . uniqid() . '.' . $extension1;
      $file1->storeAs('uploads', $fileName1);
    }

    if ($request->hasFile('upload2-pelepasan-efluen')) {
      $file2 = $request->file('upload2-pelepasan-efluen');
      $extension2 = $file2->getClientOriginalExtension();
      $fileName2 = time() . '_' . uniqid() . '.' . $extension2;
      $file2->storeAs('uploads', $fileName2);
    }

    if ($request->hasFile('upload3-pelepasan-efluen')) {
      $file3 = $request->file('upload3-pelepasan-efluen');
      $extension3 = $file3->getClientOriginalExtension();
      $fileName3 = time() . '_' . uniqid() . '.' . $extension3;
      $file3->storeAs('uploads', $fileName3);
    }

    if ($request->hasFile('upload4-pelepasan-efluen')) {
      $file4 = $request->file('upload4-pelepasan-efluen');
      $extension4 = $file4->getClientOriginalExtension();
      $fileName4 = time() . '_' . uniqid() . '.' . $extension4;
      $file4->storeAs('uploads', $fileName4);
    }

    $file_upload = [
      'file1' => $fileName1,
      'file2' => $fileName2,
      'file3' => $fileName3,
      'file4' => $fileName4,
    ];

    $data = new Borang();
    $data1 = new Permohonan();

    $data->borang_a = $borang_a;
    $data->borang_c = $borang_c;
    $data->borang_d = $borang_d;
    $data->file_upload = $file_upload;

    $data->save();

    $borang_id = $data->id;

    $data1->jenis_permohonan = $jenis_permohonan;
    $data1->nama_permohonan = $nama_permohonan;
    $data1->akaun = $akaun;
    $data1->status = 0;
    $data1->borang_id = $borang_id;
    $data1->user_id = $userId;
    $data1->tajuk = "Tajuk";
    $data1->save();
 
    // Call Create Payment
    $client = new Client();

    $response = $client->post(env("BILLPLZ_URL"), [
      'auth' => [env("BILLPLZ_API_KEY"), ''], // API Key
      'form_params' => [
        'collection_id' => env("BILLPLZ_COLLECTION_ID"),
        'description' => 'Perlepasan Efluen',
        'email' => $email,
        'name' => $name,
        'amount' => 200,
        'reference_1' => $permohonan_id = $data->id,
        'redirect_url' => env("APP_URL"),
        'callback_url' => env("APP_API_URL").'/api/payment/callback',
      ]
    ]);
    $permohonan_id = $data1->id;
    $body = $response->getBody();
    $contents = $body->getContents();
    $decoded_data = json_decode($contents, true);
    $paymentcallback = PaymentCallback::create([
      'permohonan_id' => $permohonan_id,
      'bill_id' =>  $decoded_data['id'],
  ]);
    // dd($decoded_data['url']);
    return redirect($decoded_data['url']);
    // return view('content.permohonan.permohonan-pelepasan-efluen');
  }


  

}
