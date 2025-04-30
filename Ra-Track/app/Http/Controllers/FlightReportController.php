<?php

namespace App\Http\Controllers;

use App\Models\FlightReport;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FlightReportController extends Controller
{
    /**
     * Affiche la liste des rapports du pilote connecté.
     */
    public function index()
    {
        $reports = FlightReport::whereHas('flight', function ($query) {
            $query->where('pilot_id', Auth::id());
        })->with('flight')->get();

        return view('flight_reports.index', compact('reports'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        $flightsREs = Flight::where('pilot_id', Auth::id())->get();
        return view('flight_reports.create', compact('flightsREs'));
    }

       /**
     * Enregistre un nouveau rapport de vol.
     */
    public function store(Request $request)
    {
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'comment' => 'required|string',
            'reportFile' => 'required|mimes:pdf|max:2048',
        ]);
    
        $path = $request->file('reportFile')->store('reports', 'public');
    
        $report = FlightReport::create([
            'flight_id' => $request->flight_id,
            'comment' => $request->comment,
            'report_path' => $path,
        ]);
    
        $report->load('flight'); // charger les infos de vol pour affichage immédiat
    
        return response()->json([
            'message' => 'Rapport ajouté avec succès',
            'report' => $report,
            'flight_number' => $report->flight->flight_number,
            'date_submitted' => $report->created_at->format('M d, Y'),
        ]);
    }
    
    
/**
     * Affiche un rapport précis.
     */
    public function show($id)
    {
        $report = FlightReport::findOrFail($id);

        // Vérifie que le pilote est bien celui qui a créé le vol
        if ($report->flight->pilot_id !== Auth::id()) {
            abort(403);
        }

        return view('flight_reports.show', compact('report'));
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit($id)
    {
        $report = FlightReport::findOrFail($id);
        if ($report->flight->pilot_id !== Auth::id()) {
            abort(403);
        }

        $flightsREs = Flight::where('pilot_id', Auth::id())->get();
        return view('flight_reports.edit', compact('report', 'flightsREs'));
    }

    /**
     * Met à jour un rapport existant.
     */
    public function update(Request $request, $id)
    {
        $report = FlightReport::findOrFail($id);
        if ($report->flight->pilot_id !== Auth::id()) {
            abort(403);
        }
    
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'comment' => 'required|string',
            'reportFile' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        if ($request->hasFile('reportFile')) {
            Storage::disk('public')->delete($report->report_path);
            $report->report_path = $request->file('reportFile')->store('reports', 'public');
        }
    
        $report->update([
            'flight_id' => $request->flight_id,
            'comment' => $request->comment,
            'report_path' => $report->report_path,
        ]);
    
        $report->load('flight');
    
        return response()->json([
            'message' => 'Rapport mis à jour avec succès.',
            'report' => $report
        ]);
    }
    
      /**
     * Supprime un rapport.
     */
   public function destroy($id)
   {
       $report = FlightReport::findOrFail($id);
       if ($report->flight->pilot_id !== Auth::id()) {
           abort(403);
       }
   
       Storage::disk('public')->delete($report->report_path);
       $report->delete();
   
       return response()->json(['message' => 'Rapport supprimé avec succès.']);
   }

  

    
}
