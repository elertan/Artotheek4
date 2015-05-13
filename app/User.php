<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

abstract class UserPrivelege {
	const User = 0;
	const Student = 1;
	const Moderator = 2;
	const Administrator = 3;
}

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

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
	protected $fillable = ['name', 'email', 'password', 'priveleges'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function privelegeString() {
		switch ($this->priveleges) {
			case 0:
				return 'Gebruiker';
			case 1:
				return 'Student';
			case 2:
				return 'Beheerder';
			case 3:
				return 'Administrator';
			default:
				throw new Exception('No such privelege');
				break;
		}
	}

	public function isUser() {
		return $this->priveleges >= UserPrivelege::User;
	}

	public function isStudent() {
		return $this->priveleges >= UserPrivelege::Student;
	}

	public function isModerator() {
		return $this->priveleges >= UserPrivelege::Moderator;
	}

	public function isAdministrator() {
		return $this->priveleges >= UserPrivelege::Administrator;
	}

}
