<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;

class DiscogsManager extends Component
{
    public Artist $artist;
    public $manualId;
    public $message = '';
    public $messageType = '';

    public function mount(Artist $artist)
    {
        $this->artist = $artist;
        $this->manualId = $artist->discogs_id_manual;
    }

    public function updateManualId()
    {
        $this->clearMessage(); // Clear any existing message

        $this->validate([
            'manualId' => 'nullable|integer|min:1'
        ]);

        try {
            $this->artist->update([
                'discogs_id_manual' => $this->manualId ?: null,
                'discogs_fetch_attempted' => false
            ]);

            if ($this->manualId) {
                $this->artist->getDiscogsData();
                $this->artist->refresh();
                $this->showMessage('Manual Discogs ID updated and data refreshed!', 'success');
            } else {
                $this->showMessage('Manual Discogs ID updated!', 'success');
            }
        } catch (\Exception $e) {
            \Log::error("Error updating Discogs ID for artist {$this->artist->id}: " . $e->getMessage());
            $this->showMessage('An error occurred while updating Discogs data.', 'error');
        }
    }

    public function resetManualId()
    {
        $this->clearMessage();

        try {
            $this->artist->update([
                'discogs_id_manual' => null,
                'discogs_fetch_attempted' => false
            ]);

            $this->manualId = null;
            $this->artist->refresh();
            $this->showMessage('Manual Discogs ID reset!', 'success');
        } catch (\Exception $e) {
            \Log::error("Error resetting Discogs ID for artist {$this->artist->id}: " . $e->getMessage());
            $this->showMessage('An error occurred while resetting Discogs data.', 'error');
        }
    }

    public function refreshData()
    {
        $this->clearMessage();

        try {
            $this->artist->update(['discogs_fetch_attempted' => false]);
            $this->artist->getDiscogsData();
            $this->artist->refresh();
            $this->showMessage('Discogs data refreshed!', 'success');
        } catch (\Exception $e) {
            \Log::error("Error refreshing Discogs data for artist {$this->artist->id}: " . $e->getMessage());
            $this->showMessage('An error occurred while refreshing Discogs data.', 'error');
        }
    }

    private function showMessage($message, $type)
    {
        $this->message = $message;
        $this->messageType = $type;
    }

    public function clearMessage()
    {
        $this->message = '';
        $this->messageType = '';
    }

    public function render()
    {
        return view('livewire.discogs-manager');
    }
}
