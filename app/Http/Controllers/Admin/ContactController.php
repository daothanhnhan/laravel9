<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index () 
    {
    	$data = [
            'contacts' => Contact::paginate(20),
        ];
        $data['menu_active'] = Together::check_url_menu();

        return view('admin.contact.list', $data);
    }

    public function destroy (Contact $contact) 
    {
    	$contact->delete();
        return redirect('admin/contacts');
    }
}
