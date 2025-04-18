<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Afficher tous les paiements.
     */
    public function index()
    {
        $payments = Payment::with('reservation')->get();
        return view('payments', compact('payments'));
    }

    /**
     * Afficher le formulaire de création d’un paiement.
     */
    public function create()
    {
        $reservations = Reservation::all(); // pour une liste de réservations valides
        return view('payments.create', compact('reservations'));
    }

    /**
     * Enregistrer un nouveau paiement.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer,cash',
            'payment_date' => 'nullable|date',
            'transaction_id' => 'required|unique:payments,transaction_id',
        ]);

        $payment = Payment::create($request->all());

        return response()->json([
            'message' => 'Paiement enregistré avec succès.',
            'payment' => $payment,
        ]);
    }

    /**
     * Afficher un paiement spécifique.
     */
    public function show($id)
    {
        $payment = Payment::with('reservation')->findOrFail($id);
        return response()->json($payment);
    }

    /**
     * Afficher le formulaire d’édition d’un paiement.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $reservations = Reservation::all();
        return view('payments.edit', compact('payment', 'reservations'));
    }

    /**
     * Mettre à jour un paiement existant.
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer,cash',
            'payment_date' => 'nullable|date',
            'transaction_id' => 'required|unique:payments,transaction_id,' . $payment->id,
        ]);

        $payment->update($request->all());

        return response()->json([
            'message' => 'Paiement mis à jour avec succès.',
            'payment' => $payment,
        ]);
    }

    /**
     * Supprimer un paiement.
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Paiement supprimé avec succès.']);
    }
}
