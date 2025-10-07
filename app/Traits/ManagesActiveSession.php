<?php

namespace App\Traits;

trait ManagesActiveSession
{
    /**
     * Update the user's active session ID.
     *
     * @param  string  $sessionId
     * @return void
     */
    public function updateActiveSession(string $sessionId): void
    {
        $this->update(['active_session_id' => $sessionId]);
    }
    
    /**
     * Clear the user's active session ID.
     *
     * @return void
     */
    public function clearActiveSession(): void
    {
        $this->update(['active_session_id' => null]);
    }
    
    /**
     * Check if the given session ID is the user's active session.
     *
     * @param  string  $sessionId
     * @return bool
     */
    public function isActiveSession(string $sessionId): bool
    {
        return $this->active_session_id === $sessionId;
    }
    
    /**
     * Check if the user has an active session.
     *
     * @return bool
     */
    public function hasActiveSession(): bool
    {
        return !is_null($this->active_session_id);
    }
}