<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\Http\Controllers\ApiController;
use App\Models\Transaction;
use App\Models\TransactionReason;
use App\Models\TransactionType;
use App\Models\Wallet;
use App\Services\ConvertCurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends ApiController
{
    public function index()
    {
        return response()->json(Wallet::all());
    }

    public function show(int $walletId)
    {
        $wallet = Wallet::whereId($walletId)->with('currency')->first();
        return response()->json($wallet);
    }

    //TODO REFACTOR THIS
    public function update(Request $request, Wallet $wallet)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
            'currency' => 'required|max:3|exists:currencies,code',
            'transaction_type' => 'required|max:255|exists:transaction_types,code',
            'reason' => 'required|max:255|exists:transaction_reasons,code'
        ]);
        $amount = $request->input('amount');
        $currency = Currency::whereCode($request->input('currency'))->first();
        if ($currency->id !== $wallet->currency_id) {
            $amount = ConvertCurrencyService::convert($currency, $wallet->currency, $amount);
        }
        $wallet->amount += $amount;
        if ($wallet->amount < 0) {
            return response()->json('error', 500);
        }
        DB::transaction(function () use ($request, $wallet, $amount, $currency) {
            $wallet->save();
            Transaction::create([
                'wallet_id' => $wallet->id,
                'type_id' => TransactionType::whereCode($request->input('transaction_type'))->first()->id,
                'reason_id' => TransactionReason::whereCode($request->input('reason'))->first()->id,
                'amount' => $amount,
                'currency_id' => $currency->id,
            ]);
        });
        return response()->json($wallet);
    }

    public function refundSum()
    {
        $query = "
        SELECT coalesce(SUM(amount), 0) AS amount
        FROM transactions
        WHERE reason_id=
            (SELECT id
             FROM transaction_reasons tr
             WHERE tr.code='stock')
          AND created_at > CURRENT_DATE - interval '7 days';
        ";
        $result = DB::select($query)[0];
        return response()->json($result);
    }
}
