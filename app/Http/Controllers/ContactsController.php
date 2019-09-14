<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactsController extends Controller
{

    public function index()
    {
        return response()->json(Contact::all());
    }

    public function findContact(int $id)
    {
        $contact = Contact::find($id);
        if (empty($contact)) {
            return response("No contact with ID " . $id, 404);
        }
        return response()->json($contact);
    }

    public function save(Request $request)
    {
        $contact = new Contact;
        $contact->firstname = $request->input("firstname");
        $contact->lastname = $request->input("lastname");
        $contact->save();
        return response()->json($contact);
    }

    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);
        if (empty($contact)) {
            return response("No contact with ID " . $id, 404);
        }
        $has_changed = false;
        if (!empty($request->input("firstname"))) {
            $has_changed = true;
            $contact->firstname = $request->input("firstname");
        }

        if (!empty($request->input("lastname"))) {
            $has_changed = true;
            $contact->lastname = $request->input("lastname");
        }

        if ($has_changed) {
            $contact->save();
        }

        return response()->json($contact);
    }

    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        if (empty($contact)) {
            return response("No contact with ID " . $id, 404);
        }
        $contact->delete();
        return response("Removed", 200);
    }
}
