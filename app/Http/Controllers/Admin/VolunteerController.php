<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the volunteers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Volunteer::query();

        // Filtrer par statut
        if ($request->has('status') && $request->status != '') {
            $query->where('is_read', $request->status == 'read');
        }

        // Filtrer par date
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        // Recherche
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $volunteers = $query->paginate(10);

        return response(view('admin.volunteers.index', compact('volunteers')));
    }

    /**
     * Display the specified volunteer.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show(Volunteer $volunteer)
    {
        return response(view('admin.volunteers.show', compact('volunteer')));
    }

    /**
     * Remove the specified volunteer from storage.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();

        return response(
            redirect()->route('admin.volunteers.index')->with('success', 'Volontaire supprimé avec succès.')
        );
    }

    /**
     * Mark the specified volunteer as read.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Volunteer $volunteer)
    {
        $volunteer->update(['is_read' => true]);

        return response(
            redirect()->route('admin.volunteers.index')->with('success', 'Volontaire marqué comme lu.')
        );
    }

    /**
     * Perform bulk actions on volunteers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $volunteerIds = $request->input('volunteer_ids', []);

        if (empty($volunteerIds)) {
            return response(redirect()->back()->with('error', 'Aucun volontaire sélectionné.'));
        }

        switch ($action) {
            case 'mark-read':
                Volunteer::whereIn('id', $volunteerIds)->update(['is_read' => true]);
                $message = 'Volontaires marqués comme lus.';
                break;
            case 'delete':
                Volunteer::whereIn('id', $volunteerIds)->delete();
                $message = 'Volontaires supprimés avec succès.';
                break;
            default:
                return response(redirect()->back()->with('error', 'Action non valide.'));
        }

        return response(redirect()->route('admin.volunteers.index')->with('success', $message));
    }
}
