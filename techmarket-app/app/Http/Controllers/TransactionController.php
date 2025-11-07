<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function transfer(Request $request)
    {
        $validated = $request->validate([
            'from_account_cpf' => 'required|exists:users,cpf',
            'to_account_cpf'   => 'required|exists:users,cpf|different:from_account_cpf',
            'amount'           => 'required|numeric|min:0.01',
        ]);

        $cpfFrom = preg_replace('/\D/', '', $validated['from_account_cpf']);
        $cpfTo   = preg_replace('/\D/', '', $validated['to_account_cpf']);
        $amount  = $validated['amount'];

        try {
            $fromUser = User::where('cpf', $cpfFrom)->firstOrFail();
            $toUser   = User::where('cpf', $cpfTo)->firstOrFail();

            DB::transaction(function () use ($fromUser, $toUser, $amount, &$transactionCode) {
                if ($fromUser->amount < $amount) {
                    throw new \Exception('Saldo insuficiente para a transferência.');
                }

                if ($fromUser->id === $toUser->id) {
                    throw new \Exception('Não é permitido transferir para a própria conta.');
                }
                
                $fromUser->decrement('amount', $amount);
                $toUser->increment('amount', $amount);

                $transactionCode = (string) Str::uuid();

                Transaction::create([
                    'from_account_id' => $fromUser->id,
                    'to_account_id'   => $toUser->id,
                    'amount'          => $amount,
                    'code'            => $transactionCode,
                ]);
            });

            return response()->json([
                'status'  => true,
                'message' => 'Transferência realizada com sucesso.',
                'data' => [
                    'transaction_code' => $transactionCode,
                    'to_account_cpf'   => $toUser->cpf,
                    'amount'           => $amount,
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

}
