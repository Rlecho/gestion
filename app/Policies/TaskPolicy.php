<?php
namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Déterminer si l'utilisateur peut afficher n'importe quel modèle.
     */
    public function viewAny(User $user): bool
    {
        // Par exemple, autoriser tous les utilisateurs à voir leurs propres tâches
        return true;
    }

    /**
     * Déterminer si l'utilisateur peut voir un modèle spécifique.
     */
    public function view(User $user, Task $task): bool
    {
        // Un utilisateur ne peut voir que ses propres tâches
        return $user->id === $task->user_id;
    }

    /**
     * Déterminer si l'utilisateur peut créer des modèles.
     */
    public function create(User $user): bool
    {
        // Permet à tous les utilisateurs authentifiés de créer des tâches
        return true;
    }

    /**
     * Déterminer si l'utilisateur peut mettre à jour un modèle.
     */
    public function update(User $user, Task $task): bool
    {
        // L'utilisateur peut seulement mettre à jour ses propres tâches
        return $user->id === $task->user_id;
    }

    /**
     * Déterminer si l'utilisateur peut supprimer un modèle.
     */
    public function delete(User $user, Task $task): bool
    {
        // L'utilisateur peut seulement supprimer ses propres tâches
        return $user->id === $task->user_id;
    }

    /**
     * Déterminer si l'utilisateur peut restaurer le modèle.
     */
    public function restore(User $user, Task $task): bool
    {
        return false;
    }

    /**
     * Déterminer si l'utilisateur peut supprimer définitivement le modèle.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return false;
    }
}

