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
        // Validação dos dados de entrada
        $validated = $request->validate([
            'from_user_id' => 'required|exists:users,id',
            'to_user_id'   => 'required|exists:users,id|different:from_user_id',
            'amount'       => 'required|numeric|min:0.01',
        ]);

        $amount = $validated['amount'];

        try {
            // Executa tudo dentro de uma transação do banco
            DB::transaction(function () use ($validated, $amount, &$transactionCode, &$toAccountId) {

                $fromUser = User::findOrFail($validated['from_user_id']);
                $toUser   = User::findOrFail($validated['to_user_id']);

                // Verifica se o usuário tem saldo suficiente
                if ($fromUser->amount < $amount) {
                    throw new \Exception('Saldo insuficiente para a transferência.');
                }

                // Atualiza saldos
                $fromUser->amount -= $amount;
                $fromUser->save();

                $toUser->amount += $amount;
                $toUser->save();

                // Cria a transação
                $transfer = new Transaction();
                $transfer->from_user_id = $fromUser->id;
                $transfer->to_user_id   = $toUser->id;
                $transfer->amount       = $amount;
                $transactionCode        = $transfer->code = Str::uuid()->toString();
                $toAccountId            = $toUser->id;
                $transfer->status       = 'success';
                $transfer->save();
            });

            // Retorna sucesso
            return response()->json([
                'status'  => true,
                'message' => 'Transfer successful',
                'data' => [
                    'transaction_code' => $transactionCode,
                    'to_account_id'    => $toAccountId,
                    'amount'           => $amount,
                    'code'             => $transactionCode,
                ],
            ], 200);

        } catch (\Exception $e) {
            // Retorna erro se algo falhar
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
