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
            'from_account_id' => 'required|exists:users,id',
            'to_account_cpf'   => 'required|exists:users,cpf|different:from_account_id',
            'amount'       => 'required|numeric|min:0.01',
        ]);

        $amount = $validated['amount'];

        try {
            // Executa tudo dentro de uma transação do banco
            DB::transaction(function () use ($validated, $amount, &$transactionCode, &$toAccountId) {

                $fromUser = User::findOrFail($validated['from_account_id']);
                
                $cpf = preg_replace('/[^0-9]/', '', $validated['to_account_cpf']);
                
                // Buscar usuário destino pelo CPF normalizado
                $toUser = User::where('cpf', $cpf)->first();
                
                // Verifica se o usuário tem saldo suficiente
                if ($fromUser->amount < $amount) {
                    throw new \Exception('Saldo insuficiente para a transferência.');
                }

                if (!$toUser) {
                    throw new \Exception('CPF do destinatário não encontrado.');
                }

                if ($fromUser->id === $toUser->id) {
                    throw new \Exception('Não é permitido transferir para a própria conta.');
                }

                // Atualiza saldos
                $fromUser->amount -= $amount;
                $fromUser->save();

                $toUser->amount += $amount;
                $toUser->save();

                // Cria a transação
                $transfer = new Transaction();
                $transfer->from_account_id = $fromUser->id;
                $transfer->to_account_id   = $toUser->id;
                $transfer->amount       = $amount;
                $transactionCode        = $transfer->code = Str::uuid()->toString();
                $toAccountId            = $toUser->id;
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
