<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use DB;

class TambahPesanController extends Controller
{
    //Show makanan
    public function pilih_makanan()
    {

        $menu = Menu::orderBy('id', 'DESC')
            ->where('is_deleted', '0')
            ->where('id_category', '1')
            ->get();
        return view('landingpage.order.order_makanan', compact('menu'));
    }
    public function pilih_minuman()
    {
        $menu = Menu::orderBy('id', 'DESC')
            ->where('is_deleted', '0')
            ->where('id_category', '2')
            ->get();
        return view('landingpage.order.order_minuman', compact('menu'));
    }

    public function detail_transaction()
    {
        return view('landingpage.order.order_detail');
    }
    public function invoice()
    {
        return view('landingpage.order.order_invoice');
    }

    public function save_transaction(Request $request)
    {
        $data = $request->all();
        // ddd($data);
        $latestTransaction = DB::table('transactions')
            ->where('id_table', $data['kodeMeja'])
            ->where('status', 'pending')
            ->latest('created_at')
            ->first();

        if (!$latestTransaction) {
            $transaction = new Transaction;
            $transaction->id_user = $data['kodeMeja']; // Gantilah dengan cara Anda mendapatkan ID pengguna
            $transaction->id_table = $data['kodeMeja'];
            $transaction->notes = ''; // Tambahkan catatan jika diperlukan
            $transaction->total = 0; // Setel total ke default atau hitung dari detail transaksi
            $transaction->subtotal = 0; // Setel subtotal ke default atau hitung dari detail transaksi
            $transaction->tax = 0; // Setel pajak ke default atau hitung dari detail transaksi
            $transaction->status = 'pending'; // Atur status sesuai kebutuhan
            $transaction->is_deleted = false;
            $transaction->save();
            $transactionId = $transaction->id;
        } else {
            $transactionId = $latestTransaction->id;
        }
        // Simpan data ke tabel transactions

        // Simpan detail transaksi ke tabel transaction_details
        foreach ($data['orderList'] as $orderItem) {
            $transactionDetail = new TransactionDetails;
            $transactionDetail->id_transaction = $transactionId;
            $transactionDetail->id_menu = $orderItem['id_menu'];
            $transactionDetail->quantity = $orderItem['quantity'];
            $transactionDetail->total_price = $orderItem['price'] * $orderItem['quantity'];
            $transactionDetail->is_deleted = false;
            $transactionDetail->save();
        }

        return response()->json(['message' => 'Order saved successfully'], 200);
    }
    public function get_transaction($id)
    {
        $transaction = Transaction::where('id_table', $id)
            ->where('status', 'pending')
            ->latest('created_at')
            // ->orderBy('id', 'DESC')
            ->first();

        if ($transaction) {
            $transactionDetails = DB::table('transactions')
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.id_transaction')
                ->join('menus', 'transaction_details.id_menu', 'menus.id')
                ->where('transactions.id', '=', $transaction->id)
                ->select('transaction_details.*', 'menus.name', 'menus.image', 'menus.price')
                ->get();

            $response = [
                'orderList' => $transactionDetails,
                'kodeMeja' => $id,
                'statusCart' => $transaction->status,
            ];

            return response()->json($response);
        } else {
            $response = [
                'orderList' => [],
                'kodeMeja' => $id,
                'error' => 'Transaction not found',
            ];

            return response()->json($response, 200);
        }
    }
    public function order()
    {
        return view('landingpage.order.order_makanan');
    }
}
