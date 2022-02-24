<?php

namespace Credpal\CPInvest\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use SoftDeletes;

    public const STATUS_PENDING = 'awaiting payment';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_RUNNING = 'running';
    public const STATUS_LIQUIDATED = 'liquidated';
    public const STATUS_WITHDRAWAL_REQUESTED = 'withdraw requested';
    public const STATUS_WITHDRAWN = 'withdrawn';

    protected $table = 'investments';

    protected $guarded = [];

    protected $casts = [
        'liquidated_at' => 'date',
        'closing_at' => 'date',
        'active_at' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(config('cpinvest.user_class'));
    }

    public static function logInvestmentDetails(array $data): self
    {
        return self::create([
            'invest_investment_id' => $data['id'],
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'amount' => $data['amount'],
            'liquidateable' => $data['liquidateable'],
            'earnings' => $data['earnings'],
            'days' => $data['days'],
            'percentage' => $data['percentage'],
            'closing_at' => $data['closing_at'],
            'liquidated_at' => $data['liquidated_at'],
            'withdrew_at' => $data['withdrew_at'],
            'active_at' => $data['active_at'],
            'withdrawal_requested_at' => $data['withdrawal_requested_at'],
            'status' => $data['status'],
        ]);
    }
}
