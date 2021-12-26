<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\TransactionSuccess;

// kita panggil 3 modelnya dahulu
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TravelPackage;

// untuk menformat tanggal di Database
use Carbon\Carbon;
use Exception;
use Midtrans\Config;
use Midtrans\Snap;
use Symfony\Component\Mime\Header\Headers;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);

        return view('pages.checkout', [
            'item' => $item
        ]);
    }

    public function process(Request $request, $id)
    {
        $travel_package = TravelPackage::findOrFail($id);

        $transaction = Transaction::create([
            'travel_packages_id' => $id,
            'users_id' => Auth::user()->id, // Untuk mengambil data user yang sedang login
            'additional_visa' => 0,
            'transaction_total' => $travel_package->harga,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'kewarganegaraan' => 'ID',
            'is_visa' => false,
            'doe_passport' => Carbon::now()->addYears(5)
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with(['details', 'travel_package'])
            ->findOrFail($item->transactions_id);

        if ($item->is_visa) {
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }


        $transaction->transaction_total -= $transaction->travel_package->harga;

        $transaction->save();

        // Skrip hapus itemnya disini
        $item->delete();


        // kemudian redirect skrip jangan lupa
        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        // skrip validasi disini
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'is_visa' => 'required|boolean',
            'doe_passport' => 'required'
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['travel_package'])->find($id);

        if ($request->is_visa) {
            $transaction->transaction_total += 190;
            $transaction->additional_visa += 190;
        }


        $transaction->transaction_total += $transaction->travel_package->harga;

        $transaction->save();

        // skrip redirect
        return redirect()->route('checkout', $id);
    }

    // script sukses digabungkan dengan controller checkout karena satu kesatuan
    public function success(Request $request, $id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrFail($id);
        $transaction->transaction_status = 'PENDING';


        $transaction->save();

        // Membuat flow baru, menggunakan set konfigurasi midtrans

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');


        // buat array untuk dikirim ke midtrans

        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'MIDTRANS-' . $transaction->id,
                'gross_amount' => (int) $transaction->transaction_total,
            ],

            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],

            'enabled_payments' => ['gopay'],
            'vtweb' => []
        ];

        try {

            // Ambil halaman payment midtrans

            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            // Redirect ke halaman midtrans nya

            header('Location: ' . $paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // return $transaction;

        // Kirim email ke user untuk e-tiket

        // Mail::to($transaction->user)->send(
        //     new TransactionSuccess($transaction)
        // );


        // return view('pages.success');
    }
}
