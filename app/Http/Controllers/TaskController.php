<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Pas besoin de middleware 'auth:sanctum' ici, on utilise l'auth par défaut de Laravel
    public function __construct()
    {
        $this->middleware('auth'); // Utilise 'auth' pour vérifier si l'utilisateur est connecté
    }

    // Retourne toutes les tâches de l'utilisateur connecté
    public function index()
    {
        return response()->json(Auth::user()->tasks);
    }

    // Crée une nouvelle tâche
    public function store(Request $request)
    {
        // Validation des données de la tâche
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Création de la tâche, liée à l'utilisateur authentifié
        $task = Auth::user()->tasks()->create($request->only('title', 'description', 'due_date', 'status'));

        // Retourne la tâche créée en réponse
        return response()->json($task, 201);
    }

    // Affiche une tâche spécifique
    public function show(Task $task)
    {
        return response()->json($task);
    }

    // Met à jour une tâche
    public function update(Request $request, Task $task)
    {
        // Vérifie que l'utilisateur est autorisé à mettre à jour cette tâche
        $this->authorize('update', $task);

        // Met à jour la tâche avec les données du request
        $task->update($request->only('title', 'description', 'due_date', 'status'));

        // Retourne la tâche mise à jour
        return response()->json($task);
    }

    // Supprime une tâche
    public function destroy(Task $task)
    {
        // Vérifie que l'utilisateur est autorisé à supprimer cette tâche
        $this->authorize('delete', $task);

        // Supprime la tâche
        $task->delete();

        // Retourne un message de confirmation de suppression
        return response()->json(['message' => 'Task deleted']);
    }

    // Filtre les tâches selon leur statut
    public function filterByStatus($status)
    {
        return response()->json(Auth::user()->tasks()->where('status', $status)->get());
    }

    // Recherche les tâches par leur titre
    public function searchByTitle($title)
    {
        return response()->json(Auth::user()->tasks()->where('title', 'like', "%$title%")->get());
    }

    // Retourne des statistiques sur les tâches de l'utilisateur
    public function stats()
    {
        $tasks = Auth::user()->tasks;

        return response()->json([
            'total' => $tasks->count(),
            'pending' => $tasks->where('status', 'pending')->count(),
            'in_progress' => $tasks->where('status', 'in_progress')->count(),
            'completed' => $tasks->where('status', 'completed')->count(),
        ]);
    }
}
