<?php


namespace App\Services;


use App\Models\Transaction;
use App\Models\User;
use App\Models\UserWallet;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TransactionService
{
    /**
     * Модель пользователя, который производит операцию
     * @var UserWallet
     */
    private $senderWalletModel;
    /**
     * @var UserWallet
     */
    private $recipientWalletModel;
    /**
     * @var int
     */
    private $amount;
    /**
     * @var int баланс получателя по итогу
     */
    private $recipientResultBalance;
    /**
     * @var int баланс отправителя по итогу
     */
    private $senderResultBalance;

    /**
     *
     * TransactionService constructor.
     * @param User $userModel
     * @param int $recipientId
     * @param int $amount
     * @throws \Exception
     */
    public function __construct(User $userModel, int $recipientId, int $amount)
    {
        $this->setSenderWalletModel($userModel);
        $this->setRecipientWalletModelById($recipientId);
        $this->amount = $amount;
    }

    /**
     * Устанавливаем кошелек отправителя
     * @param User $model
     * @throws \Exception\
     */
    private function setSenderWalletModel(User $model)
    {
        $wallet = $model->wallet;

        if (! $wallet instanceof UserWallet ) {
            throw new \Exception('Кошелек отправителя убежал.');
        }

        $this->senderWalletModel = $wallet;

    }

    /**
     * Устанавлвиаем кошелек получателя
     * @param $id
     * @throws \Exception
     */
    private function setRecipientWalletModelById($id)
    {
        $user = User::where('id', '=', $id)->first();

        if (! $user instanceof User) {
            throw new \Exception('Пользоваетль успел самоустраниться');
            // ну, такое маловероятно, однако, думаю, вполне возможно
        }

        $wallet = $user->wallet;

        if (! $wallet instanceof UserWallet) {
            throw new \Exception('Кошелек получателя убежал.');
        }

        $this->recipientWalletModel = $wallet;
    }

    /**
     * Выичисляет все значения для кошельков и устанвливает их в соответствующие модели
     */
    private function setBalancesValues():void
    {
        $senderWallet = $this->senderWalletModel;
        $recipientWallet = $this->recipientWalletModel;

        $senderWallet->balance -= $this->amount;
        $isSenderWalletUpdated = $senderWallet->save();

        $recipientWallet->balance += $this->amount;
        $isRecipientWalletUpdated = $recipientWallet->save();

        $this->senderResultBalance = $senderWallet->balance;
        $this->recipientResultBalance = $recipientWallet->balance;
    }

    /**
     * Создает данные
     * @throws \Exception
     */
    private function createTransactionModel()
    {
        $model = Transaction::create(
            [
                'sender_id' => $this->senderWalletModel->user_id,
                'recipient_id' => $this->recipientWalletModel->user_id,
                'sender_result_balance' => $this->senderResultBalance,
                'recipient_result_balance' => $this->recipientResultBalance,
                'amount' => $this->amount,
            ]
        );

        if (! $model instanceof Transaction) {
            throw new \Exception('Не удалось записать данные транзакции');
        }
    }

    /**
     * @return bool
     */
    public function create()
    {
        DB::beginTransaction();

        try {
            $this->setBalancesValues();
            $this->createTransactionModel();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
            DB::rollBack();
        }

        DB::commit();

        return true;
    }





}
