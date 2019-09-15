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
        $contact->phone = $request->input("phone");
        $contact->email = $request->input("email");
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

        if (!empty($request->input("phone"))) {
            $has_changed = true;
            $contact->phone = $request->input("phone");
        }

        if (!empty($request->input("email"))) {
            $has_changed = true;
            $contact->email = $request->input("email");
        }

        if ($has_changed) {
            $contact->save();
        }

        return response()->json($contact);
    }

    public function destroy(string $id)
    {
        $deleted = Contact::where('id', $id)->delete();
        if ($deleted) {
            return response()->json('Removed');
        } else {
            return response("No contact with ID " . $id, 404);
        }
    }
}
