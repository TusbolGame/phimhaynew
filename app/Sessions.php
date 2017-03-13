<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model {
	protected $table = 'sessions';
	protected $fillable = ['id', 'last_activity', 'user_id'];
	protected $hidden = ['payload'];
	public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Returns all the guest users.
     *
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTotalGuestAccess()
    {
        // return $query->whereNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(Config::get('custom.activity_limit'))));
        //2p
        return $this->whereNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(2)))->count();
    }

    /**
     * Returns all the registered users.
     *
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTotalUserAccess($query)
    {
        // return $query->whereNotNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(Config::get('custom.activity_limit'))))->with('user');
        return $query->whereNotNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(2)))->count();
    }

    /**
     * Updates the session of the current user.
     *
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function scopeUpdateCurrent($query)
    // {
    //     return $query->where('id', Session::getId())->update([
    //         'user_id' => ! empty(Auth::user()) ? Auth::id() : null
    //     ]);
    // }
}
