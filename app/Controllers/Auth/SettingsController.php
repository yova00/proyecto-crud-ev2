<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\UserModel;
use App\Models\SettingsModel;
use App\Models\EmailconfigModel;

class SettingsController extends Controller
{

	/**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

    //--------------------------------------------------------------------

	public function __construct()
	{
		// start session
		$this->session = Services::session();
	}

    //--------------------------------------------------------------------

	/**
	 * Displays settings page.
	 */
	public function settings() 
	{
		$settings = new SettingsModel();

		$system = $settings->where('id', 1)->first();

		return view('auth/settings', [
			'userData' => $this->session->userData, 
			'system' => $system, 
		]);
	}

	public function updateSystem()
	{
		$rules = [
			'id'	=> 'required|is_natural',
			'language'	=> 'required',
			'timezone'	=> 'required',
			'dateformat'	=> 'required',
			'timeformat'	=> 'required',
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$settings = new SettingsModel();

		$system = [
			'id'  	=> $this->request->getPost('id'),
			'language' 	=> $this->request->getPost('language'),
			'timezone' 	=> $this->request->getPost('timezone'),
			'dateformat' 	=> $this->request->getPost('dateformat'),
			'timeformat' 	=> $this->request->getPost('timeformat'),
			'iprestriction' 	=> $this->request->getPost('iprestriction'),
		];

		if (! $settings->save($system)) {
			return redirect()->back()->withInput()->with('errors', $settings->errors());
        }

        return redirect()->back()->with('success', lang('Auth.updateSuccess'));
	}

}
