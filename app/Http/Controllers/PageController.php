<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    private function getDefaultMotor(): array
    {
        return [
            ['id'=>1,'nama'=>'Beat Street','nomor'=>'P 1234 AB','merk'=>'Honda','tahun'=>2022,'harga'=>80000,'status'=>'Tersedia'],
            ['id'=>2,'nama'=>'NMAX','nomor'=>'P 4321 CD','merk'=>'Yamaha','tahun'=>2023,'harga'=>150000,'status'=>'Disewa'],
            ['id'=>3,'nama'=>'Vario 160','nomor'=>'P 5678 EF','merk'=>'Honda','tahun'=>2023,'harga'=>100000,'status'=>'Tersedia'],
            ['id'=>4,'nama'=>'PCX 160','nomor'=>'P 9012 GH','merk'=>'Honda','tahun'=>2024,'harga'=>130000,'status'=>'Tersedia'],
            ['id'=>5,'nama'=>'Aerox','nomor'=>'P 3456 IJ','merk'=>'Yamaha','tahun'=>2022,'harga'=>120000,'status'=>'Disewa'],
            ['id'=>6,'nama'=>'Scoopy','nomor'=>'P 7890 KL','merk'=>'Honda','tahun'=>2021,'harga'=>75000,'status'=>'Tersedia'],
            ['id'=>7,'nama'=>'GSX-S150','nomor'=>'P 2345 MN','merk'=>'Suzuki','tahun'=>2022,'harga'=>110000,'status'=>'Tersedia'],
            ['id'=>8,'nama'=>'Ninja 250','nomor'=>'P 6789 OP','merk'=>'Kawasaki','tahun'=>2023,'harga'=>200000,'status'=>'Disewa'],
        ];
    }

    public function login()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));

        if (empty($username) || empty($password)) {
            return redirect()->route('login')->with('error','Username dan password wajib diisi!');
        }

        return redirect()->route('dashboard',['username'=>$username]);
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username','Admin');

        $motorSession = session('data_motor',[]);
        $semuaMotor = array_merge($this->getDefaultMotor(),$motorSession);

        $statistik = [
            'total_motor'=>count($semuaMotor),
            'motor_tersedia'=>count(array_filter($semuaMotor,fn($m)=>$m['status']==='Tersedia')),
            'motor_disewa'=>count(array_filter($semuaMotor,fn($m)=>$m['status']==='Disewa')),
            'total_customer'=>5,
            'transaksi_hari'=>5,
            'pendapatan_hari'=>'Rp 650.000',
        ];

        $motorPopuler = [
            ['nama'=>'Honda Beat','disewa'=>120,'persen'=>100],
            ['nama'=>'Yamaha NMAX','disewa'=>98,'persen'=>82],
            ['nama'=>'Honda Vario','disewa'=>85,'persen'=>71],
            ['nama'=>'Honda Scoopy','disewa'=>75,'persen'=>63],
        ];

        $aktivitasTerbaru = [
            ['id'=>'TR001','customer'=>'Nafisah','motor'=>'Beat','status'=>'Menunggu Pembayaran'],
            ['id'=>'TR002','customer'=>'Andi','motor'=>'NMAX','status'=>'Disewa'],
            ['id'=>'TR003','customer'=>'Nei','motor'=>'PCX','status'=>'Disewa'],
        ];

        return view('dashboard',compact('username','statistik','motorPopuler','aktivitasTerbaru'));
    }

    public function pengelolaan(Request $request)
    {
        $username = $request->query('username','Admin');

        $motorSession = session('data_motor',[]);
        $dataMotor = array_merge($this->getDefaultMotor(),$motorSession);

        $dataCustomer = [
            ['id'=>'C001','nama'=>'Nafisah','no_hp'=>'08123456789','alamat'=>'Jember'],
            ['id'=>'C002','nama'=>'Andi','no_hp'=>'08122222222','alamat'=>'Banyuwangi'],
            ['id'=>'C003','nama'=>'Siti','no_hp'=>'08134567890','alamat'=>'Bondowoso'],
            ['id'=>'C004','nama'=>'Budi','no_hp'=>'08129876543','alamat'=>'Jember'],
            ['id'=>'C005','nama'=>'Sinta','no_hp'=>'081234112233','alamat'=>'Banyuwangi'],
        ];

        $dataTransaksi = [
            ['id'=>'TR001','customer'=>'Nafisah','motor'=>'Beat','tgl_sewa'=>'10 Mei 2025','tgl_kembali'=>'12 Mei 2025','total'=>'Rp 150.000','status'=>'Menunggu Pembayaran'],
            ['id'=>'TR002','customer'=>'Andi','motor'=>'NMAX','tgl_sewa'=>'05 Mei 2025','tgl_kembali'=>'07 Mei 2025','total'=>'Rp 300.000','status'=>'Disewa'],
            ['id'=>'TR003','customer'=>'Nei','motor'=>'PCX','tgl_sewa'=>'10 Mei 2025','tgl_kembali'=>'11 Mei 2025','total'=>'Rp 120.000','status'=>'Disewa'],
        ];

        return view('pengelolaan',compact('username','dataMotor','dataCustomer','dataTransaksi'));
    }

    public function tambahMotor(Request $request)
    {
        $username = $request->query('username','Admin');

        $motorBaru = [
            'id'=>time(),
            'nama'=>$request->input('nama'),
            'nomor'=>strtoupper($request->input('nomor')),
            'merk'=>$request->input('merk'),
            'tahun'=>(int)$request->input('tahun'),
            'harga'=>(int)$request->input('harga'),
            'status'=>$request->input('status','Tersedia'),
        ];

        $motorSession = session('data_motor',[]);
        $motorSession[] = $motorBaru;
        session(['data_motor'=>$motorSession]);

        return redirect()->route('pengelolaan',['username'=>$username])
            ->with('success','Motor "'.$motorBaru['nama'].'" berhasil ditambahkan!');
    }

    public function profile(Request $request)
    {
        $username = $request->query('username','Admin');

        $profil = [
            'nama'=>$username,
            'role'=>'Administrator',
            'email'=>strtolower(str_replace(' ','',$username)).'@rentalmotor.com',
            'no_hp'=>'08123456789',
            'alamat'=>'Jl. Gajah Mada No.13, Jember',
            'bergabung'=>'Januari 2024',
        ];

        $riwayatAktivitas = [
            ['waktu'=>'10 Mei 2025 - 09:00','aktivitas'=>'Login ke sistem'],
            ['waktu'=>'10 Mei 2025 - 09:15','aktivitas'=>'Menambah data motor NMAX baru'],
            ['waktu'=>'10 Mei 2025 - 10:00','aktivitas'=>'Konfirmasi transaksi TR001'],
            ['waktu'=>'09 Mei 2025 - 14:30','aktivitas'=>'Mengupdate status motor PCX'],
            ['waktu'=>'08 Mei 2025 - 11:00','aktivitas'=>'Menambah data customer baru'],
        ];

        return view('profile',compact('username','profil','riwayatAktivitas'));
    }

    public function logout()
    {
        session()->forget('data_motor');
        return redirect()->route('login')->with('success','Berhasil logout!');
    }
}
