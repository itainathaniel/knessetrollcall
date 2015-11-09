<?php

namespace KnessetRollCall;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'verified', 'mail_daily', 'mail_weekly', 'mail_monthly'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin()
    {
        return $this->admin;
    }

    public function updateSettings(Request $request)
    {
        $this->update($request->all());

        $save = false;
        if ($request->input('mail_daily') == null) {
            $this->mail_daily = false;
            $save = true;
        }
        if ($request->input('mail_weekly') == null) {
            $this->mail_weekly = false;
            $save = true;
        }
        if ($request->input('mail_monthly') == null) {
            $this->mail_monthly = false;
            $save = true;
        }

        if (!empty($request->input('password'))) {
            $this->password = Hash::make($request->input('password'));
            $save = true;
        }

        if ($save) {
            $this->save();
        }
    }
}
